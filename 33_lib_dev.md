# Creating Libraries

- [Creating Libraries](#creating-libraries)
  - [Features of Library Creation](#features-of-library-creation)
  - [Import / Export](#import--export)
  - [Building Libraries](#building-libraries)
  - [Bibliography](#bibliography)

## Features of Library Creation

Creating programming libraries in general is similar to creating regular applications, but there are certain nuances.

The header file of a library describes the resources intended for export (i.e., for use by other programs). These resources are called the library interface (or Application Programming Interface — `API`).

Let's look at an example of a header file for a static library that provides operations with complex numbers.

```cpp
#ifndef COMPLEX_H
#define COMPLEX_H

#include <iostream>
#include <string>

class complex {
    double _real, _imaginary;
public:
    complex(double = 0, double = 0);
    complex(const complex&);
    ~complex();

    void operator +=(const complex&);
    void operator -=(const complex&);
    void operator *=(const complex&);
    void operator /=(const complex&);

    complex& operator = (const complex&);
    complex& operator = (const double&);

    const double& real() const;
    const double& imaginary() const;
    void swap(complex&);
    std::string toString() const;
    double module() const;
    complex conjugate() const;
};

complex operator + (const complex&, const complex&);
complex operator - (const complex&, const complex&);
complex operator * (const complex&, const complex&);
complex operator / (const complex&, const complex&);

std::ostream& operator << (std::ostream&, const complex&);
bool operator == (const complex&, const complex&);

complex pow(const complex&, const complex&);
double abs(const complex&);

#endif /* COMPLEX_H */
```

As you can see, this is a regular class declaration.

Header files can be included in a project multiple times. This can cause redundant type and variable definitions, leading to compilation errors. That is why the description of library resources in header files is enclosed between preprocessor directives:

```cpp
#ifndef CONSTANT_NAME
#define CONSTANT_NAME

//...

#endif
```

These directives, at the preprocessing stage, ensure that definitions are included only once.

Modern compilers allow you to use the following instead of preprocessor branching:

```cpp
#pragma once
```

This instructs the compiler to include the file only once.

The implementation of the resources declared in the header file is, as usual, in a `.cpp` file.

```cpp
#include "complex.h"
#include <sstream>
#include <cmath>

complex::complex(double r, double im): _real(r), _imaginary(im) {}
complex::complex(const complex& c): _real(c._real), _imaginary(c._imaginary) {}
complex::~complex() {}

void complex::operator +=(const complex& c) {
    _real += c._real;
    _imaginary += c._imaginary;
}
void complex::operator -=(const complex& c) {
    _real -= c._real;
    _imaginary -= c._imaginary;
}
void complex::operator *=(const complex& c) {
    double real = _real * c._real - _imaginary * c._imaginary;
    double imaginary = _real * c._imaginary + _imaginary * c._real;
    _real = real;
    _imaginary = imaginary;
}
void complex::operator /=(const complex& c) {
    double denominator = c._real * c._real + c._imaginary * c._imaginary;
    double real = (_real * c._real + _imaginary * c._imaginary) / denominator;
    double imaginary = (_imaginary * c._real - _real * c._imaginary) / denominator;
    _real = real;
    _imaginary = imaginary;
}

complex& complex::operator =(const complex& c) {
    _real = c._real;
    _imaginary = c._imaginary;
    return *this;
}
complex& complex::operator =(const double& d) {
    _real = d;
    _imaginary = 0;
    return *this;
}

const double& complex::real() const { return _real; }
const double& complex::imaginary() const { return _imaginary; }
void complex::swap(complex& c) {
    std::swap(_real, c._real);
    std::swap(_imaginary, c._imaginary);
}
std::string complex::toString() const {
    std::ostringstream strcout;
    strcout << _real << " + i*( " << _imaginary << " )";
    return strcout.str();
}
double complex::module() const {
    return std::sqrt(_real * _real + _imaginary * _imaginary);
}
complex complex::conjugate() const {
    return complex(_real, -_imaginary);
}

// extern class interface
complex operator + (const complex& c1, const complex& c2) {
    complex tmp(c1);
    tmp += c2;
    return tmp;
}
complex operator - (const complex& c1, const complex& c2) {
    complex tmp(c1);
    tmp -= c2;
    return tmp;
}
complex operator * (const complex& c1, const complex& c2) {
    complex tmp(c1);
    tmp *= c2;
    return tmp;
}
complex operator / (const complex& c1, const complex& c2) {
    complex tmp(c1);
    tmp /= c2;
    return tmp;
}

std::ostream& operator << (std::ostream& os, const complex& c) {
    os << c.toString();
    return os;
}
bool operator == (const complex& c1, const complex& c2) {
    return ((c1.real() == c2.real()) && (c1.imaginary() == c2.imaginary()));
}

complex pow(const complex&, const complex&) {
    complex result;
    return result;
}
double abs(const complex& c) {
    return c.module();
}
```

## Import / Export

When developing dynamic libraries, their creation can be similar to creating static libraries. The only difference is the project type. The library can be used implicitly (by including the header file and specifying the use of the import library file). To use library functions, you must explicitly specify which functions can be accessed by programs that depend on this library. For this, the special language construct `__declspec(dllexport)` is used, indicating that the function (or class) is available for use. Below is an example of a header file describing a complex number class intended for export.

```cpp
#pragma once
#include <iostream>
#include <string>

#define DLLEXPORT __declspec(dllexport)

class DLLEXPORT complex
{
    double _real, _imaginary;
public:
    complex(double = 0, double = 0);
    complex(const complex&);
    ~complex(void);

    complex& operator = (const complex&);
    const double& real() const;
    const double& imaginary() const;
    std::string toString() const;

    void operator += (const complex&);
};

DLLEXPORT bool operator == (const complex&, const complex&);
DLLEXPORT complex operator + (const complex&, const complex&);
DLLEXPORT std::ostream& operator << (std::ostream&, const complex&);
DLLEXPORT int min(int, int);
```

The implementation file for the library does not change.

The described class can only be used in C++ projects. To create libraries compatible with the C language, header files should be written in C style (without classes, templates, or other C++-specific constructs). It is also recommended to add the `extern "C"` modifier to the `DLLEXPORT` macro — this allows the compiler to preserve the original names of exported resources (some compilers "mangle" function and class names).

A dynamic library created in this way cannot be used in languages other than C/C++. This is because languages like Pascal, Basic, etc., pass parameters from left to right, while C/C++ passes parameters from right to left. To create a library compatible with this group of languages, use the `__stdcall` modifier (or the equivalent `__pascal`), which changes the parameter passing order.

On Windows OS, dynamic libraries can also have an entry point — the `DllMain` function:

```cpp
#include <windows.h>

BOOL APIENTRY DllMain(HMODULE hModule,
                      DWORD  ul_reason_for_call,
                      LPVOID lpReserved)
{
    switch (ul_reason_for_call) {
        case DLL_PROCESS_ATTACH:
            // A process is loading the DLL.
            break;
        case DLL_THREAD_ATTACH:
            // A process is creating a new thread.
            break;
        case DLL_THREAD_DETACH:
            // A thread exits normally.
            break;
        case DLL_PROCESS_DETACH:
            // A process unloads the DLL.
            break;
    }
    return TRUE;
}
```

## Building Libraries

The simplest way to create libraries is to select the appropriate project type in your IDE. All modern IDEs offer both static and dynamic library projects.

Building programming libraries using the `GNU GCC` compiler, just like regular programs, occurs in several stages:

1. Compiling source files into object files;
2. Linking object files into a library.

The following `Makefile` demonstrates the process of creating a programming library:

```makefile
BINDIR = bin # directory for binary files
SRCDIR = src # directory for source files
OBJDIR = obj # directory for object files
INCDIR = include # directory for header files
LIBDIR = lib # directory for library files, third-party libraries

# compiler
CC = g++
# compiler flags
CXXFLAGS = -O2 -std=c++20 -I $(INCDIR)
# linker flags
LDFLAGS = -L $(LIBDIR)

# source files
SRC = $(wildcard $(SRCDIR)/*.cpp)
# object files
OBJ = $(patsubst $(SRCDIR)/%.cpp, $(OBJDIR)/%.o, $(SRC))

# library name
LIB = library

all: prepare $(LIB)-static $(LIB)-shared

static: prepare $(LIB)-static

shared: prepare $(LIB)-shared

prepare:
    mkdir -p $(OBJDIR) $(BINDIR)

clean:
    rm -f $(OBJDIR)/*.o $(BINDIR)/*

help:
    @echo "Usage:"
    @echo "make        - build library"
    @echo "make static - build static library"
    @echo "make shared - build shared library"
    @echo "make clean  - remove build artifacts"
    @echo "make help   - show help"

$(LIB)-shared: $(OBJ)
    $(CC) -shared $(OBJ) -o $(BINDIR)/lib$(LIB).so $(LDFLAGS)

$(LIB)-static: $(OBJ)
    ar rcs $(BINDIR)/lib$(LIB).a $(OBJ)

# compile source files
$(OBJDIR)/%.o: $(SRCDIR)/%.cpp
    $(CC) -c $< $(CXXFLAGS) -o $@
```

## Bibliography

1. [Library (programming), Wikipedia](https://en.wikipedia.org/wiki/Library_(computing))
2. [Create C/C++ DLLs in Visual Studio, microsoft.com](https://learn.microsoft.com/en-us/cpp/build/dlls-in-visual-cpp?view=msvc-170)
3. [dlopen, Linux Manual page](https://www.man7.org/linux/man-pages/man3/dlopen.3.html)
4. [Wheeler David, Dynamically Loaded (DL) Libraries](https://dwheeler.com/program-library/Program-Library-HOWTO/)
