# Using Third-Party Libraries

- [Using Third-Party Libraries](#using-third-party-libraries)
  - [Programming Library](#programming-library)
  - [Using Static Libraries](#using-static-libraries)
    - [Example of Using a Static Library](#example-of-using-a-static-library)
  - [Using Dynamic Libraries](#using-dynamic-libraries)
    - [Implicit Linking](#implicit-linking)
    - [Explicit Linking](#explicit-linking)
  - [Bibliography](#bibliography)

## Programming Library

A __programming library__ is an archive of programming resources such as functions, classes, objects, constants, and various variables. In particular, constants can represent graphical or multimedia data. Programming libraries are divided into three types: __static__, __dynamic__, and __template libraries__.

Static libraries are represented by two files:

1. A header file with the extension `h` (`hxx`, `hpp`), describing the library interface;
2. A binary archive with the extension `lib` (on Windows) or `a` (on Unix-like systems), storing all programming resources as object code.

Dynamic libraries are represented by three files:

1. A header file with the extension `h` (`hxx`, `hpp`), describing the library interface;
2. A binary archive with the extension `dll` (on Windows) or `so` (on Unix-like systems), called a dynamic (or shared) library, storing all programming resources as binary code.
3. A file with the extension `lib` (on Windows) or `a` (on Unix-like systems), called an import library, storing the locations of programming resources in the dynamic library. On Unix systems, the import library is not used.

There is also a certain type of library that can only be provided as source code—these are libraries containing class and function templates. These libraries are supplied in header files.

The naming of programming library files for the Gnu C++ (g++) compiler is as follows:

- header file: `<library name>.h` or `<library name>.hpp`;
- static library: `lib<library name>.a` (on Unix systems) or `<library name>.lib` (on Windows);
- dynamic library: `<library name>.so` (on Unix systems) or `<library name>.dll` (on Windows).

Header files are usually located in the compiler's `INCLUDE` folder, static libraries and import libraries in the `LIB` folder, and dynamic libraries in system folders (`c:\Windows\System32` or `/usr/bin`). These paths can be overridden in the program or at compile time.

Each type of programming library has its own advantages and disadvantages. For example, using static libraries increases the portability of programs because they do not depend on any modules (dynamic libraries), but the program size increases. Using dynamic libraries allows you to create smaller programs, but at runtime, they will occupy memory for the dynamic library.

## Using Static Libraries

When using functions (classes or other programming resources) from static libraries, during compilation, the compiler takes only the object code of the used resources from the library. Therefore, if a static library is several megabytes in size, the program will increase by only a few dozen kilobytes (depending on the size of the used functions).

To use a static library in a program, you need to:

1. Include the library's header file in your program;
2. Specify the path to the library in the compilation parameters.

In this case, the compiler takes only the object code of the used functions from the library and includes it in the program code. This inclusion is called __static linking__.

### Example of Using a Static Library

Suppose there is a static library __MyMath__, which consists of the following files:

1. `MyMath.h` - the library's header file;
2. `libMyMath.a` - the library's binary archive.

Suppose this library is located in the folder `C:\MyLibs\MyMath`. To use the library in your program, you need to:

1. Include the library's header file in your program:

   ```cpp
   #include "MyMath.h"
   ```

2. Specify the path to the library in the compilation parameters:

   ```bash
   g++ -o MyProgram.exe MyProgram.cpp -IC:\\MyLibs\\MyMath -LC:\\MyLibs\\MyMath -lMyMath
   ```

In this case, the `-I` compilation flag specifies the path to the library's header files, the `-L` flag specifies the path to the libraries, and the `-l` flag specifies the library name. Paths can be absolute or relative.

## Using Dynamic Libraries

Dynamic libraries can be used in two different ways:

- Implicit linking;
- Explicit linking.

### Implicit Linking

__Implicit linking__ of a library with an application occurs when the header file is included and the use of the library is specified in the project properties. In this case, the library will be loaded into memory before the application starts. When the application is launched, the operating system checks for the presence of dynamic libraries linked to the program in the system paths, the current directory, or in memory. Only after this does the program execute. If at least one library is not found, the application terminates with an appropriate error.

When compiling a program that uses a dynamic library, the executable code increases in size by a few bytes, since instead of the binary code of the function from the dynamic library, the program includes a call to this function, declared in the import library.

### Explicit Linking

However, dynamic libraries can be loaded not only at program startup but also on demand, during program execution.

__Explicit linking__ of a library is performed using the `LoadLibrary` function (`dlopen` on Unix systems), which loads the library at the moment the function is called. In this case, the application can work without the library until it is loaded by the `LoadLibrary` function.

On Windows operating systems, the following functions declared in the `windows.h` header are used for explicit linking:

- `LoadLibrary` — loads the dynamic library into memory;
- `GetProcAddress` — gets the address of a function from the dynamic library;
- `FreeLibrary` — unloads the dynamic library from memory;
- `GetModuleHandle` — gets the handle of the dynamic library.

On Unix systems, the following functions declared in the `dlfcn.h` header are used for explicit linking:

- `dlopen` — loads the dynamic library into memory;
- `dlsym` — gets the address of a function from the dynamic library;
- `dlclose` — unloads the dynamic library from memory.

If there is a dynamic library `MyMath.dll` with a function `int Add(int, int)`, then on Windows, to explicitly link the library with the program, you need to:

```cpp
/**
 * @file dll_load_example.cpp
 * @brief Example of explicit linking of a dynamic library, Windows
 * @details g++ dll_load_example.cpp -o dll_load_example.exe
 */
#include <windows.h>
#include <iostream>

typedef int (*pOperation)(int, int);

int main()
{
    HINSTANCE hLib = LoadLibrary("MyMath.dll");
    if (hLib == NULL)
    {
        std::cerr << "Error loading library" << std::endl;
        return 1;
    }

    pOperation Add = (pOperation)GetProcAddress(hLib, "Add");
    if (Add == NULL)
    {
        std::cerr << "Error loading function" << std::endl;
        return 1;
    }

    std::cout << Add(2, 3) << std::endl;

    FreeLibrary(hLib);
    return 0;
}
```

On Unix systems, to explicitly link the library with the program, you need to do the following:

```cpp
/**
 * @file dl_load_example.cpp
 * @brief Example of explicit linking of a dynamic library, Unix
 * @details g++ dl_load_example.cpp -o dl_load_example -ldl
 */
#include <dlfcn.h>
#include <iostream>

typedef int (*pOperation)(int, int);

int main()
{
    void* hLib = dlopen("MyMath.so", RTLD_LAZY);
    if (hLib == NULL)
    {
        std::cerr << "Error loading library" << std::endl;
        return 1;
    }

    pOperation Add = (pOperation)dlsym(hLib, "Add");
    if (Add == NULL)
    {
        std::cerr << "Error loading function" << std::endl;
        return 1;
    }

    std::cout << Add(2, 3) << std::endl;

    dlclose(hLib);
    return 0;
}
```

## Bibliography

1. [Library (computing), Wikipedia](https://en.wikipedia.org/wiki/Library_(computing))
2. [Create C/C++ DLLs in Visual Studio, microsoft.com](https://learn.microsoft.com/en-us/cpp/build/dlls-in-visual-cpp?view=msvc-170)
3. [dlopen, Linux Manual page](https://www.man7.org/linux/man-pages/man3/dlopen.3.html)
4. [Wheeler David, Dynamically Loaded (DL) Libraries](https://dwheeler.com/program-library/Program-Library-HOWTO/)
