#pragma once // avoids the header to be included multiple times and fuck up
#pragma comment(lib, "urlmon.lib")
#pragma comment (lib, "wininet.lib")

#include <stdio.h>
#include <windows.h> 
#include <wininet.h> 
#include <iostream> 
#include <tchar.h>
#include <urlmon.h>
#include <stdlib.h> 
#include <stdio.h>
#include <iostream>
#include <intrin.h>
#include <Shlobj.h>
#include <sstream>

using namespace std;


BOOL IsWow64();
std::string getHwid();
std::string getSys(void);
int getDisk();
std::string getProc();
int getRam();
BOOL IsElevated();
std::string getWinVer();
std::string getGPU();