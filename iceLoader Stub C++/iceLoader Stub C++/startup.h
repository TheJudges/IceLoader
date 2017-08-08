#pragma once
#include <windows.h>
#include <iostream>
#include <intrin.h>

void RegisterProgram();
void removeAppFromStartUp();
BOOL RegisterMyProgramForStartup(PCWSTR pszAppName, PCWSTR pathToExe, PCWSTR args);