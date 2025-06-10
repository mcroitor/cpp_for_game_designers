# Project. Build Systems

- [Project. Build Systems](#project-build-systems)
  - [Project Organization](#project-organization)
  - [The Concept of Compilation](#the-concept-of-compilation)
  - [Compilation from the Command Line](#compilation-from-the-command-line)
  - [Build Systems](#build-systems)
    - [make](#make)
    - [Ninja](#ninja)
    - [Autotools](#autotools)
    - [CMake](#cmake)
  - [Makefile Structure](#makefile-structure)
  - [Example of a Universal Makefile](#example-of-a-universal-makefile)
  - [Using CMake](#using-cmake)
  - [Bibliography](#bibliography)

## Project Organization

A project is understood as a set of source files, distributed in some way across the project's directories.

A project may contain one or several project files, used to build from the source files something that can be considered the project's target. The target of a project can be a static library, a dynamic library, an executable file, or a combination of libraries and executables.

A project can consist of several subprojects. A subproject is the source (and possibly other) files of another project, added to the directory structure of the main project.

A project may also include third-party modules: external dependencies (for example, libraries).

The organization of source code in a project can vary greatly, but the main idea is to separate:

- the project's source code
- subprojects
- project resources
- modules
- build output
- temporary files
- documentation

to simplify working with the project.

A typical Linux-style structure might look like:

- `bin` - stores the build output of the project
- `include` - header files
- `src` - cpp files
- `lib` - external dependencies (libraries)
- `obj` - temporary files created during the build process
- `resources` - resources used by the application (images, audio, video, etc.)

Each IDE offers its own project structure.

## The Concept of Compilation

__Application compilation__ is the process of converting a program's source code into an executable file. During compilation, the source code is transformed into object files, which are then linked into an executable.

A __compiler__ is a program that performs the compilation of source code. The compiler converts the source code into object files.

An __object file__ is a file containing machine code equivalent to the program's source code.

The compilation process includes the following stages:

- `preprocessing` - preliminary processing of the source code, including preprocessor directives. As a result, the contents of files specified by `#include` may be inserted, comments removed, and preprocessor directives processed;
- `compilation` - conversion of the source code into object files containing machine code to be executed by the processor;
- `linking` - combining object files into an executable file.

## Compilation from the Command Line

Nowadays, it is not strictly necessary to know how to compile an application from the command line, since modern IDEs come with a compiler and the entire build process can be started with a menu option or a key combination. However, for general development knowledge, it is useful to know how to build an application from source files, especially since this is a common situation for Linux users.

Any console application can be run with a set of keys (parameters). To find out which keys an application accepts, run it with the `--help` or `-h` key, depending on the implementation. For example, to learn about the GNU C++ compiler, run:

```shell
g++ --help
```

To compile `main.cpp` into the file `file[.exe]`, simply write:

```shell
g++ main.cpp -o file -l filename
```

You can also try compiling a file by specifying only its name, but in this case, compilation will succeed only if the program uses only the standard C library, and the resulting executable will be called `a[.exe]`. The `-o` key specifies the output file name, i.e., `file`. The `-l` key tells the linker to add the standard C++ library. According to Linux library naming conventions, if the library file is called `libfilename.a`, you can link it with `-l filename`, or specify the full library name.

You can omit the space between the key and its value, so the previous command can also be written as:

```shell
g++ main.cpp -ofile
```

If the project consists of several files, you can specify all the source files for compilation:

```shell
g++ first.cpp second.cpp main.cpp -o file
```

> [!TIP]
> Header files are not specified in the compilation command, as the compiler automatically searches for them in the project folder.

Alternatively, you can compile each file into an object file, then link them into the application. In this case, the build process will look like this:

```shell
g++ first.cpp -o first.o -O2 -c -std=c++14
g++ second.cpp -o second.o -O2 -c -std=c++14
g++ main.cpp -o main.o -O2 -c -std=c++14
g++ first.o second.o main.o -o file -love
```

> [!TIP]
> The list of linked libraries is always specified at the linking stage, when object files are combined into the executable.

The most commonly used compilation keys are shown in the table:

| __Key__ | __Description__ |
| ------- | -------------- |
| `-o`    | specify the output file name |
| `-E`    | preprocess the source file |
| `-S`    | compile the source file to an assembly file |
| `-c`    | compile the source file to an object file |
| `-g`    | generate debug information |
| `-O<N>` | optimization level. N can be from 0 to 4. |
| `-std=<standard>` | specify the C++ language standard. Possible values: `c++11`, `c++14`, `c++17`, `c++20`, `c++23` |
| `-l`    | link a library |
| `-I`    | specify the path to header files |
| `-L`    | specify the path to libraries |

Compiling each file and building the application manually can be tedious. Therefore, various build systems are used to automate this process.

## Build Systems

Build automation is a stage of the software development process that automates a wide range of tasks performed by programmers in their daily work.

It includes actions such as:

- compiling source code into object modules,
- building binary code into executables,
- running tests,
- deploying the program to the target environment,
- writing documentation or describing changes in the new version,
- configuring and preparing files for the build,
- collecting and passing information to the final program (program version, system, compiler, hardware info, system info, license, author name, etc.).

The main tool for build automation is the `make` utility, which has largely defined the style and methods for later tools. The `make` utility works with `Makefile` files. This format is supported by most widely used tools (`Automake`, `CMake`, `imake`, `qmake`, `nmake`, `wmake`, `Apache Ant`, `Apache Maven`, `OpenMake Meister`, `Gradle`).

Key requirements for automation tools include support for continuous integration technologies, such as nightly builds, source code dependency management, incremental builds, notifications when the source code matches existing binaries, convenient reports on compilation and linking results, automatic test runs, and conditional execution based on test results.

Types of automation used in various tools:

- on-demand automation: the user runs a script from the command line,
- scheduled automation: continuous integration, such as nightly builds,
- triggered automation: continuous integration that builds on every code commit in the version control system.

### make

`make` is a utility that automates the process of transforming files from one form to another. Most often, this means compiling source code into object files and then linking them into executables or libraries.

The utility uses special files, usually called `Makefile`, which describe dependencies between files and the commands to transform them.

### Ninja

`Ninja` is a cross-platform command-line utility that serves as a build system for software from source code. Ninja was developed by Evan Martin, a Google employee.

Ninja is an improved and refined version of Make. Its main goal is to automate and speed up builds, as well as subsequent rebuilds, based on generated files and to solve typical problems in cross-platform development.

### Autotools

`Autotools` is the GNU project build system, a set of tools designed to support the portability of source code between UNIX-like systems.

Porting code from one system to another can be a challenge. Different C compiler implementations may vary significantly: some language features may be missing, have different names, or be in different libraries. The programmer can solve this using macros and preprocessor directives like `#if`, `#ifdef`, etc. But in this case, the user compiling the program must define all these macros, which is not easy given the variety of distributions and systems. Autotools are invoked with the sequence `./configure && make && make install` and solve these problems automatically.

The GNU Autotools build system is widely used in many open-source projects. GNU Autotools includes:

- `Autoconf` - a utility that generates a `configure` script from `configure.ac` (or `configure.in`). The script checks system features and creates a `Makefile`.
- `Automake` - reads Makefile.am files and creates a portable Makefile (Makefile.in), which is then processed by the configuration script to become the final Makefile used by make.
- `Libtool` - manages the creation of libraries on Unix-like operating systems.

### CMake

`CMake` is a cross-platform build automation tool for software from source code. It does not perform the build itself, but generates build files from a `CMakeLists.txt` script and provides a simple unified management interface. It can also automate installation and package building.

It is considered an alternative to the GNU Autotools system, which is based on Perl and M4, and is often criticized for requiring non-trivial skills and version incompatibilities.

## Makefile Structure

To use the `make` build system, you need to create a `Makefile`.

The rules for writing a `Makefile` are as follows:

- The `Makefile` can define variables, commands, and comments.
- Variables are usually declared at the top and defined as `<name> = <value>`. Variables can be used as `$(<name>)`.
- Comments start with `#` and continue to the end of the line.
- Each rule has the structure:

```makefile
<target> : [<dependency> [...]]
    [<command>]
```

- A rule can have several dependencies or none. If there are dependencies, they are executed first, in the order listed, then the rule's command(s).
- Each dependency is another rule defined in the `Makefile`.
- Commands start with a tab character.

It is common practice to name rules after the files they create. For example, the rule for creating the file `file` will be called `file`.

Example `Makefile` for building a project from three files `first.cpp`, `second.cpp`, and `main.cpp`:

```makefile
all: file

file: first.o second.o main.o
    # link with the liblove library
    g++ first.o second.o main.o -o file -love
    
first.o: first.cpp
    g++ -c first.cpp -O2 -std=c++14 -o first.o

second.o: second.cpp
    g++ -c second.cpp -O2 -std=c++14 -o second.o

main.o: main.cpp
    g++ -c main.cpp -O2 -std=c++14 -o main.o
```

You can define variables in the build file to make the `Makefile` more customizable. For example, in the following example, the compiler, output file, and compilation and linking flags are defined at the top. This makes it easy to configure the build process.

```makefile
CC = g++
CXXFLAGS = -O2 -std=c++14
LDFLAGS = -love
OUT = file

all: file

file: first.o second.o main.o
    $(CC) first.o second.o main.o -o $(OUT) $(LDFLAGS)
    
first.o: first.cpp
    $(CC) -c first.cpp $(CXXFLAGS) -o first.o

second.o: second.cpp
    $(CC) -c second.cpp $(CXXFLAGS) -o second.o

main.o: main.cpp
    $(CC) -c main.cpp $(CXXFLAGS) -o main.o
```

Example `Makefile` with additional rules:

```makefile
CC = g++
CXXFLAGS = -O2 -std=c++14
LDFLAGS = -love
OUT = file

BINDIR = bin
SRCDIR = src
OBJDIR = obj

all: prepare $(OUT)

prepare:
   mkdir -p $(OBJDIR) $(BINDIR)

clean:
   rm -f $(OBJDIR)/*.o $(BINDIR)/*

help:
   @echo Usage:
   echo make - build application
   echo make clean - remove build artifacts
   echo make help - show help

$(OUT): $(OBJDIR)/first.o $(OBJDIR)/second.o $(OBJDIR)/main.o
    $(CC) $(OBJDIR)/first.o $(OBJDIR)/second.o $(OBJDIR)/main.o -o $(BINDIR)/$(OUT) $(LDFLAGS)
    
$(OBJDIR)/first.o:
    $(CC) -c $(SRCDIR)/first.cpp $(CXXFLAGS) -o $(OBJDIR)/first.o

$(OBJDIR)/second.o:
    $(CC) -c $(SRCDIR)/second.cpp $(CXXFLAGS) -o $(OBJDIR)/second.o

$(OBJDIR)/main.o:
    $(CC) -c $(SRCDIR)/main.cpp $(CXXFLAGS) -o $(OBJDIR)/main.o
```

To build the project, run the `make` utility. This executes the first defined rule. You can also run a specific rule by specifying it as a parameter. For example, to clean the project using the last `Makefile`, run `make clean`.

## Example of a Universal Makefile

Suppose the project consists of several files distributed across directories:

- `bin` - stores the build output
- `include` - header files
- `src` - cpp files
- `lib` - external dependencies (libraries)
- `obj` - temporary files created during the build process

In this case, the `Makefile` will look like this:

```makefile
CC = g++
CXXFLAGS = -O2 -std=c++20 -I include
LDFLAGS = -L lib

BINDIR = bin
SRCDIR = src
OBJDIR = obj

SRC = $(wildcard $(SRCDIR)/*.cpp)
OBJ = $(patsubst $(SRCDIR)/%.cpp, $(OBJDIR)/%.o, $(SRC))

APP = app

all: prepare $(APP)

prepare:
    mkdir -p $(OBJDIR) $(BINDIR)

clean:
    rm -f $(OBJDIR)/*.o $(BINDIR)/*

help:
    @echo Usage:
    echo make - build application
    echo make clean - remove build artifacts
    echo make help - show help

$(APP): $(OBJ)
    $(CC) $(OBJ) -o $(BINDIR)/$(APP) $(LDFLAGS)

$(OBJDIR)/%.o: $(SRCDIR)/%.cpp
    $(CC) -c $< $(CXXFLAGS) -o $@
```

## Using CMake

`CMake` is a cross-platform build automation system that allows you to generate build files for various platforms and compilers. It uses a `CMakeLists.txt` file, which describes dependencies and build rules for the project.

CMake makes it easy to manage dependencies and supports different build configurations (e.g., Debug and Release).

If a project `MyProject` has the following structure:

- `bin` - stores the build output;
- `include` - header files;
- `src` - cpp files;
- `lib` - external dependencies (libraries);
- `obj` - temporary files created during the build process;

and the following requirements:

- use the C++20 standard;
- use the `liblove` library;
- use the `libmath` library;
- the executable should be named `app`;

Then the `CMakeLists.txt` for this project will look like:

```cmake
cmake_minimum_required(VERSION 3.10)
project(MyProject)
set(CMAKE_CXX_STANDARD 20)
set(CMAKE_CXX_STANDARD_REQUIRED True)

include_directories(include) # Path to header files
link_directories(lib)        # Path to external libraries (use only if needed)

file(GLOB SOURCES "src/*.cpp") # Automatically collects all .cpp files from src
add_executable(app ${SOURCES})

target_link_libraries(app love math) # Link libraries
```

> [!TIP]
> If you want the executable to be placed in the `bin` folder, add the line:
>
> ```cmake
> set(CMAKE_RUNTIME_OUTPUT_DIRECTORY ${CMAKE_BINARY_DIR}/bin)
> ```

To build the project with CMake, use the following commands:

```bash
# Create a build directory
mkdir build
# Go to the build directory
cd build
# Generate build files
cmake ..
# Build the project
cmake --build .
```

## Bibliography

1. [GNU make](https://www.gnu.org/software/make/)
2. [Ninja](https://ninja-build.org/)
3. [Autoconf](https://www.gnu.org/savannah-checkouts/gnu/autoconf/manual/autoconf-2.71/autoconf.html)
4. [CMake](https://cmake.org)
