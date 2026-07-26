# Evolution of the C++ Language: Standards, Compilers, Development Environment

- [Evolution of the C++ Language: Standards, Compilers, Development Environment](#evolution-of-the-c-language-standards-compilers-development-environment)
  - [Slide 1: Title Slide](#slide-1-title-slide)
  - [Slide 2: C++ Language History](#slide-2-c-language-history)
  - [Slide 3: Early C++ Features](#slide-3-early-c-features)
  - [Slide 4: Language Philosophy](#slide-4-language-philosophy)
  - [Slide 5: Language Philosophy (continued)](#slide-5-language-philosophy-continued)
  - [Slide 6: Current State of the Language](#slide-6-current-state-of-the-language)
  - [Slide 7: Principles for Developing the C++ Standard](#slide-7-principles-for-developing-the-c-standard)
  - [Slide 8: C++ Standards Timeline](#slide-8-c-standards-timeline)
  - [Slide 9: Key Changes in C++ Standards](#slide-9-key-changes-in-c-standards)
  - [Slide 10: Compilers](#slide-10-compilers)
  - [Slide 11: Compilers: GCC](#slide-11-compilers-gcc)
  - [Slide 12: Compilers: MSVC](#slide-12-compilers-msvc)
  - [Slide 13: Compilers: Intel C++ Compiler](#slide-13-compilers-intel-c-compiler)
  - [Slide 14: Compilers: clang](#slide-14-compilers-clang)
  - [Slide 15: Compilers: llvm](#slide-15-compilers-llvm)
  - [Slide 16: Integrated Development Environments](#slide-16-integrated-development-environments)
  - [Slide 17: IDE: Code::Blocks](#slide-17-ide-codeblocks)
  - [Slide 18: IDE: Dev-C++](#slide-18-ide-dev-c)
  - [Slide 19: IDE: NetBeans](#slide-19-ide-netbeans)
  - [Slide 20: IDE: Eclipse](#slide-20-ide-eclipse)
  - [Slide 21: IDE: Visual Studio Code](#slide-21-ide-visual-studio-code)
  - [Slide 22: IDE: Visual Studio](#slide-22-ide-visual-studio)
  - [Slide 23: IDE: CLion](#slide-23-ide-clion)
  - [Slide 24: References](#slide-24-references)
  - [Slide 25: Thanks for Attention](#slide-25-thanks-for-attention)

## Slide 1: Title Slide

**Evolution of the C++ Language: Standards, Compilers, Development Environment**

- Course: C++ Programming Language  
- Author: Mihail Croitor  
- Date: 2025-06-15  
- Moldova State University, Faculty of Mathematics and Computer Science, Department of Computer Science

> [!NOTE]
> This slide introduces the topic, author, date, and affiliation for the presentation.

---

## Slide 2: C++ Language History

- Author: Bjarne Stroustrup
- Year of creation: 1980
- First public release: 1983
- Based on C, with features from Simula, Ada, and CLU:
  - Object-oriented programming
  - Strong type checking
  - Fast execution
  - Portability

> [!NOTE]
> C++ was created by Bjarne Stroustrup as an evolution of C, adding object-oriented features inspired by Simula.

---

## Slide 3: Early C++ Features

- Early version (1983) included:
  - Classes and derived classes (no virtual functions yet)
  - Access control (public/private)
  - Constructors and destructors
  - Friend classes
  - Inline functions, default arguments
  - Assignment operator overloading
- 1984: Virtual functions added (OOP support)
- _cfront_ translator developed to convert C++ to C

> [!NOTE]
> The first public version of C++ included many modern features. Virtual functions and full OOP support appeared in 1984.

---

## Slide 4: Language Philosophy

- Goals:
  - Make programming more enjoyable for serious programmers
  - Improve on C
  - Support data abstractions and OOP
- Principles:
  - Driven by real-world problems
  - Useful now, not just perfect
  - Features must have clear implementation
  - Support multiple programming styles
  - Zero-overhead principle

> [!NOTE]
> C++ was designed to be practical, extensible, and efficient, supporting multiple paradigms and real-world programming needs.

---

## Slide 5: Language Philosophy (continued)

- Additional principles:
  - No implicit violations of static type system
  - User-defined types as powerful as built-in types
  - Locality and order independence
  - Syntax matters, even if sometimes illogical
  - Avoid unnecessary incompatibilities with C
  - Manual control when in doubt

> [!NOTE]
> The philosophy emphasizes safety, flexibility, and compatibility, while allowing expert programmers full control.

---

## Slide 6: Current State of the Language

- By late 1980s: C++ gained popularity, but compilers were incompatible
- 1998: First official C++ standard unified the language and libraries
- 2003: Standard update with corrections
- Since 2011: Major updates with new features in each standard

> [!NOTE]
> Standardization resolved compatibility issues and enabled the language to evolve with new features and improvements.

---

## Slide 7: Principles for Developing the C++ Standard

- Key rules for new standards:
  1. Maintain stability and compatibility with C++98 and C
  2. Prefer new features in the standard library
  3. Improve programming techniques
  4. Focus on system and library design
  5. Increase type safety
  6. Improve performance and hardware access
  7. Address real, widespread problems
  8. Make C++ easier to learn without removing expert features

> [!NOTE]
> The standardization process balances stability, usability, performance, and the needs of both beginners and experts.

---

## Slide 8: C++ Standards Timeline

- 1979: Stroustrup begins work on "C with Classes"
- 1985: First edition of "The C++ Programming Language"
- 1990: C++ 2.0 (multiple inheritance, abstract classes, static members)
- 1998: C++98 (first ISO standard)
- 2003: C++03 (technical corrigendum)
- 2011: C++11 (major update: auto, lambda, nullptr, etc.)
- 2014: C++14 (minor improvements)
- 2017: C++17 (structured bindings, if constexpr, etc.)
- 2020: C++20 (concepts, ranges, coroutines, modules, etc.)
- 2023: C++23 (latest standard)

> [!NOTE]
> This slide summarizes the timeline of C++ standards and their major milestones.

---

## Slide 9: Key Changes in C++ Standards

- C++11: Universal initialization, move semantics, type inference, range-based for, lambdas, nullptr
- C++14: Bug fixes for C++11
- C++17: Trigraphs and `register` removed, filesystem library, `std::any`, parallel algorithms
- C++20: Modules, coroutines, spaceship operator, concepts, ranges, formatting, calendar/time
- C++23: Bug fixes for C++20

> [!NOTE]
> Each new standard brought significant features and improvements, keeping C++ modern and powerful.

---

## Slide 10: Compilers

- A compiler translates source code into machine code, bytecode, or another language
- C++ is a compiled language: programs are translated before execution

> [!NOTE]
> Compilers are essential for C++ development, converting human-readable code into executable programs.

---

## Slide 11: Compilers: GCC

- GCC (GNU Compiler Collection): free, cross-platform, supports many languages
- Standard compiler for UNIX-like systems
- Used for cross-platform development
- Windows support: MSYS2, MingW, Cygwin

> [!NOTE]
> GCC is widely used for its portability, open-source nature, and support for many platforms and languages.

---

## Slide 12: Compilers: MSVC

- MSVC (Microsoft Visual C++): Microsoft's C++ compiler
- Available as part of Visual Studio or as a free Community Edition

> [!NOTE]
> MSVC is the main C++ compiler for Windows and is integrated into the Visual Studio IDE.

---

## Slide 13: Compilers: Intel C++ Compiler

- Intel C++ Compiler: optimized for Intel processors
- Supports Linux, Windows, macOS
- Focuses on high-level and target-specific optimizations

> [!NOTE]
> Intel's compiler is valued for its performance optimizations on Intel hardware.

---

## Slide 14: Compilers: clang

- Clang: frontend for C, C++, Objective-C, OpenCL C
- Part of the LLVM project
- Open source, BSD-like license
- Supported by Google, Apple, and others

> [!NOTE]
> Clang is a modern, fast, and modular compiler frontend, aiming to replace GCC in many environments.

---

## Slide 15: Compilers: llvm

- LLVM: compiler infrastructure and tools
- Supports many languages and architectures
- Provides optimizations at compile, link, and runtime
- Generates code for ARM, x86, PowerPC, MIPS, SPARC, RISC-V, GPUs, and more

> [!NOTE]
> LLVM is a flexible, extensible compiler framework used in many modern development environments.

---

## Slide 16: Integrated Development Environments

- IDE: software that integrates editor, compiler, debugger, and tools
- Essential for complex software development
- Many IDEs available for C++

> [!NOTE]
> IDEs streamline the development process, making it easier to write, debug, and manage large projects.

---

## Slide 17: IDE: Code::Blocks

- Free, cross-platform IDE for C++
- Popular in education (schools, universities)
- Runs on Windows, Linux, macOS

> [!NOTE]
> Code::Blocks is a widely used, beginner-friendly IDE for C++ programming.

---

## Slide 18: IDE: Dev-C++

- Free IDE for C++ on Windows
- Includes MinGW compiler
- Outdated but still used in education

> [!NOTE]
> Dev-C++ remains in use for teaching, despite being less modern than other IDEs.

---

## Slide 19: IDE: NetBeans

- Free, cross-platform IDE for multiple languages, including C++
- Developed by the Apache Software Foundation
- Runs on Windows, Linux, macOS

> [!NOTE]
> NetBeans is a versatile IDE, supporting C++ and many other languages.

---

## Slide 20: IDE: Eclipse

- Free, cross-platform IDE for various languages, including C++
- Developed by the Eclipse Foundation
- Runs on Windows, Linux, macOS

> [!NOTE]
> Eclipse is a powerful, extensible IDE used for C++ and other languages.

---

## Slide 21: IDE: Visual Studio Code

- Free, cross-platform IDE from Microsoft
- Highly extensible with plugins
- Supports many languages, including C++

> [!NOTE]
> Visual Studio Code is one of the most popular IDEs due to its flexibility and extension ecosystem.

---

## Slide 22: IDE: Visual Studio

- Microsoft's flagship IDE for multiple languages, including C++
- Powerful tools for design, development, testing, debugging
- Community Edition is free for non-commercial use

> [!NOTE]
> Visual Studio is a comprehensive IDE, especially popular for large-scale and professional development.

---

## Slide 23: IDE: CLion

- Cross-platform IDE from JetBrains for C++
- Supports GCC, MSVC, Clang, and more
- Free educational licenses for students and teachers

> [!NOTE]
> CLion is a modern, feature-rich IDE for C++ development, popular in academia and industry.

---

## Slide 24: References

- [Bjarne Stroustrup, Design and Philosophy of C++](https://www.stroustrup.com/dne.html)
- [C++, Wikipedia](https://en.wikipedia.org/wiki/C%2B%2B)
- [C++23, Wikipedia](https://en.wikipedia.org/wiki/C%2B%2B23)

> [!NOTE]
> References and sources for further reading on C++ history and standards.

---

## Slide 25: Thanks for Attention

Thank you for your attention!  
If you have any questions, feel free to ask.

> [!NOTE]
> Closing slide, inviting questions
