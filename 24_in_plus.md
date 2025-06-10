# Additional Features of the C++ Standard Library

- [Additional Features of the C++ Standard Library](#additional-features-of-the-c-standard-library)
  - [Lambda Expressions](#lambda-expressions)
  - [String Formatting](#string-formatting)
  - [User-defined Literals](#user-defined-literals)
  - [Move Semantics](#move-semantics)
  - [Tuples](#tuples)
  - [Ranges](#ranges)
  - [Smart Pointers](#smart-pointers)
  - [valarray](#valarray)
  - [variant, optional, any](#variant-optional-any)
  - [Regular Expressions](#regular-expressions)
  - [Bibliography](#bibliography)

## Lambda Expressions

Since the `C++11` standard, the language allows you to write computations in a compact form—using __lambda expressions__.

Syntax:

```cpp
[/*capture*/](/*params*/) -> /*type*/ { /*code*/; }
```

```cpp
// Named lambda expression
auto sum = [](int a, int b) {return a + b;};
auto result = sum(a, b);

// Lambda expression declared in place
std::cout << [](int a, int b) {return a + b;}(10, 15);
```

By default, lambda expressions do not have access to external variables (except for global and static variables), but you can list all variables that should be accessible in the lambda expression in the square brackets, separated by commas.

```cpp
int a = 10;

std::cout << [a]{ return a;}();
```

Lambda expressions can be generic (generic lambda) if at least one parameter is declared as `auto`.

```cpp
int arr[] {1, 2, 3, 4, 5, 6};

std::for_each(arr, arr + 6, [](auto el){ std::cout << el << " ";});
```

## String Formatting

Since `C++20`, the standard library provides the ability to format strings using the `std::format` function. The `std::format` function takes a format string and arguments to be inserted into the string. The format string contains format specifiers, which start with `{` and end with `}`.

```cpp
/**
 * @file format.cpp
 * @brief Example of using std::format
 * @details g++ -std=c++20 format.cpp -o format
 */
#include <format>
#include <iostream>

int main()
{
    std::string name = "John";
    int age = 25;

    std::string result = std::format("Name: {}, Age: {}", name, age);
    std::cout << result << std::endl;
    return 0;
}
```

Format specifiers can contain the following elements, in order:

```text
[[fill]align][sign][#][0][width][.precision][type]
```

- `fill` - character used to fill empty space;
- `align` - alignment: `<` - left, `>` - right, `^` - center;
- `sign` - sign of the number: `+` - always, `-` - only negative, ` ` - space for positive numbers;
- `#` - alternate form;
- `0` - zero padding;
- `width` - minimum field width;
- `precision` - number of digits after the decimal point;
- `type` - data type: `f` - floating point, `g` - general format, `e` - exponential format, `x` - hexadecimal, etc.

The following example shows how to use `std::format` to format a table:

```cpp
/**
 * @file format_table.cpp
 * @brief Example of formatting a table using std::format
 * @details g++ -std=c++20 format_table.cpp -o format_table
 */
#include <format>
#include <iostream>
#include <vector>

int main()
{
  std::vector<std::tuple<std::string, std::string, int>> data = {
    {"John", "Doe", 25},
    {"Jane", "Smith", 30},
    {"Alice", "Brown", 35}
  };

  std::cout << std::format("| {:<10} | {:<10} | {:>3} |", "First", "Last", "Age") << std::endl;
  std::cout << std::format("|{:-^12}|{:-^12}|{:-^5}|", "", "", "") << std::endl;
  for (const auto& [first, last, age] : data)
  {
    std::string result = std::format("| {:<10} | {:<10} | {:>3} |", first, last, age);
    std::cout << result << std::endl;
  }
  return 0;
}
```

## User-defined Literals

A __literal__ in programming is a constant without a name. In C++, there are 6 types of literals:

- integers: `312`, `-1ll`
- floating-point numbers: `12.29`
- characters: `'a'`
- strings: `"sample"`
- boolean values: `true`
- pointers: `nullptr`

Since `C++11`, users can define their own literals, which allow creating objects of user-defined data types.

```cpp
ReturnType operator "" _a(unsigned long long int);   // Literal operator for user-defined INTEGRAL literal
ReturnType operator "" _b(long double);              // Literal operator for user-defined FLOATING literal
ReturnType operator "" _c(char);                     // Literal operator for user-defined CHARACTER literal
ReturnType operator "" _d(wchar_t);                  // Literal operator for user-defined CHARACTER literal
ReturnType operator "" _e(char16_t);                 // Literal operator for user-defined CHARACTER literal
ReturnType operator "" _f(char32_t);                 // Literal operator for user-defined CHARACTER literal
ReturnType operator "" _g(const char*, size_t);      // Literal operator for user-defined STRING literal
ReturnType operator "" _h(const wchar_t*, size_t);   // Literal operator for user-defined STRING literal
ReturnType operator "" _i(const char16_t*, size_t);  // Literal operator for user-defined STRING literal
ReturnType operator "" _j(const char32_t*, size_t);  // Literal operator for user-defined STRING literal
ReturnType operator "" _r(const char*);              // Raw literal operator
template<char...> ReturnType operator "" _t();       // Literal operator template
```

The suffix name for a literal can be any allowed identifier.

Example:

```cpp
// volume in liters
using volume_t = long double;

constexpr volume_t operator "" _l(long double volume){
    return volume;
}

constexpr volume_t operator "" _ml(long double volume){
    return 0.001 * volume;
}

constexpr volume_t operator "" _m3(long double volume){
    return 1000.0 * volume;
}

volume_t volume = 12.2_l + 2.1_m3 - 300.0_ml;
```

## Move Semantics

Move semantics refers to a set of specialized C++ language features that allow you to avoid the overhead of copying when creating new objects. The main elements of move semantics are the move constructor and the move assignment operator.

Move semantics enables more efficient code.

```cpp
my_string a = "hell", b = "o";
my_string result = a + b;
```

In this example, adding two strings creates a temporary object, which is copied into the variable `result` and then destroyed after the operation. However, you can avoid unnecessary copying and destruction by moving the temporary object into the variable `result`. This is done using the move assignment operator. The syntax of the assignment operator:

```cpp
T& operator = (T&& other);
```

Example code:

```cpp
class my_string {
public:
  my_string& operator=(my_string&& other) {
    if (this != &other) {
      delete[] this->_data;
      this->_data = other._data;
      other._data = nullptr;
    }
    return *this;
  }

private:
  char*_data;
};
```

This implementation can be simplified using the standard function `std::move`, which performs move semantics on the object:

```cpp
class my_string {
public:
  my_string(my_string&& other) : _data(std::move(other._data)) {
    other._data = nullptr;
  }

  my_string& operator=(my_string&& other) {
    _data = std::move(other._data);
    return *this;
  }

private:
  char* _data;
};
```

## Tuples

Tuples are data structures that allow you to store several elements of different types. Tuples are defined in the `<tuple>` header. Tuples can be used to return multiple values from a function.

Example of using tuples:

```cpp
/**
 * @file tuple.cpp
 * @brief Example of using tuples
 * @details g++ -std=c++20 tuple.cpp -o tuple
 */
#include <tuple>
#include <iostream>

std::tuple<int, double, std::string> get_data()
{
    return {10, 3.14, "Hello"};
}

int main()
{
    auto [a, b, c] = get_data();
    std::cout << a << " " << b << " " << c << std::endl;

    std::tuple<int, double, std::string> values = {10, 3.14, "Hello"};
    std::cout << std::get<0>(values) << " " 
              << std::get<1>(values) << " " 
              << std::get<2>(values) << std::endl;
    return 0;
}
```

## Ranges

Most STL algorithms operate on container ranges defined as a pair of iterators. Therefore, since `C++20`, the standard library introduces a generalization of ranges as a pair of iterators.

The ranges library defines the following concepts:

- `range` – a range, which is a pair of iterators: beginning and end. Defined in the `std::ranges` namespace.
- `view` – a range adapter that allows transforming and filtering range elements. Defined in the `std::ranges::views` namespace.
- `algorithm` – algorithms that accept ranges as arguments. Defined in the `std::ranges::algorithm` namespace.

Example of using ranges:

```cpp
/**
 * @file ranges.cpp
 * @brief Example of using ranges
 * @details g++ -std=c++20 ranges.cpp -o ranges
 */
#include <ranges>
#include <numeric>
#include <iostream>
#include <vector>

int main()
{
    std::vector<int> numbers = {1, 2, 3, 4, 5, 6, 7, 8, 9, 10};

    auto reverse_numbers = numbers | std::views::reverse;

    std::ranges::for_each(reverse_numbers, [](int el){ std::cout << el << " "; });
    std::cout << std::endl;

    return 0;
}
```

The use of range adapters is based on ideas from functional programming, allowing for pipeline data processing. The pipeline is implemented using the overloaded `|` operator to pass data between adapters.

Some interesting range adapters:

- `views::all` – convert a container to a range
- `views::filter` – select elements by property
- `views::transform` – change each element
- `views::take` – select the first _N_ elements
- `views::take_while` – select elements while a condition is true
- `views::drop` – skip the first _N_ elements
- `views::drop_while` – skip elements while a condition is true
- `views::reverse` – reverse the order of elements
- `views::join` – join sequences
- `views::split` – split a sequence into subsequences
- `views::keys` – select keys from a pair, tuple, or associative container
- `views::values` – select values from a pair, tuple, or associative container
- `views::zip` – combine several sequences into one, elements with the same index are combined into a tuple

Example of use:

```cpp
/**
 * @file ranges_pipeline.cpp
 * @brief Example of using ranges for pipeline data processing
 * @details g++ -std=c++20 ranges_pipeline.cpp -o ranges_pipeline
 */
#include <ranges>
#include <iostream>
#include <vector>
#include <algorithm>

int main()
{
    std::vector<int> numbers = {1, 2, 3, 4, 5, 6, 7, 8, 9, 10};

    // Select even numbers and multiply them by 2
    auto result = numbers | std::views::filter([](int el){ return el % 2 == 0; })
            | std::views::transform([](int el){ return el * 2; });
    
    // Output the result
    std::ranges::for_each(result, [](int el){ std::cout << el << " "; });

    return 0;
}
```

## Smart Pointers

Since `C++11`, the C++ standard library offers an abstraction (wrapper) over pointers that automatically frees memory when variables go out of scope.

The following types of smart pointers are available:

- `unique_ptr` – when assigning a smart pointer object `Ptr1` to `Ptr2`, `Ptr2` becomes the owner of the memory (the pointer is moved), while `Ptr1` points to `nullptr`.
- `shared_ptr` – when copying a smart pointer object `Ptr1` to `Ptr2`, both variables point to the same memory; memory is freed when both variables are destroyed.
- `weak_ptr` – a _weak_ reference to allocated memory: cannot delete/modify memory and always refers to memory created by `shared_ptr`.

## valarray

The template class `std::valarray` is declared in the `valarray` header. It allows you to perform arithmetic operations on vectors.

Example of use:

```cpp
std::valarray<int> a{1, 2, 3};
std::valarray<int> b{1, 2, 3};
std::valarray<int> result = a * 5 + b;
result = result.apply([](int el){ return el - 1; });
for (auto element : result)
{
    std::cout << element << " ";
}
```

## variant, optional, any

Special containers `std::variant`, `std::optional`, and `std::any` allow you to store values of different types in a single object.

- `std::variant` – an alternative to using pointers and references to store values of different types.
- `std::optional` – a container that can store a value or be empty.
- `std::any` – a container that can store values of any type.

Example of use:

```cpp
/**
 * @file variant.cpp
 * @brief Example of using std::variant
 * @details g++ -std=c++17 variant.cpp -o variant
 */
#include <optional>
#include <iostream>

std::optional<int> divide(int a, int b)
{
    if (b == 0)
    {
        return std::nullopt;
    }
    return a / b;
}

int main()
{
    auto result = divide(10, 0);

    if (result.has_value())
    {
        std::cout << "Result: " << result.value() << std::endl;
    }
    else
    {
        std::cout << "Division by zero" << std::endl;
    }
    return 0;
}
```

## Regular Expressions

> __Regular expressions__ are a formal language describing string patterns. Regular expressions are used for searching and replacing text in strings, as well as for input validation.

The C++ standard library provides the ability to work with regular expressions. For this, the `std::regex` class is used. To work with regular expressions, include the `<regex>` header.

The following example checks whether a string is a valid email address:

```cpp
/**
 * @file regex_email.cpp
 * @brief Example of using regular expressions to validate an email address
 * @details g++ -std=c++11 regex_email.cpp -o regex_email
 */
#include <regex>
#include <iostream>

int main()
{
    std::string email = "i@love.you";
    std::regex pattern(R"((\w+)(\.|_)?(\w*)@(\w+)(\.(\w+))+)");

    if (std::regex_match(email, pattern))
    {
        std::cout << "Valid email" << std::endl;
    }
    else
    {
        std::cout << "Invalid email" << std::endl;
    }
    return 0;
}
```

In this example, the regular expression `(\w+)(\.|_)?(\w*)@(\w+)(\.(\w+))+` checks that the string matches the email address pattern.

- `(\w+)` – one or more alphanumeric characters
- `(\.|_)?` – dot or underscore, optional
- `(\w*)` – zero or more alphanumeric characters
- `@` – the @ symbol
- `(\w+)` – one or more alphanumeric characters
- `(\.(\w+))+` – one or more sequences: dot and one or more alphanumeric characters

## Bibliography

1. [Standard format specification, cppreference.com](https://en.cppreference.com/w/cpp/utility/format/spec)
2. [User-defined literals, cppreference.com](https://en.cppreference.com/w/cpp/language/user_literal)
3. [Ranges library, cppreference.com](https://en.cppreference.com/w/cpp/ranges)
4. [Smart pointers, cppreference.com](https://en.cppreference.com/w/cpp/memory)
5. [valarray, cppreference.com](https://en.cppreference.com/w/cpp/numeric/valarray)
6. [variant, cppreference.com](https://en.cppreference.com/w/cpp/utility/variant)
7. [optional, cppreference.com](https://en.cppreference.com/w/cpp/utility/optional)
8. [any, cppreference.com](https://en.cppreference.com/w/cpp/utility/any)
9. [Regular expressions, cppreference.com](https://en.cppreference.com/w/cpp/regex)
