#include <iostream>
#include <conio.h>
#include <stdio.h>
#include <string.h>
#include <fstream>
#include <stdlib.h>

using namespace std;

int n,n1,resultado=0;

void suma(int n) 
{
	if (n<10)   // Aseguramos que termine
	{
		n1=n;
	    n1%=10;
		resultado+=n1;
        return;
    }
    else{
    n1=n;
    n1%=10;
    n/=10;
	resultado+=n1;
	suma(n);
	}
}
 
main() 
{
	cout << "\n Dite valor a factorizar ";
	cin >> n;
	suma(n);
    cout << "\n " << resultado <<endl; 
}
