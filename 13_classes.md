# User-defined Data Types

- [User-defined Data Types](#user-defined-data-types)
  - [Type Aliases](#type-aliases)
  - [Enumerations](#enumerations)
  - [Structures](#structures)
  - [Classes](#classes)
    - [The this Keyword](#the-this-keyword)
  - [Bibliography](#bibliography)

## Type Aliases

For improving code readability, type aliases may be defined. Also, defining aliases simplifies working with function pointers and allows shortening long types, for example, when using STL containers.

A type alias is defined using the __typedef__ keyword.

```cpp
// improve code readability
typedef unsigned char age_type;

// convenient for creating function pointers.
// [Function pointer](https://sweethome.gitbook.io/advanced-cpp/particularities/function_pointers)
typedef void (*pfunc_type)(void);

// shorten a long type
typedef std::vector<unsigned int>::const_iterator const_iterator;

age_type age;
pfunc_type handlers[10];
const_iterator it;
```

Type aliases may also be defined using the __using__ keyword.

Syntax:

```cpp
using <new type name> = <type>;
```

Examples:

```cpp
using BYTE = unsigned char;
using WORD = unsigned short int;

BYTE byte;
WORD word;
```

## Enumerations

An enumeration is a user-defined data type defined as a set of integer constants. An enumeration variable may take only the values defined in this enumeration.

Syntax:

```cpp
enum <type name> {
  <constant_1>,
  <constant_2>,
  ...
  <constant_n>
};
```

or

```cpp
enum class <type name> {
  <constant_1>,
  <constant_2>,
  ...
  <constant_n>
};
```

Examples of enumeration declarations:

```cpp
enum CURRENCY {
  MDL,
  USD,
  EUR
};

enum class color_type {
  white,
  red,
  green,
  blue,
  black,
};

enum class direction_t {
  north,
  south,
  east,
  west
};
```

Enumeration constants take consecutive integer values starting from zero. Thus, the constant `CURRENCY::MDL` will be zero, `CURRENCY::USD` will be one, and so on. However, it is strongly recommended to use the names of the constants defined in the enumeration, not their numeric values.

The name of an enumeration constant is specified as `<type name>::<constant name>`.

Examples of declaring enumeration variables with their initialization:

```cpp
CURRENCY valuta = CURRENCY::MDL;
color_type backgroundColor = color_type::white;
direction_t direction = direction_t::east;
```

## Structures

A structure is a user-defined data type that logically groups values of basic types or other structures. Examples of structures may be a complex number, a planar point, or a planar vector as a combination of two real variables.

```cpp
struct <structure name> {
  /* type_1 */ /* property_1 */;
  /* type_2 */ /* property_2 */;
  // ...
  /* type_n */ /* property_n */;
};
```

Example of declaring a structure _point on a plane_:

```cpp
struct point_t {
  double x;
  double y;
};
```

Declaring a structure object is similar to declaring a variable. Object initialization may be performed by listing the field values, separated by commas and enclosed in curly braces:

```cpp
point_t pt {1., 0.};
pt.x = -3.7;
pt.y = 12.2;
```

Access to the fields of a structure object is performed using the `.` operator, as shown in the example.

## Classes

Classes represent an extended form of structures. They allow grouping not only data under one name, but also functions operating on this data.

Formally, _a class is a user-defined data type describing an abstraction of real-world objects_. An instance of a class (that is, a variable of this type) is called an _object_ (in general, any variable may be called an object of a type).

Syntax for declaring a class:

```cpp
class <class name> {
private:
  /* type_1 */ /* property_1 */;
  /* type_2 */ /* property_2 */;
  // ...
  /* type_n */ /* property_n */;

public:
  /* type_1 */ /* method_1 */;
  /* type_2 */ /* method_2 */;
  // ...
  /* type_n */ /* method_n */;
};
```

Variables declared in a class are called __member data__, __attributes__, or __fields__; functions declared in a class are called __member functions__ or __methods__.

A class allows controlling access to declared variables and functions, making them available to the user or hiding them. This is done using the keywords __public__, __private__, and __protected__, which define access for a group of class members.

By default, access to class members is closed.

> In C++, structures differ from classes only in access: in structures, access to elements is open by default, in classes it is closed by default.

Example of declaring a class _game character_:

```cpp
class GameCharacter {
  std::string _name;
  size_t      _health;
  size_t      _attack;
  size_t      _defence;
  point_t     _position;

public:
  GameCharacter(std::string); // constructor
  void Move(direction_t);

  void Attack(GameCharacter&);
};
```

In C++, it is common to separate the class declaration (and not only) from its implementation. Good practice is to create two files for each class: the _header file_ describes the class, the _source file_ contains the implementation of the methods.

When describing the implementation of class methods, the following syntax is used:

```cpp
<return type> <class name>::<method name>(<parameters>) {
  <function body>
}
```

```cpp
GameCharacter::GameCharacter(std::string name): 
    _name(name), _attack(10), _health(100), _defence(2)
{
}

void GameCharacter::Move(direction_t direction)
{
    switch (direction) {
        case direction_t::north: // top
            _position.x -= 1;
            break;
        case direction_t::south: // bottom
            _position.x += 1;
            break;
        case direction_t::east: // right
            _position.y += 1;
            break;
        case direction_t::west: // left
            _position.y -= 1;
            break;
    }
}

void GameCharacter::Attack(GameCharacter & gameCharacter)
{
    size_t damage = 0;
    if(this->_attack >= gameCharacter._defence) {
        damage = this->_attack - gameCharacter._defence;
    }
    if(gameCharacter._health >= damage) {
        gameCharacter._health -= damage;
    }
    else {
        gameCharacter._health = 0;
    }    
}
```

### The this Keyword

A class describes a set of objects with the same properties and behavior, but the behavior (that is, the use of methods) refers to a specific object. To indicate that an action refers to the object, the __this__ keyword is used. This keyword is a pointer to the current object, which provides access to the properties and methods of the object using the arrow operator `->`.

The __this__ keyword is used only in the context of class methods.

Example of usage:

```cpp
void GameCharacter::Move(direction_t direction)
{
    switch (direction) {
        case direction_t::north: // top
            this->_position.x -= 1;
            break;
        case direction_t::south: // bottom
            this->_position.x += 1;
            break;
        case direction_t::east: // right
            this->_position.y += 1;
            break;
        case direction_t::west: // left
            this->_position.y -= 1;
            break;
    }
}
```

Classes are considered in more detail in the context of [object-oriented programming](./14_oop.md).

## Bibliography

1. [C++ Language Standard](https://github.com/cplusplus/draft/releases/tag/n4917)
2. [cppreference.com](https://en.cppreference.com/w/cpp/language/class)
