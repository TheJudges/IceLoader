#pragma once
#include <string>

std::string rencFOUR(unsigned char * ByteInput, unsigned char * pwd); //changed to address

//,unsigned char * & ByteOutput
std::string Hex(const std::string& input, bool bLower = false);
std::string Str(const std::string& input, bool bLower = false);