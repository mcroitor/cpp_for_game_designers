# Basics of Metaprogramming

- [Basics of Metaprogramming](#basics-of-metaprogramming)
  - [Function Templates](#function-templates)
  - [Class Templates](#class-templates)
  - [Template Instantiation](#template-instantiation)
  - [Function Template Overloading](#function-template-overloading)
  - [Template Specialization](#template-specialization)
  - [Bibliography](#bibliography)

__Generative programming__ (metaprogramming) is a software development paradigm based on the ideas of describing models and transforming these models into program code (or a program).

The main mechanism of generative programming in C++ is the use of class templates, function templates, and their specializations [^1].

## Function Templates

A __function template__ is a general description of a family of functions (a generic algorithm).

Let us consider the concept of a function template with an example. Suppose we have implemented a function that swaps the values of two integer variables:

```cpp
void swap(int& a, int& b){
  int tmp = a;
  a = b;
  b = tmp;
}
```

However, to swap the values of two floating-point variables, we would have to add the following function to the program, using function overloading:

```cpp
void swap(float& a, float& b){
  float tmp = a;
  a = b;
  b = tmp;
}
```

Thus, for each type, we have to redefine the function.

However, for each data type, the function looks the same, except for the variable types. Therefore, C++ offers the template mechanism, which allows you to describe a family of functions. An example of a corresponding template that swaps the values of two variables is shown below:

```cpp
template<typename TYPE>
void swap(TYPE& a, TYPE& b){
  TYPE tmp = a;
  a = b;
  b = tmp;
}
```

The template definition starts with the special construct `template<typename TYPE, ...>` where the template parameters are specified in angle brackets. There can be any number of template parameters; a parameter can be a type or an enumerated value (an integer type or enumeration).

> In addition to the `typename` keyword, you can also use the `class` keyword to declare template parameters.

As long as the _swap_ function is not called in the program, it is not created (instantiated) in binary code during compilation. If you declare a group of function calls with variables of different types, the compiler will create its own implementation for each based on the template.

Moreover, an enumerated type (for example, `int`) can be used as a template parameter for a function.

Calling a template function is generally equivalent to calling a regular function. In this case, the compiler determines which type to use instead of `TYPE` based on the types of the actual parameters. But if the substituted parameters turn out to be of different types, the compiler will not be able to deduce (instantiate the template for) the function implementation:

```cpp
/**
 * @file metaprogramming_01.cpp
 * @brief Example of using function templates
 * @details g++ metaprogramming_01.cpp -o metaprogramming_01
 */
#include <iostream>
template<class TYPE>
TYPE min(TYPE a, TYPE b) {
    if (a < b) {
        return a;
    }
    return b;
}

int main(int argc, char** argv) {
    std::cout << min(1, 2) << std::endl; // OK
    std::cout << min(3.1, 1.2) << std::endl; // OK
    std::cout << min(5, 2.1) << std::endl; // Error, the compiler cannot deduce a common type.
    return 0;
}
```

This problem can be solved by explicitly specifying the type to be substituted in the template:

```cpp
/**
 * @file metaprogramming_02.cpp
 * @brief Explicit type specification in a function template
 * @details g++ metaprogramming_02.cpp -o metaprogramming_02
 */
#include <iostream>
template<class TYPE>
TYPE min(TYPE a, TYPE b) {
    if (a < b) {
        return a;
    }
    return b;
}

int main(int argc, char** argv) {
    std::cout << min(1, 2) << std::endl; // OK
    std::cout << min(3.1, 1.2) << std::endl; // OK
    std::cout << min<double>(5, 2.1) << std::endl; // OK
    return 0;
}
```

__When will a function template (not) work?__

At the compilation stage, the compiler substitutes the required (most suitable) type into the template. But will the resulting function always be workable? Obviously not. Any algorithm can be defined independently of the data type, but it necessarily uses the properties of these data. In the case of the template function _min_, this is the requirement for the ordering operator (the `<` operator).

Any function template assumes the presence of certain properties of the parameterized type, depending on the implementation (for example, a copy operator, a comparison operator, the presence of a certain method, etc.). In the current C++ standard, this is handled by the concept of _concepts_ [^2].

## Class Templates

A __class template__ is a description of a set of data types with the same behavior [^3].

The standard example of a class template is containers. However, their application is not limited to this.

Example of a class template description:

```cpp
template<typename TYPE>
class Box{
    // implementation
    TYPE value_;
public:
    typedef TYPE valueType;

    Box(TYPE value): value_(value) {}
    const TYPE& value() const {
        return value_;
    }
};
```

In C++ programming practice, classes are usually split into two files: a header file (`.h`) and an implementation file (`.cpp`). However, the specifics of defining class templates require both declaration and implementation to be in the same file, usually the header file.

## Template Instantiation

The term _instantiation_ (creating an instance) can refer to both variable declaration and the creation of specific implementations of template functions.

_Template instantiation_ is the generation of code for a function or class from a template for specific parameters. There is _implicit instantiation_, which occurs when a function is called or a class object is created, and _explicit instantiation_ using the reserved word `template`.

Example of instantiating the `swap` function:

```cpp
/**
 * @file metaprogramming_03.cpp
 * @brief Example of function template instantiation
 * @details g++ metaprogramming_03.cpp -o metaprogramming_03
 */
#include <iostream>

template<typename TYPE>
void swap(TYPE& p1, TYPE& p2) {
  TYPE tmp = p1;
  p1 = p2;
  p2 = tmp;
}

// explicit instantiation
template void swap(int&, int&);

int main() {
  double a = 10;
  double b = 12;
  std::cout << "a: " << a << ", b: " << b << std::endl;
  // implicit instantiation
  swap(a, b);
  std::cout << "a: " << a << ", b: " << b << std::endl;
  return 0;
}
```

In the example above, explicit instantiation can be performed for all required types. In this case, each instantiated function will be added to the program's binary code at compile time.

## Function Template Overloading

Function templates can be overloaded; in this case, they will differ only in the parameters of the function itself. A good example is overloading the `swap` function for pointers:

```cpp
/**
 * @file metaprogramming_04.cpp
 * @brief Example of function template overloading
 * @details g++ metaprogramming_04.cpp -o metaprogramming_04
 */
#include <iostream>

template<typename TYPE>
void swap(TYPE& p1, TYPE& p2) {
  TYPE tmp = p1;
  p1 = p2;
  p2 = tmp;
}

template<typename TYPE>
void swap(TYPE* p1, TYPE* p2) {
  TYPE tmp = *p1;
  *p1 = *p2;
  *p2 = tmp;
}

int main() {
  double a = 10;
  double b = 12;

  double* p1 = &a;
  double* p2 = &b;
  std::cout << "*p1: " << *p1 << ", *p2: " << *p2 << std::endl;
  // implicit instantiation
  swap(p1, p2);
  std::cout << "*p1: " << *p1 << ", *p2: " << *p2 << std::endl;
  return 0;
}
```

## Template Specialization

You can _specialize_ a template, i.e., change the implementation of a function template, individual methods of a class template, or the entire class template for specific data types.

For functions and individual methods, only full specialization is allowed. Before the specialization definition, write `template <>`, and after the function or class name, add the list of arguments of the main template in `<>`. Similar functionality can be achieved by defining a regular function or overloading a function template. The difference is that code generation for a regular function occurs when its definition is compiled (i.e., always), while for a template and specialization, it happens at the first use (instantiation).

Example of template specialization:

```cpp
template<typename TYPE>
void print(TYPE p) {
  std::cout << p.toString() << std::endl;
}
template<>
void print(int p) {
  std::cout << p << std::endl;
}
template<>
void print(float p) {
  std::cout << p << std::endl;
}
template<>
void print(std::string p) {
  std::cout << p << std::endl;
}
```

In this example, the parameterized template `print` will only work with types that have a `toString()` method. However, for the types `int`, `float`, and `std::string`, their own implementations are defined.

Another example showing the use of template specialization for compile-time calculations:

```cpp
/**
 * @file fibonacci.cpp
 * @brief Example of calculating Fibonacci numbers at compile time
 * @details g++ fibonacci.cpp -o fibonacci
 */
#include <iostream>

template <size_t index>
size_t fibonacci()
{
    return fibonacci<index - 1>() + fibonacci<index - 2>();
}

template <>
size_t fibonacci<0>()
{
    return 0;
}

template <>
size_t fibonacci<1>()
{
    return 1;
}

int main()
{
    std::cout << fibonacci<10>() << std::endl;
    return 0;
}
```

## Bibliography

[^1]: [David Vandevoorde, Nicolai M. Josuttis. C++ Templates: The Complete Guide](https://www.google.com/search?client=opera&q=David+Vandevoorde%2C+Nicolai+M.+Josuttis.+C%2B%2B+Templates%3A+The+Complete+Guide&sourceid=opera&ie=UTF-8&oe=UTF-8)
[^2]: [Concepts, cppreference.com](https://en.cppreference.com/w/cpp/concepts)
[^3]: [Templates, cppreference.com](https://en.cppreference.com/w/cpp/language/templates)
