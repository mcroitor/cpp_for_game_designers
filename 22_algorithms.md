# Algorithms

- [Algorithms](#algorithms)
  - [The Concept of an Algorithm](#the-concept-of-an-algorithm)
    - [Functors](#functors)
    - [Predicates](#predicates)
    - [Naming Rules for Algorithms in STL](#naming-rules-for-algorithms-in-stl)
  - [Non-modifying Algorithms](#non-modifying-algorithms)
    - [Search Operations](#search-operations)
  - [Modifying Algorithms](#modifying-algorithms)
    - [Copying](#copying)
    - [Filling](#filling)
    - [Transformation](#transformation)
    - [Removal](#removal)
    - [Reordering](#reordering)
    - [Sorting](#sorting)
  - [Algorithm Structure](#algorithm-structure)
    - [Searching for an Element in a Collection](#searching-for-an-element-in-a-collection)
    - [Searching for an Element Satisfying a Condition](#searching-for-an-element-satisfying-a-condition)
    - [Copying Elements Satisfying a Condition](#copying-elements-satisfying-a-condition)
  - [Usage Examples](#usage-examples)
    - [Reading and Outputting Data](#reading-and-outputting-data)
    - [Finding the First Even Number in a Vector](#finding-the-first-even-number-in-a-vector)
    - [Reading, Sorting, and Searching](#reading-sorting-and-searching)
  - [Bibliography](#bibliography)

## The Concept of an Algorithm

> [!TIP]
> An algorithm is a finite sequence of actions leading to a desired result.

The implementations of algorithms in the C++ standard library are very simple and efficient. Therefore, it is useful to spend some time reading the source code.

All algorithms in the Standard Template Library are separated from the implementation details of data structures and use iterator types as parameters. Therefore, they can work with user-defined data structures, as long as those data structures have iterator types that satisfy the assumptions in the algorithms.

STL algorithms mainly operate on containers and use half-open iterator intervals as parameters.

### Functors

> [!TIP]
> A functor is an object of a class in which the parentheses operator is overloaded.

In a class declaration, you can overload the `()` operator (parentheses). If this operator is overloaded in a class, objects of this class acquire the properties of functions (they can be used as functions). Such objects are called function objects or functors. Functors are convenient when a function needs to have "memory," as well as a replacement for function pointers.

 > Sometimes, a function object is understood as a function pointer.

Example of a functor that swaps the values of two integer variables and counts the number of calls:

```cpp
/**
 * @file swap_functor.cpp
 * @brief Example of using a function object
 * @details g++ -std=c++20 -o swap_functor swap_functor.cpp
 */
class _swap{
    static size_t counter;
    static void increment() { ++counter; }
public:
    _swap(){}
    void operator ()(int& a, int& b){
        int tmp = a;
        a = b;
        b = tmp;
        increment();
    }
    int getNrCalls() {return counter; }
};

size_t _swap::counter = 0;

int main() {
    _swap swap;
    int a = 3, b = 5;
    swap(a, b);
    return 0;
}
```

### Predicates

> [!TIP]
> A predicate is a function that returns a boolean value.

STL algorithms operate with unary and binary predicates.

Example of a predicate to check if a number is odd:

```cpp
bool isOdd(int value) {
   return value % 2 == 1;
}
```

### Naming Rules for Algorithms in STL

For some algorithms, both in-place versions (i.e., the result is stored in the segment specified by the iterators) and copying versions are provided. The decision to include a copying version in the library was based on the efficiency of the algorithm. When the cost of performing the operation dominates the cost of copying, the copying version is not included. For example, `sort_copy` is not included, since the cost of sorting is much higher, and users could just as well do a `copy` before `sort`.

The copying version of an algorithm `algorithm` is called `algorithm_copy` (the `_copy` suffix is added). In copying algorithms, the end of the second interval is not specified, as it can be computed from the length of the first interval.

In addition, for some algorithms, predicate versions exist. Algorithms that take predicates end with the `_if` suffix (which follows the `_copy` suffix in the case of a copying algorithm).

The `Predicate` class is used whenever an algorithm expects a function object that, when applied to the result of dereferencing the corresponding iterator, returns a value convertible to `bool`. In other words, if an algorithm takes a `Predicate pred` as its parameter and `first` as its iterator parameter, it should work correctly in the construction `if (pred(*first)) {...}`. It is assumed that the function object `pred` does not apply any non-constant function to the dereferenced iterator.

The `BinaryPredicate` class is used whenever an algorithm expects a function object that, when applied to the result of dereferencing two corresponding iterators or to the dereferencing of an iterator and a type `T` (when T is part of the signature), returns a value convertible to `bool`. In other words, if an algorithm takes a `BinaryPredicate binary_pred` as its parameter and `first1` and `first2` as its iterator parameters, it should work correctly in the construction `if (binary_pred(*first, *first2)) {...}`.

`BinaryPredicate` always takes the type of the first iterator as its first parameter, so in cases where `T value` is part of the signature, it should work correctly in the context `if (binary_pred(*first, value)) {...}`. It is expected that `binary_pred` does not apply any non-constant function to the dereferenced iterators.

## Non-modifying Algorithms

These algorithms do not modify the collections they work with.

### Search Operations

Search algorithms search for elements in collections and return iterators to the found elements. If an element is not found, an iterator to the end of the collection is returned.

- `find` - searches for the first occurrence of an element in a collection.
- `find_if` - searches for the first occurrence of an element satisfying a predicate.
- `find_if_not` - searches for the first occurrence of an element not satisfying a predicate.
- `find_end` - searches for the last occurrence of a subsequence in a collection.
- `find_first_of` - searches for the first occurrence of any element from one collection in another.
- `adjacent_find` - searches for two adjacent identical elements.
- `search` - searches for the first occurrence of a subsequence in a collection.
- `all_of` - checks that all elements satisfy a predicate.
- `any_of` - checks that at least one element satisfies a predicate.
- `none_of` - checks that no elements satisfy a predicate.
- `count` - counts the number of elements satisfying a predicate.
- `count_if` - counts the number of elements satisfying a predicate.
- `mismatch` - searches for the first mismatch in two collections.
- `equal` - checks the equality of two collections.

## Modifying Algorithms

These algorithms modify the collections they work with in some way, for example, by inserting new elements, deleting, or swapping them.

### Copying

- `copy` - copies elements from one collection to another.
- `copy_if` - copies elements satisfying a predicate.
- `copy_n` - copies the first `n` elements.
- `copy_backward` - copies elements from one collection to another in reverse order.
- `move` - moves elements from one collection to another.
- `move_backward` - moves elements from one collection to another in reverse order.

### Filling

- `fill` - fills a collection with a single value.
- `fill_n` - fills the first `n` elements with a single value.
- `generate` - fills a collection with values returned by a function object.
- `generate_n` - fills the first `n` elements with values returned by a function object.

### Transformation

- `transform` - applies a function to each element of a collection.
- `replace` - replaces all occurrences of one value with another.
- `replace_if` - replaces all occurrences of elements satisfying a predicate with another value.
- `replace_copy` - copies elements from one collection to another, replacing all occurrences of one value with another.
- `replace_copy_if` - copies elements from one collection to another, replacing all occurrences of elements satisfying a predicate with another value.

### Removal

- `remove` - removes all occurrences of an element from a collection.
- `remove_if` - removes all occurrences of elements satisfying a predicate.
- `remove_copy` - copies elements from one collection to another, removing all occurrences of an element.
- `remove_copy_if` - copies elements from one collection to another, removing all occurrences of elements satisfying a predicate.
- `unique` - removes all consecutive duplicate elements.
- `unique_copy` - copies elements from one collection to another, removing all consecutive duplicate elements.

### Reordering

- `reverse` - reverses the order of elements.
- `rotate` - shifts the elements of a collection to the right. Elements that go beyond the collection are moved to the beginning.
- `rotate_copy` - copies elements from one collection to another, shifting them to the right. Elements that go beyond the collection are moved to the beginning.
- `random_shuffle` - randomly shuffles the elements of a collection.
- `shuffle` - randomly shuffles the elements of a collection using a specified random number generator.
- `shift_left` - shifts the elements of a collection to the left.
- `shift_right` - shifts the elements of a collection to the right.

### Sorting

- `sort` - sorts a collection.
- `stable_sort` - sorts a collection while preserving the order of equal elements.
- `partial_sort` - partially sorts a collection.
- `is_sorted` - checks if a collection is sorted.
- `is_sorted_until` - finds the first element that breaks the sorting order.
- `nth_element` - moves the n-th element to its place in the sorted collection.

## Algorithm Structure

STL algorithms are implemented as template functions that take iterators as parameters. The implementations of these algorithms are usually very simple and efficient. The following examples show the structure of some algorithms.

### Searching for an Element in a Collection

A full traversal of elements from the initial iterator to the final one is performed. If the element is found, an iterator to it is returned; otherwise, an iterator to the end of the collection is returned.

```cpp
template <class InputIterator, class Type>
InputIterator find(InputIterator first, InputIterator last, const Type& value) {
    while(first != last) {
        if(*first == value) {
            return first;
        }
        ++first;
    }
    return last;
}
```

### Searching for an Element Satisfying a Condition

A full traversal of elements from the initial iterator to the final one is performed. If an element satisfying the condition (predicate) is found, an iterator to it is returned; otherwise, an iterator to the end of the collection is returned.

```cpp
template <class InputIterator, class Predicate>
InputIterator find_if(InputIterator first, InputIterator last, Predicate pred) {
    while(first != last) {
        if(pred(*first)) {
            return first;
        }
        ++first;
    }
    return last;
}
```

### Copying Elements Satisfying a Condition

A full traversal of elements from the initial iterator to the final one is performed. If an element satisfying the condition (predicate) is found, it is copied to another collection.

```cpp
template <class InputIterator, class OutputIterator, class Predicate>
OutputIterator copy_if( InputIterator first1, InputIterator last1,
  OutputIterator first2, Predicate predicate) {
    while(first1 != last1){
        if(predicate(*first1)){
            *first2 = *first1;
            ++ first2;
        }
        ++first1;
    }
    return first2;
}
```

## Usage Examples

### Reading and Outputting Data

Reading an array of integers from the standard input into a vector and outputting this vector to the screen.

```cpp
/**
 * @file read_write_vector.cpp
 * @brief Example of reading and outputting data
 * @details g++ -std=c++20 -o read_write_vector read_write_vector.cpp
 */
#include <iostream>
#include <vector>
#include <iterator>
#include <algorithm>

int main() {
    std::vector<int> v;
    std::copy(
      std::istream_iterator<int>(std::cin),
      std::istream_iterator<int>(),
      std::back_inserter(v));
    
    std::copy(
      v.begin(),
      v.end(),
      std::ostream_iterator<int>(std::cout, " "));
    return 0;
}
```

### Finding the First Even Number in a Vector

Given a vector of integers. Find the first even number.

```cpp
/**
 * @file find_even_number.cpp
 * @brief Example of finding the first even number in a vector
 * @details g++ -std=c++20 -o find_even_number find_even_number.cpp
 */
#include <iostream>
#include <vector>
#include <algorithm>

int main() {
    std::vector<int> v = {1, 3, 5, 7, 9, 2, 4, 6, 8, 10};
    auto it = std::find_if(v.begin(), v.end(), [](int x) { return x % 2 == 0; });
    if(it != v.end()) {
        std::cout << *it << std::endl;
    }
    return 0;
}
```

### Reading, Sorting, and Searching

A file contains a list of students in the following format:

- each line represents one student;
- the line contains the student's first name, last name, and test grade. The data is separated by a semicolon.

Read the data from the file, select all those whose grade is above the passing score (i.e., greater than `5`), and output them to the screen in tabular form in descending order of grade.

```cpp
/**
 * @file read_sort_search.cpp
 * @brief Example of reading, sorting, and searching
 * @details g++ -std=c++20 -o read_sort_search read_sort_search.cpp
 */
#include <iostream>
#include <fstream>
#include <sstream>
#include <string>
#include <vector>
#include <iterator>
#include <algorithm>
#include <format>

const std::string_view LINE_FORMAT = "{:<16} {:<16} {:>5}";

struct TestInfo {
    std::string name;
    std::string surname;
    float grade;
};

std::ostream& operator<<(std::ostream& os, const TestInfo& ti) {
    os << std::format(LINE_FORMAT, ti.name, ti.surname, ti.grade);
    return os;
}

std::istream& operator>>(std::istream& is, TestInfo& ti) {
    std::string line;
    if (std::getline(is, line)) {
        std::istringstream iss(line);
        std::getline(iss, ti.name, ';');
        std::getline(iss, ti.surname, ';');
        iss >> std::ws >> ti.grade;
    }
    return is;
}

int main() {
    std::ifstream file("students.txt");
    if (!file.is_open()) {
        std::cerr << "Error: file not found\n";
        return 1;
    }

    std::vector<TestInfo> students;
    std::copy(
        std::istream_iterator<TestInfo>(file),
        std::istream_iterator<TestInfo>(),
        std::back_inserter(students));

    std::cout << std::format(LINE_FORMAT, "Name", "Surname", "Grade") << '\n';

    std::sort(
        students.begin(),
        students.end(), 
        [](const TestInfo& a, const TestInfo& b) {
            return a.grade > b.grade;
        });

    std::copy_if(
        students.begin(), 
        students.end(), 
        std::ostream_iterator<TestInfo>(std::cout, "\n"), [](const TestInfo& ti) {
            return ti.grade > 5;
        });

    return 0;
}
```

## Bibliography

1. [cppreference.com](https://en.cppreference.com/w/cpp/algorithm)
2. [C++ Standard Library Reference, Microsoft](https://learn.microsoft.com/en-us/cpp/standard-library/cpp-standard-library-reference)
3. [Scott Meyers. Effective STL](https://www.google.com/search?q=Scott+Meyers.+Effective+STL)
