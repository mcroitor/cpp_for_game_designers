# Best Programming Practices

- [Best Programming Practices](#best-programming-practices)
  - [Programming Style](#programming-style)
    - [Use Clear Names for Variables, Functions, and Classes](#use-clear-names-for-variables-functions-and-classes)
    - [Use Comments to Explain Code](#use-comments-to-explain-code)
    - [Use Spaces to Improve Code Readability](#use-spaces-to-improve-code-readability)
    - [Use Indentation to Highlight Code Blocks](#use-indentation-to-highlight-code-blocks)
    - [Use Blank Lines to Separate Logical Code Blocks](#use-blank-lines-to-separate-logical-code-blocks)
    - [Avoid Magic Numbers and Strings](#avoid-magic-numbers-and-strings)
    - [Avoid Long Lines of Code](#avoid-long-lines-of-code)
    - [Avoid Overly Large Functions](#avoid-overly-large-functions)
  - [Code Documentation](#code-documentation)
  - [Testing](#testing)
  - [Programming Idioms](#programming-idioms)
    - [Basic Idioms](#basic-idioms)
      - [Increment and Decrement](#increment-and-decrement)
      - [Swap](#swap)
    - [RAII](#raii)
    - [Pimpl](#pimpl)
  - [Bibliography](#bibliography)

Best programming practices are a set of rules and recommendations that help improve code quality, simplify its understanding and maintenance. They include rules for code formatting, documentation, testing, and the use of programming idioms.

Best programming practices include the following aspects:

1. Programming style — rules for code formatting.
2. Code documentation — adding comments to the program code.
3. Program testing — checking the program for compliance with requirements.
4. Programming idioms — standard ways of solving programming tasks.

## Programming Style

__Programming style__ refers to the rules for formatting program code. Programming style defines:

1. requirements for naming variables, functions, etc.;
2. code formatting rules;
3. code organization rules;
4. code documentation rules.

Programming style improves code readability, making it easier to understand and maintain[^1]. This is especially important in team development, when several programmers work on the same project or when a project is handed over from one programmer to another.

Programming style is usually determined by internal company or community standards. However, there are standards widely used in the programming industry. For example, C++ code formatting standards are defined in the book "C++ Coding Standards: 101 Rules, Guidelines, and Best Practices"[^2] and in the "Google C++ Style Guide"[^3].

Most development environments provide tools to automatically check code for compliance with the programming style. It is highly recommended to use such tools to maintain a consistent style in the project.

Below are some basic code formatting rules:

1. Use clear names for variables, functions, and classes.
2. Use comments to explain code.
3. Use spaces to improve code readability.
4. Use indentation to highlight code blocks.
5. Use blank lines to separate logical code blocks.
6. Avoid magic numbers and strings.
7. Avoid long lines of code.
8. Avoid overly large functions.

### Use Clear Names for Variables, Functions, and Classes

Variable, function, and class names should be clear and descriptive. They should reflect the purpose of the variable, function, or class and be understandable to other programmers. The following naming styles are commonly used:

1. `camelCase` — the first word is lowercase, each subsequent word starts with an uppercase letter: `myVariable`, `myFunction`. Usually used for variables, functions, and methods.
2. `snake_case` — all words are lowercase, separated by underscores: `my_variable`, `my_function`, `my_class`. This naming is often used in the C++ standard library.
3. `PascalCase` — each word starts with an uppercase letter: `MyClass`. Usually used for classes and structures.
4. `UPPER_CASE` — all letters are uppercase, words are separated by underscores: `MY_CONSTANT`. Used for constants.

Other programming languages may use different naming styles.

### Use Comments to Explain Code

High-quality and clean code should contain some documentation in the form of comments. Comments help to understand the purpose of the code, its features, and logic. It is important not only to explain the code but also to justify decisions and provide additional information (such as author, creation date, etc.).

### Use Spaces to Improve Code Readability

When we write text, we separate words with spaces for better readability. The same applies to program code: placing spaces between operators, keywords, and variables improves code readability and makes it easier to understand.

Bad:

```cpp
int a=5;
```

Good:

```cpp
int a = 5;
```

### Use Indentation to Highlight Code Blocks

Indentation using spaces or tabs is used to highlight code blocks and improve readability. Indentation makes it easy to determine the nesting of code blocks and simplifies understanding.

Bad:

```cpp
for (int i = 0; i < 10; i++) {
std::cout << i << std::endl;
}
```

Good:

```cpp
for (int i = 0; i < 10; i++) {
    std::cout << i << std::endl;
}
```

Indentation also helps to highlight logical code blocks that may be candidates for extraction into separate functions.

### Use Blank Lines to Separate Logical Code Blocks

Complex sequential code usually contains several logical blocks that perform different tasks. To improve readability and understanding, logical blocks should be separated by blank lines.

Bad:

```cpp
int a = 5;
int b = 10;
int c = a + b;
std::cout << c << std::endl;
```

Good:

```cpp
int a = 5;
int b = 10;
int c = a + b;

std::cout << c << std::endl;
```

### Avoid Magic Numbers and Strings

_Magic numbers_ and _magic strings_ are numbers and strings used directly in code without being declared as constants. Using magic numbers and strings makes code harder to understand and maintain, as it is unclear what these values mean. Therefore, magic numbers and strings should be replaced with constants with clear names.

Bad:

```cpp
if (status == 1) {
    // ...
}
```

Good:

```cpp
const int STATUS_OK = 1;

if (status == STATUS_OK) {
    // ...
}
```

### Avoid Long Lines of Code

Long lines of code have the same problem: poor readability, for example, because they do not fit on the screen. Therefore, long lines should be split into several lines using line breaks or by splitting into several concatenated strings.

Bad:

```cpp
std::string longString = "This is a very long string that does not fit on the screen and is hard to read.";
```

Good:

```cpp
std::string longString = "This is a very long string that does not fit on the screen "
                         "and is hard to read.";
```

### Avoid Overly Large Functions

Overly large functions are also difficult to read and understand. Moreover, a long function may be hard to test and maintain due to its complex structure. Therefore, functions should be split into smaller ones, each performing a single specific task.

## Code Documentation

Code documentation is the process of adding comments to program code to explain its operation and purpose. Documentation improves understanding, simplifies maintenance and development. Based on documented code, special programs can automatically generate documentation, and development environments can provide hints and additional information about the code.

Code documentation usually includes the following types of comments:

1. Comments for classes, functions, and variables — describe the purpose and features of the class, function, or variable.
2. Comments for code blocks — explain the logic of a code block.
3. Comments for code lines — justify decisions and explain complex code sections.
4. Metadata — information about version, author, creation date, etc.

Excessive documentation can also be harmful, as it complicates understanding and increases code volume. Therefore, documentation should be moderate and informative.

To create technical documentation, special tools are usually used, such as Doxygen[^4], Javadoc[^5], etc. These tools allow you to automatically generate documentation based on comments in the code.

To define documentation standards, code formatting standards are usually used, such as the Google C++ Style Guide[^3].

Example of documenting a function in C++:

```cpp
/**
 * @brief This is a brief description of the function.
 *
 * This is a detailed description of the function.
 *
 * @param[in] a The first parameter.
 * @param[in] b The second parameter.
 * @return The result of the function.
 */
int add(int a, int b) {
    return a + b;
}
```

Example of documenting a class in C++:

```cpp
/**
 * @brief This is a brief description of the class.
 *
 * This is a detailed description of the class.
 */
class MyClass {
public:
    /**
     * @brief This is a brief description of the function.
     *
     * This is a detailed description of the function.
     *
     * @param[in] a The first parameter.
     * @param[in] b The second parameter.
     * @return The result of the function.
     */
    int add(int a, int b);
};
```

Documentation for code is defined by a block comment starting with `/**` and ending with `*/`. Special tags can be used in the comment to automatically generate program documentation.

Some main documentation tags:

1. `@brief` — brief description.
2. `@param` — function parameter description.
3. `@return` — function return value description.
4. `@version` — function or class version.
5. `@author` — function or class author.
6. `@date` — function or class creation date.

## Testing

One of the problems in computer science is justifying the correctness of a program. Program testing is the process of checking a program for compliance with requirements and finding errors. Testing ensures that the program works correctly and contains no errors.

There are several types of testing:

1. Unit testing — testing individual program modules (functions, classes, etc.).
2. Integration testing — testing the interaction between program modules.
3. System testing — testing the entire program as a whole.
4. Acceptance testing — testing the program by the customer.
5. Regression testing — testing the program after changes have been made.
6. Performance testing — testing the program's performance.
7. Security testing — testing the program's security.

According to Kent Beck[^6], writing unit tests is the developer's responsibility. Unit tests help ensure the correctness of individual modules and detect errors at early development stages. Unit tests are usually written together with the program code (and sometimes before writing the code) and are run automatically during the project build.

Special frameworks are usually used for writing unit tests, such as Google Test[^7], Catch2[^8], etc. These frameworks make it easy to write and run tests, as well as automatically check test results.

However, you can write a simple test without using a framework. For example, to test a function that adds two numbers, you can write the following test:

```cpp
#include <cassert>

int add(int a, int b) {
    return a + b;
}

int main() {
    assert(add(2, 3) == 5);
    assert(add(-2, 3) == 1);
    assert(add(0, 0) == 0);

    return 0;
}
```

## Programming Idioms

A programming idiom is a standard way of writing code that is most efficient and convenient for solving a particular task. Programming idioms are usually part of the language and include standard patterns, algorithms, and data structures. Programming idioms can be considered low-level design patterns[^9] used to solve specific problems.

### Basic Idioms

#### Increment and Decrement

One standard programming task is counting (elements, operations performed, etc.). The standard solution is to introduce a counter variable and increase (or decrease) its value by one. In some languages, the following syntax is used:

```basic
i = i + 1
```

In C-like languages, the increment operator `++` is used for this task:

```cpp
i++;
```

Similarly, the decrement operator `--` is used to decrease the value:

```cpp
i--;
```

#### Swap

A typical programming task is swapping the values of two variables. The standard solution is to use a third variable:

```cpp
template <typename T>
void swap(T& a, T& b) {
    T tmp = a;
    a = b;
    b = tmp;
}
```

However, if you need to swap the values of two containers, element-wise swapping is inefficient. Usually, a container contains a pointer to the memory it manages, so swapping pointers is a more efficient solution:

```cpp
template <typename T>
void swap(T*& a, T*& b) {
    T* tmp = a;
    a = b;
    b = tmp;
}
```

### RAII

_RAII_ (Resource Acquisition Is Initialization) is a programming idiom that means resources should be acquired in the object's constructor and released in the destructor. This ensures that resources are released in case of an exception or when leaving a block.

Example implementation of RAII for working with files:

```cpp
class File {
public:
    File(const std::string& filename) : file(fopen(filename.c_str(), "r")) {
        if (!file) {
            throw std::runtime_error("Failed to open file");
        }
    }

    ~File() {
        if (file) {
            fclose(file);
        }
    }

    void read() {
        // ...
    }

private:
    FILE* file;
};
```

### Pimpl

_Pimpl_ (Pointer to Implementation) is a programming idiom in which the implementation of a class is moved to a separate class, which is stored in a smart pointer in the main class. This hides the class implementation from the client and reduces the dependency between the interface and the implementation.

```cpp
class Widget {
public:
    Widget();
    ~Widget();

    void doSomething();

private:
    class Impl;
    std::unique_ptr<Impl> impl;
};

class Widget::Impl {
public:
    void doSomething() {
        // ...
    }
};

Widget::Widget() : impl(std::make_unique<Impl>()) {}

Widget::~Widget() = default;

void Widget::doSomething() {
    impl->doSomething();
}
```

## Bibliography

[^1]: [Kernighan B., Pike R., The Practice of Programming, Addison-Wesley, 1999](https://www.google.com/search?q=Kernighan+Pike+The+Practice+of+Programming)
[^2]: [Sutter H., Alexandrescu A., C++ Coding Standards: 101 Rules, Guidelines, and Best Practices, Pearson Education, 2004](https://www.google.com/search?q=C%2B%2B+Coding+Standards%3A+101+Rules%2C+Guidelines%2C+and+Best+Practices)
[^3]: [Google C++ Style Guide, Google, github.io](https://google.github.io/styleguide/cppguide.html)
[^4]: [Doxygen, doxygen.nl](https://www.doxygen.nl)
[^5]: [Javadoc, Oracle](https://www.oracle.com/java/technologies/javase/javadoc.html)
[^6]: [Beck Kent, Test-Driven Development: By Example, Addison-Wesley, 2002](https://www.google.com/search?q=Beck+Kent+Test-Driven+Development)
[^7]: [Google Test, Google, github.com](https://github.com/google/googletest)
[^8]: [Catch2, catchorg, github.com](https://github.com/catchorg/Catch2)
[^9]: [Programming Patterns, Wikipedia](https://en.wikipedia.org/wiki/Software_design_pattern)
