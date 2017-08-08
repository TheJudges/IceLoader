#include "core.h"

typedef BOOL (WINAPI *LPFN_ISWOW64PROCESS) (HANDLE, PBOOL);
LPFN_ISWOW64PROCESS fnIsWow64Process;

BOOL IsWow64()
{
    BOOL bIsWow64 = FALSE;
    fnIsWow64Process = (LPFN_ISWOW64PROCESS) GetProcAddress(
        GetModuleHandle(TEXT("kernel32")),"IsWow64Process");

    if(NULL != fnIsWow64Process)
    {
        if (!fnIsWow64Process(GetCurrentProcess(),&bIsWow64))
        {
            //handle error
        }
    }
    return bIsWow64;
}

std::string getGPU(){
	int disp_num = 0;
	DISPLAY_DEVICE disp_dev_info;
	ZeroMemory(&disp_dev_info, sizeof(DISPLAY_DEVICE));
	disp_dev_info.cb = sizeof(DISPLAY_DEVICE);
	EnumDisplayDevices(0, disp_num++, &disp_dev_info, 0x00000001);
	return disp_dev_info.DeviceString;
}

std::string getWinVer(){
	OSVERSIONINFO osvi;
	BOOL bIsWindowsXPorLater;

	ZeroMemory(&osvi, sizeof(OSVERSIONINFO));
	osvi.dwOSVersionInfoSize = sizeof(OSVERSIONINFO);

	GetVersionEx(&osvi);
	stringstream out;
	out << osvi.dwMajorVersion << "." << osvi.dwMinorVersion;
	return out.str();
}

std::string getHwid()
{
    HW_PROFILE_INFO hwProfileInfo;
    if(GetCurrentHwProfile(&hwProfileInfo) != NULL){
        return hwProfileInfo.szHwProfileGuid;
    }else{
        return "";
    }
}

std::string getSys(){
    if(IsWow64())
        return "x64";
    else
        return "x32";
    return 0;
}

int getDisk()
{
  __int64 total,free;
  char Dnames[3];
	sprintf_s(Dnames,"C:");
    //printf("Drive %s\n",Dnames);
    if(GetDriveType(Dnames) != DRIVE_FIXED) {
		 //printf("not a fixed drive, skipping");
      }else{
		 GetDiskFreeSpaceEx(Dnames,NULL,(PULARGE_INTEGER)&total,(PULARGE_INTEGER)&free);
		 return total /1024/1024/1024;
      }
}

std::string getProc(){

 // Get extended ids.
    int CPUInfo[4] = {-1};
    __cpuid(CPUInfo, 0x80000000);
    unsigned int nExIds = CPUInfo[0];

    // Get the information associated with each extended ID.
    char CPUBrandString[0x40] = { 0 };
    for( unsigned int i=0x80000000; i<=nExIds; ++i)
    {
        __cpuid(CPUInfo, i);

        // Interpret CPU brand string and cache information.
        if  (i == 0x80000002)
        {
            memcpy( CPUBrandString,
            CPUInfo,
            sizeof(CPUInfo));
        }
        else if( i == 0x80000003 )
        {
            memcpy( CPUBrandString + 16,
            CPUInfo,
            sizeof(CPUInfo));
        }
        else if( i == 0x80000004 )
        {
            memcpy(CPUBrandString + 32, CPUInfo, sizeof(CPUInfo));
		}
	}
    return CPUBrandString;
}

int getRam(){
	typedef BOOL (WINAPI *PGMSE)(LPMEMORYSTATUSEX);
	PGMSE pGMSE = (PGMSE) GetProcAddress( GetModuleHandle( TEXT( "kernel32.dll" ) ), TEXT( "GlobalMemoryStatusEx") );
	if ( pGMSE != 0 )
	{
		MEMORYSTATUSEX mi;
		memset( &mi, 0, sizeof(MEMORYSTATUSEX) );
		mi.dwLength = sizeof(MEMORYSTATUSEX);
		if ( pGMSE( &mi ) == TRUE )
			return mi.ullTotalPhys / 1048576;
		else
			pGMSE = 0;
	}
	if ( pGMSE == 0 )
	{
		MEMORYSTATUS mi;
		memset( &mi, 0, sizeof(MEMORYSTATUS) );
		mi.dwLength = sizeof(MEMORYSTATUS);
		GlobalMemoryStatus( &mi );
		return mi.dwTotalPhys / 1048576;
	}
}

BOOL IsElevated() {
	BOOL fRet = FALSE;
	HANDLE hToken = NULL;
	if (OpenProcessToken(GetCurrentProcess(), TOKEN_QUERY, &hToken)) {
		TOKEN_ELEVATION Elevation;
		DWORD cbSize = sizeof(TOKEN_ELEVATION);
		if (GetTokenInformation(hToken, TokenElevation, &Elevation, sizeof(Elevation), &cbSize)) {
			fRet = Elevation.TokenIsElevated;
		}
	}
	if (hToken) {
		CloseHandle(hToken);
	}
	return fRet;
}