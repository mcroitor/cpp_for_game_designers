# Iterators and Containers

- [Iterators and Containers](#iterators-and-containers)
  - [The C++ Standard Library](#the-c-standard-library)
  - [Iterators](#iterators)
    - [Input Iterators](#input-iterators)
    - [Output Iterators](#output-iterators)
    - [Forward Iterators](#forward-iterators)
    - [Bidirectional Iterators](#bidirectional-iterators)
    - [Random Access Iterators](#random-access-iterators)
  - [Containers](#containers)
  - [Sequential Containers](#sequential-containers)
    - [Vector](#vector)
    - [List](#list)
    - [Deque](#deque)
  - [Associative Containers](#associative-containers)
    - [Set](#set)
    - [Map](#map)
  - [Bibliography](#bibliography)

## The C++ Standard Library

The C++ standard includes not only the description of the language core (its syntax, semantics, etc.), but also the description of the standard library. The main part of the C++ standard library is the Standard Template Library (STL).

The Standard Template Library provides a set of well-designed and consistently working generic C++ components. Special care has been taken to ensure that all template algorithms work not only with the data structures in the library, but also with built-in C++ data structures. For example, all algorithms work with ordinary pointers. The orthogonal design of the library (i.e., each part is independent and self-contained) allows programmers to use library data structures with their own algorithms, and library algorithms with their own data structures. Well-defined semantic and complexity requirements guarantee that a user component will work with the library and will work efficiently. This flexibility ensures the wide applicability of the library.

Another important consideration is efficiency. C++ is successful because it combines expressive power with efficiency. Much effort has been spent to ensure that each component in the library has a generic implementation that provides performance comparable to hand-written code.

The C++ standard library consists of several parts:

- the C standard library;
- C++ language support;
- concepts;
- diagnostics library;
- memory management;
- data streams;
- STL library;
- thread management;
- some additional libraries.

The header files of the standard library follow these rules: the header file is written without an extension; C language libraries start with the letter 'c' (for example, instead of math.h, use `cmath`). The C++ standard library is declared in the __std__ namespace.

The largest part of the C++ standard library is the STL (Standard Template Library). The STL contains five main types of components:

- _algorithm_: defines a computational procedure.
- _container_: manages a set of objects in memory.
- _iterator_: provides algorithms with a means of accessing the contents of a container.
- _function object_: encapsulates a function in an object for use by other components.
- _adaptor_: adapts a component to provide a different interface.
- _range_: represents a pair of iterators denoting the beginning and end of a sequence.

This separation allows us to reduce the number of components. For example, instead of writing a search function for each type of container, we provide a single version that works with any container as long as a basic set of requirements is met.

## Iterators

The concept of iterators is closely related to the concept of containers. A __container__ is an object that contains a group of other (usually homogeneous) objects. Thus, well-known data structures such as vector, list, stack, map, are containers.

Iterators are used to access the elements of containers. An __iterator__ is an object that provides access to the elements of a container and allows them to be traversed. In the first implementations of the C++ standard library, an iterator was implemented as a pointer to a container element.

There are several types of iterators. They form a hierarchy and differ from each other by the presence (or absence) of certain properties:

- __Input iterators__ allow you to read values from a container.
- __Output iterators__ allow you to write values into a container.
- __Forward iterators__ are basic for most algorithms and inherit the properties of input and output iterators.
- __Bidirectional iterators__ allow you to move through containers both forwards and backwards.
- __Random access iterators__ have the properties of bidirectional iterators, and also support distance calculation and ordering operations.

Iterators have the following basic properties:

| Property         | Expression        | Note                                         |
| ---------------- | ---------------- | -------------------------------------------- |
| Copy constructor | `It(j);`         | Creates a copy of the iterator. Destructor is assumed to exist |
|                  | `It i(j);`       |                                              |
|                  | `It i = j;`      |                                              |
| Dereference      | `*i`             | Returns a reference to the container element |
| Prefix increment | `++i`            | Advances the iterator to the next element    |
| Postfix increment| `i++`            | Advances the iterator to the next element    |

### Input Iterators

Input iterators allow you to read values from a container.

Input iterators have the following properties:

| Property         | Expression        | Note                                         |
| ---------------- | ---------------- | -------------------------------------------- |
| Assignment       | `i = j`          |                                              |
| Equality         | `i == j`         |                                              |
| Inequality       | `i != j`         |                                              |

### Output Iterators

Output iterators allow you to write values into a container.

| Property         | Expression        | Note                                         |
| ---------------- | ---------------- | -------------------------------------------- |
| Assign element   | `*i = a`         | Returns a reference to the container element, allows inserting elements into the container via the iterator |

### Forward Iterators

Forward iterators are basic for most algorithms and inherit the properties of input and output iterators. They also have a number of additional properties.

### Bidirectional Iterators

Bidirectional iterators allow you to move through containers both forwards and backwards. They have all the properties of forward iterators, as well as:

| Property         | Expression        | Note                                         |
| ---------------- | ---------------- | -------------------------------------------- |
| Prefix decrement | `--i`             | There exists j such that `i == ++j`. If `i == j`, then `--i == --j` |
| Postfix decrement| `i--`             | If `i == j`, then `i-- == j--`               |

### Random Access Iterators

Random access iterators have the properties of bidirectional iterators, and also support distance calculation and ordering operations.

| Property         | Expression        | Note                                         |
| ---------------- | ---------------- | -------------------------------------------- |
| Shift by n       | `i += n`         |                                              |
|                  | `i + n`          | `i + n == n + i`                             |
|                  | `n + i`          |                                              |
| Shift by n       | `i -= n`         |                                              |
|                  | `i - n`          |                                              |
| Distance         | `i - j`          | `i == j + (i - j)`                           |
| Index access     | `a[n]`           | `*(a + n)`                                   |
| Ordering         | `i < j`          | `i - j > 0`                                  |
| Ordering         | `i > j`          | `j < i`                                      |
| Ordering         | `i <= j`         | `!(j < i)`                                   |
| Ordering         | `i >= j`         | `!(i < j)`                                   |

## Containers

A container is an object that contains other (homogeneous) objects, called container elements. The C++ standard library provides typical containers such as: _list_, _vector_, _queue_, _map_, _set_, etc. Access to container elements is performed via iterators.

Containers must meet a number of general requirements. This is done so that the use of containers is uniform, regardless of their implementation. Accordingly, containers are often interchangeable.

| Property         | Expression        | Note                                         |
| ---------------- | ---------------- | -------------------------------------------- |
| Element type     | `C::value_type`  |                                              |
|                  | `C::reference`   |                                              |
|                  | `C::const_reference` |                                          |
|                  | `C::pointer`     |                                              |
| Iterator         | `C::iterator`    |                                              |
| Const iterator   | `C::const_iterator` |                                         |
|                  | `C::difference_type` |                                         |
|                  | `C::size_type`   |                                              |
| Default constructor | `C u;`        |                                              |
|                  | `C()`            |                                              |
| Copy constructor | `C(a)`           |                                              |
|                  | `C u(a);`        |                                              |
|                  | `C u = a;`       |                                              |
| Destructor       | `~C()`           |                                              |
|                  | `a.begin()`      | Returns an iterator to the first element     |
|                  | `a.end()`        | Returns an iterator to one past the last element |
| Comparison       | `a == b`         |                                              |
| Inequality       | `a != b`         |                                              |
| Copying          | `r = a`          |                                              |
|                  | `a.size()`       | Returns the number of elements in the container |
|                  | `a.max_size()`   | Returns the maximum number of elements in the container |
|                  | `a.empty()`      | `a.size() == 0`                              |
| Ordering         | `a < b`          |                                              |
|                  | `a > b`          |                                              |
|                  | `a <= b`         |                                              |
|                  | `a >= b`         |                                              |
|                  | `a.swap(b)`      |                                              |

## Sequential Containers

Sequential containers store their elements in a strictly linear order. Sequential containers include well-known data structures such as __vector__, __list__, __queue__, as well as __string__.

Required properties of sequential iterators:

| Property         | Expression        | Note                                         |
| ---------------- | ---------------- | -------------------------------------------- |
| Constructor      | `C(n, t)`        | creates a container of n elements equal to t |
|                  | `C a(n, t);`     |                                              |
|                  | `C(i, j)`        | creates a container from the specified half-open interval of iterators |
|                  | `C a(i, j);`     |                                              |
| Insertion        | `a.insert(p, t)` | inserts element t before iterator p          |
|                  | `a.insert(p, n, t)` | inserts n elements t before iterator p    |
|                  | `a.insert(p, i, j)` | inserts the half-open interval `[i, j)` before iterator p |
| Erasure          | `a.erase(i)`     | removes from the container the element pointed to by iterator i |
|                  | `a.erase(i, j)`  | removes the half-open interval `[i, j)` from the container |

### Vector

A vector is a container that contains ordered elements. A vector supports insertion, deletion, and search operations. Insertion and deletion of elements in a vector take O(n) time, where n is the number of elements in the vector.

In addition to the required properties of sequential containers, a vector has the following properties:

| Property         | Expression        | Note                                         |
| ---------------- | ---------------- | -------------------------------------------- |
| Element access   | `a[n]`           | returns a reference to the element at index n|
|                  | `a.at(n)`        | returns a reference to the element at index n. If n is out of bounds, an exception is thrown |
| Push back        | `a.push_back(t)` | adds element t to the end of the vector      |
| Pop back         | `a.pop_back()`   | removes the last element of the vector       |
| Resize           | `a.resize(n)`    | changes the size of the vector to n elements. If n is greater than the current size, new elements are initialized with the default value |
|                  | `a.resize(n, t)` | changes the size of the vector to n elements. If n is greater than the current size, new elements are initialized with value t |

Instead of dynamic arrays in C++, it is recommended to use vectors. Vectors have all the properties of dynamic arrays, but provide safety and ease of use.

Example of using a vector:

```cpp
/**
 * @file vector_example.cpp
 * @brief Example of using a vector
 * @details g++ vector_example.cpp -o vector_example -std=c++11
 */
#include <iostream>
#include <vector>

int main() {
  std::vector<int> v = {1, 2, 3, 4, 5};

  v.push_back(6);

  v[2] = 33;
  
  for(int el : v) {
    std::cout << el << " ";
  }
  std::cout << std::endl;

  return 0;
}
```

### List

A list is a container that contains ordered elements. A list supports insertion, deletion, and search operations. Insertion and deletion of elements in a list take O(1) time.

In addition to the required properties of sequential containers, a list has the following properties:

| Property         | Expression        | Note                                         |
| ---------------- | ---------------- | -------------------------------------------- |
| Push front       | `a.push_front(t)`| adds element t to the beginning of the list  |
| Push back        | `a.push_back(t)` | adds element t to the end of the list        |
| Pop front        | `a.pop_front()`  | removes the first element of the list        |
| Pop back         | `a.pop_back()`   | removes the last element of the list         |
| Front            | `a.front()`      | returns a reference to the first element     |
| Back             | `a.back()`       | returns a reference to the last element      |

### Deque

A deque (double-ended queue) is a container that contains ordered elements. A deque supports insertion and deletion of elements at both ends. Insertion and deletion at the ends of a deque take O(1) time.

In addition to the required properties of sequential containers, a deque has the following properties:

| Property         | Expression        | Note                                         |
| ---------------- | ---------------- | -------------------------------------------- |
| Push back        | `a.push_back(t)` | adds element t to the end of the deque       |
| Push front       | `a.push_front(t)`| adds element t to the beginning of the deque |
| Pop front        | `a.pop_front()`  | removes the first element of the deque       |
| Pop back         | `a.pop_back()`   | removes the last element of the deque        |
| Front            | `a.front()`      | returns a reference to the first element     |
| Back             | `a.back()`       | returns a reference to the last element      |
| Element access   | `a[n]`           | returns a reference to the element at index n|

## Associative Containers

Associative containers store their elements as key-value pairs. Associative containers include __set__, __map__, __multiset__, and __multimap__.

### Set

A set is a container that contains ordered unique elements. The elements of a set are ordered in ascending order. A set supports insertion, deletion, and search operations. Insertion and deletion in a set take O(log n) time.

> [!NOTE]
> __Table notation:__
>
> - `C` — container type (e.g., `std::set`)
> - `a` — container object
> - `i`, `j` — iterators
> - `t` — element of the container

Required properties of sets:

| Property         | Expression        | Note                                         |
| ---------------- | ---------------- | -------------------------------------------- |
| Constructor      | `C()`            | creates an empty set                         |
|                  | `C(a)`           | creates a set from another set `a`           |
|                  | `C(i, j)`        | creates a set from the specified half-open interval of iterators `[i, j)` |
| Insertion        | `a.insert(t)`    | inserts element `t` into the set             |
|                  | `a.insert(i, j)` | inserts the half-open interval `[i, j)` into the set |
| Erasure          | `a.erase(t)`     | removes element `t` from the set             |
|                  | `a.erase(i)`     | removes the element pointed to by iterator `i` |
|                  | `a.erase(i, j)`  | removes the half-open interval `[i, j)` from the set |
| Clear            | `a.clear()`      | removes all elements from the set            |
| Find             | `a.find(t)`      | returns an iterator to element `t` if it exists, otherwise returns `a.end()` |
| Count            | `a.count(t)`     | returns the number of elements equal to `t` in the set  |
| Lower bound      | `a.lower_bound(t)` | returns an iterator to the first element not less than `t` |
| Upper bound      | `a.upper_bound(t)` | returns an iterator to the first element greater than `t` |
| Equal range      | `a.equal_range(t)` | returns a pair of iterators: the first equals `a.lower_bound(t)`, the second equals `a.upper_bound(t)` |

A multiset is similar to a set, but can contain duplicate elements.

### Map

A map is a container that contains ordered key-value pairs. The keys of a map are ordered in ascending order and organized as a tree. A map supports insertion, deletion, and search operations. Insertion and deletion in a map take O(log n) time.

> [!NOTE]
> __Table notation:__
>
> - `C` — container type (e.g., `std::map`)
> - `a` — container object
> - `i`, `j` — iterators
> - `k` — key
> - `v` — value
> - `{k, v}` — key-value pair

Required properties of maps:

| Property         | Expression        | Note                                         |
| ---------------- | ---------------- | -------------------------------------------- |
| Constructor      | `C()`            | creates an empty map                         |
|                  | `C(a)`           | creates a map from another map `a`           |
|                  | `C(i, j)`        | creates a map from the specified half-open interval of iterators `[i, j)` |
| Insertion        | `a.insert({k, v})` | inserts the key-value pair `{k, v}` into the map |
|                  | `a.insert(i, j)` | inserts the half-open interval `[i, j)` into the map |
|                  | `a[k] = v`       | inserts the key-value pair `{k, v}` into the map if key `k` does not exist, otherwise updates the value for key `k` |
| Element access   | `a[k]`           | returns a reference to the value for key `k` |
|                  | `a.at(k)`        | returns a reference to the value for key `k`. If key `k` does not exist, an exception is thrown |
| Erasure          | `a.erase(k)`     | removes the element with key `k` from the map |
|                  | `a.erase(i)`     | removes the element pointed to by iterator `i` |
|                  | `a.erase(i, j)`  | removes the half-open interval `[i, j)` from the map |
| Clear            | `a.clear()`      | removes all elements from the map            |
| Find             | `a.find(k)`      | returns an iterator to the element with key `k` if it exists, otherwise returns `a.end()` |
| Count            | `a.count(k)`     | returns the number of elements with key `k` in the map |
| Lower bound      | `a.lower_bound(k)` | returns an iterator to the first element not less than `k` |
| Upper bound      | `a.upper_bound(k)` | returns an iterator to the first element greater than `k` |
| Equal range      | `a.equal_range(k)` | returns a pair of iterators: the first equals `a.lower_bound(k)`, the second equals `a.upper_bound(k)` |

A multimap is similar to a map, but can contain elements with duplicate keys.

## Bibliography

1. [Welcome Back to C++ - Modern C++, Microsoft](https://learn.microsoft.com/en-us/cpp/cpp/welcome-back-to-cpp-modern-cpp?view=msvc-170)
2. [Containers library, CPP Reference](https://en.cppreference.com/w/cpp/container)
