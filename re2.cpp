#include <iostream>
#include <string>
#include <re2/re2.h>

// compile with: g++ re2.cpp -o re2 -lre2
int main() {
    std::string input;
    std::string pattern = "A(B|C+)+D";

    std::cout << "Enter text: ";
    std::getline(std::cin, input);

    if (RE2::FullMatch(input, pattern)) {
        std::cout << "Input is valid.\n";
    } else {
        std::cout << "Invalid input.\n";
    }

    return 0;
}