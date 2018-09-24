#include <iostream>
#include <cctype>
#include <cstring>

using namespace std;

int main(int argc, char *argv[]) {
    //if no entries
    if (argc < 2)
        return 0;
    else {
        //start w/ 1 because 0 will have program name
        //loop till numArgs
        for (int i = 1; i < argc; i++) {
            char ch = argv[i][0];
            //Checking command at first char position
            if (ch == 'S')
                //do nothing
                return 0;
                //switch all uppercase letters to lower
            else if (ch == 'L') {
                //loop through arg starting after 1st char
                for (int j = 1; j < strlen(argv[i]); j++) {
                    cout<<(char) tolower(argv[i][j]);
                }
            } else if (ch == 'U') {
                for (int j = 1; j < strlen(argv[i]); j++) {
                    cout<<(char) toupper(argv[i][j]);
                }
            } else if (ch == 'r') {
                string argument2; //temp string
                for (int j = strlen(argv[i]); j > 0; j--) {
                    cout<<argv[i][j];
                }
            } else if (ch == 'R') {
                string argument12; //temp
                for (int j = strlen(argv[i]); j > 0; j--) {
                    cout<<(char) toupper(argv[i][j]);
                }
            } else {
                cout << "FAIL"<< endl;
            }

        }
    }
    return 0;
}