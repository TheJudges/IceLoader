#include "encryption.h"
#include <string>
#include <algorithm>
#include <iostream>

std::string rencFOUR(unsigned char * ByteInput, unsigned char * pwd) //changed to address
{
    unsigned char * temp;
    int i, j = 0, t, tmp, tmp2, s[256], k[256];
    for (tmp = 0; tmp < 256; tmp++) {
        s[tmp] = tmp;
        k[tmp] = pwd[(tmp % strlen((char * ) pwd))];
    }
    for (i = 0; i < 256; i++) {
        j = (j + s[i] + k[i]) % 256;
        tmp = s[i];
        s[i] = s[j];
        s[j] = tmp;
    }
    temp = new unsigned char[(int) strlen((char * ) ByteInput) + 1];
    i = j = 0;
    for (tmp = 0; tmp < (int) strlen((char * ) ByteInput); tmp++) {
        i = (i + 1) % 256;
        j = (j + s[i]) % 256;
        tmp2 = s[i];
        s[i] = s[j];
        s[j] = tmp2;
        t = (s[i] + s[j]) % 256;
        if (s[t] == ByteInput[tmp])
            temp[tmp] = ByteInput[tmp];
        else
            temp[tmp] = s[t] ^ ByteInput[tmp];
    }
    temp[tmp] = '\0';

	return std::string((char*)temp);
}

std::string Hex(const std::string& input, bool bLower)
{
	const char* lut;
	if (!bLower)
		lut = "0123456789ABCDEF";
	else
		lut = "0123456789abcdef";
    size_t len = input.length();

    std::string output;
    output.reserve(2 * len);
    for (size_t i = 0; i < len; ++i)
    {
        const unsigned char c = input[i];
        output.push_back(lut[c >> 4]);
        output.push_back(lut[c & 15]);
    }
    return output;
}

std::string Str(const std::string& input, bool bLower)
{
	static const char* lut;
	if (bLower)
		lut = "0123456789abcdef";
        
	else
		lut = "0123456789ABCDEF";
    size_t len = input.length();
    if (len & 1) throw std::invalid_argument("odd length");

    std::string output;
    output.reserve(len / 2);
    for (size_t i = 0; i < len; i += 2)
    {
        char a = input[i];
        const char* p = std::lower_bound(lut, lut + 16, a);
        if (*p != a) throw std::invalid_argument("not a hex digit");

        char b = input[i + 1];
        const char* q = std::lower_bound(lut, lut + 16, b);
        if (*q != b) throw std::invalid_argument("not a hex digit");

        output.push_back(((p - lut) << 4) | (q - lut));
    }
    return output;
}