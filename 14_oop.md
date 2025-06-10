# Object-Oriented Programming

- [Object-Oriented Programming](#object-oriented-programming)
  - [The Concept of Object-Oriented Programming](#the-concept-of-object-oriented-programming)
    - [Data Abstraction](#data-abstraction)
    - [Encapsulation](#encapsulation)
    - [Inheritance](#inheritance)
  - [Object Creation and Destruction](#object-creation-and-destruction)
  - [Virtual Functions](#virtual-functions)
    - [Abstract Classes](#abstract-classes)
    - [Interface](#interface)
  - [Polymorphism](#polymorphism)
  - [Bibliography](#bibliography)

## The Concept of Object-Oriented Programming

__Object-Oriented Programming__ (OOP) is a programming paradigm based on the use of objects and classes. In this paradigm, everything is an object or a part of an object, and the program is viewed as the interaction of objects.

The main concepts of object-oriented programming are:

- __Class__ – a user-defined data type representing an abstraction of real-world objects, including a set of data describing these objects, as well as functions describing their behavior;
- __Object__ – a variable of a class;
- __Interface__ – (class interface) a set of public properties of a class, its methods, as well as functions with parameters of the class type;

A class can be considered as a set of objects with the properties described by the class. In this case, the properties are defined by the class interface, and an object of the class is an element of this set.

The main principles of OOP:

- _data abstraction_ – implementing only those characteristics of an object that are necessary for solving the task;
- _encapsulation_ – isolation and hiding of class data and methods;
- _inheritance_ – the ability to create new classes based on existing ones;
- _polymorphism_ – a mechanism that allows using data of different types in a common context.

### Data Abstraction

__Data abstraction__ is the use of only those characteristics of an object that accurately represent it in the given system. The main idea is to represent an object with a minimal set of fields and methods, while still being accurate enough for the task at hand.

Abstraction is the foundation of object-oriented programming and allows working with objects without delving into their implementation details.

### Encapsulation

__Encapsulation__ is the isolation of elements that define structure (data) and behavior (methods). Encapsulation implies dividing a class into an interface and an implementation.

The ways an object can be used are determined by the class interface.

```cpp
class vector {
private:
    double x, y;
    void normalize();

public:
    void move(double, double);
    std::string to_string() const;
};

void print(const vector&);
```

In this example, the `vector` class encapsulates the data `x`, `y` and the method `normalize`. The class interface is defined by the methods `move`, `to_string`, and the function `print`.

### Inheritance

__Inheritance__ means that one abstract data type can inherit data and functionality from another data type.

Inheritance promotes code reuse.

A class that inherits properties from another class is called a __child__, __derived__, or __subclass__.

A class from which inheritance occurs is called a  __base class__, __parent__, or __superclass__.

Child classes are formed from base classes by adding new properties and overriding some methods.

Example of inheritance:

```cpp
class Animal {
    point position;
public:
    Animal();
    virtual ~Animal();

    virtual void eat() const {
        puts("do eat");
    }
    void move(point pt) {
        position = pt;
    }
};

class Cat: public Animal {
public:
    Cat();
    virtual ~Cat();

    virtual void eat() const;
};

class Pig: public Animal {
public:
    Pig();
    virtual ~Pig();

    virtual void eat() const;
};
```

Since a derived class describes a subset of elements of the base class, a pointer (or reference) to a base class object can also refer to a derived class object. The reverse is not true: a pointer (or reference) to a derived class object __cannot__ refer to a base class object.

Example:

```cpp
class A {};
class B: public A {};

A a1;
B b1;
A& a = b1; // OK!
B& b = a1; // ERROR!
```

## Object Creation and Destruction

A special function with the same name as the class is called a __constructor__. This function is used to create class objects and initialize their fields. A class can have several constructors, differing in purpose (and parameters):

- a constructor without parameters is called the default constructor;
- a constructor that takes an object of the same type as a parameter is called a copy constructor.

A constructor does not return a value.

A function with the same name as the constructor, but starting with the symbol `~`, is called a __destructor__. The role of the destructor is to properly free memory when an object is destroyed. A class can have only one destructor.

```cpp
class vector {
    double _x, _y, _z;
public:
    // default constructor
    vector();
    // constructor with parameters
    vector(double x, double y, double z);
    // copy constructor
    vector(const vector&);
    // destructor
    ~vector();
};
```

If no constructors are defined in a class, the compiler creates a default constructor. However, if a user-defined constructor is present, the compiler does not create a default constructor, so if you need one, you must define it explicitly. If the compiler-generated constructor is sufficient, you can use the `default` keyword to define it. The same applies to the copy constructor.

```cpp
class vector {
    double _x, _y, _z;
public:
    // default constructor
    vector() = default;
    // constructor with parameters
    vector(double x, double y, double z);
    // copy constructor
    vector(const vector&) = default;
    // destructor
    ~vector();
};
```

If a destructor is not defined in a class, the compiler creates a default destructor.

When implementing a constructor with parameters, the class fields are usually initialized with the parameter values using an initialization list. The initialization list is a list of parameters, separated by commas, enclosed in parentheses, and initialized with parameter values.

```cpp
vector::vector(double x, double y, double z): _x(x), _y(y), _z(z) {}
```

## Virtual Functions

A programmer can override (rewrite) a base class function in a derived class. For example, the following code demonstrates this capability:

```cpp
// nopoly.cpp
#include <cstdio>

struct A {
    A() {}
    void print() const { puts("A"); }
};

struct B: public A {
    B(){}
    void print() const { puts("B"); }
};

int main(){
     A* obj = new B;
     obj->print();
     obj = new A;
     obj->print();
     return 0; 
}
```

However, the expected result will not be achieved – in both cases, the letter A will be printed on the screen, not B. This is because the compiler cannot determine the type of the object stored in the variable obj, so the parent object's function is called. This problem can be solved using virtual functions. When virtual functions are used, the compiler guarantees that the correct version of the function is called for each object in the class hierarchy.

A method is called __virtual__ if it can be overridden in a derived class, using the `virtual` keyword. Example of using virtual functions:

```cpp
// poly01.cpp
#include <cstdio>

struct A {
     A() {}
     virtual void print() const { puts("A"); }
};

struct B:public A {
     B() {}
     virtual void print() const { puts("B"); }
};

int main(){
     A* obj = new B;
     obj->print();
     obj = new A;
     obj->print();
     return 0;
}
```

In the example _poly01.cpp_, we get the desired result: "BA" will be printed on the screen.

### Abstract Classes

An __abstract method__ (abstract member function, pure virtual function) is a virtual function without an implementation.

```cpp
struct Comparable {
    // pure virtual function!
    virtual bool equal(Comparable*) = 0; 
};

class Complex: public Comparable {
    double real;
    double imaginary;
public:
    bool equal(Comparable*) override; 
};
```

If a class has at least one abstract method, it is called an __abstract class__.

### Interface

An abstract class may contain only public pure virtual functions. In this case, such a class is sometimes called an interface, by analogy with other OOP languages.

## Polymorphism

__Polymorphism__ is a mechanism that allows using data of different types in a common context. An example of polymorphism based on implicit type conversion:

```cpp
bool less(double x, double y) { return x < y; }

int a = 10, b = 15;
less(a, b);
```

Polymorphism based on virtual functions, also called dynamic polymorphism, is based on the ability of a pointer to a base class object to point to a derived class object.

This property can be used to implement polymorphism – the ability to use the same function (the same function name) with different parameter types. An example of dynamic polymorphism with classes is shown in listing _poly02.cpp_:

```cpp
// poly02.cpp
#include <cstdio>

struct A{
     A() {}
     virtual void print() const { puts("A"); }
};

struct B: public A{
     B(){}
     virtual void print() const { puts("B"); }
};

void print(const A& a){
     a.print();
}

int main(){
     B b;
     A& obj = b;
     print(obj);
     return 0;
}
```

## Bibliography

1. [Object-Oriented Programming, Wikipedia](https://en.wikipedia.org/wiki/Object-oriented_programming)
2. [Bjarne Stroustrup. The C++ Programming Language.](https://www.google.com/search?q=stroustrup+the+c%2B%2B+programming+language)
3. [Classes, cppreference.com](https://en.cppreference.com/w/cpp/language/classes)
