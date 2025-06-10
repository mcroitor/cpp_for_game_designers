# Operations

- [Operations](#operations)
  - [The Concept of an Operation](#the-concept-of-an-operation)
  - [Arithmetic Operations](#arithmetic-operations)
  - [Bitwise Operations](#bitwise-operations)
  - [Increment / Decrement](#increment--decrement)
  - [Compound Assignment Operators](#compound-assignment-operators)
  - [Logical Operations](#logical-operations)
  - [Operator Precedence](#operator-precedence)
  - [Operator Overloading](#operator-overloading)
  - [Comparison Operator](#comparison-operator)
  - [The "Spaceship" Operator](#the-spaceship-operator)
  - [References](#references)

## The Concept of an Operation

In general, an operation is an action (process) performed on one or more values called _operands_. This action is defined by an _operator_—a special language construct.

Operations can be:

- _unary_ – with one operand. Example of a unary operation: increment, changing the sign of a number;
- _binary_ – with two operands. Example of a binary operation: addition, multiplication, `or`;
- _ternary_ – with three operands.

## Arithmetic Operations

C/C++ supports the following arithmetic operations:

- `+` – addition;
- `-` – subtraction;
- `*` – multiplication;
- `/` – division;
- `%` – remainder of division.

Arithmetic operations can be applied to:

- integer types;
- floating-point types;
- types (classes) that have overloaded arithmetic operators.

If operands of different types are used in an arithmetic expression, the compiler implicitly converts the operand of the smaller type to the type of the larger operand.

The `+` and `–` operations can be used as unary operators to change the sign of an expression.

The `%` operation is used only with integer types.

If both operands in a division are integers, the result is an integer.

## Bitwise Operations

C/C++ supports the following bitwise (performed on bits) logical operations:

- `&` – bitwise AND;
- `^` – bitwise XOR (exclusive OR);
- `|` – bitwise OR;
- `~` – bitwise NOT (inversion).

There are also bitwise shift operations:

- `<<` – left shift of the left operand by the number of bits specified by the right operand;
- `>>` – right shift of the left operand by the number of bits specified by the right operand.

| __bit1__ | __bit2__ | `&` | `\|` | `^` | `~` |
| -------- | -------- | --- | ---- | --- | --- |
| 0 | 0 | 0 | 0 | 0 | 1 |
| 0 | 1 | 0 | 1 | 1 | 1 |
| 1 | 0 | 0 | 1 | 1 | 0 |
| 1 | 1 | 1 | 1 | 0 | 0 |

The following example shows bitwise operations on the numbers 17 and 45:

| Expression   | 128 | 64 | 32 | 16 | 8 | 4 | 2 | 1 | Result |
| ------------ | --- | -- | -- | -- | - | - | - | - | ------ |
| `17`         | 0   | 0  | 0  | 1  | 0 | 0 | 0 | 1 | 17     |
| `45`         | 0   | 0  | 1  | 0  | 1 | 1 | 0 | 1 | 45     |
| `17 & 45`    | 0   | 0  | 0  | 0  | 0 | 0 | 0 | 1 | 1      |
| `17 \| 45`   | 0   | 0  | 1  | 1  | 1 | 1 | 0 | 1 | 61     |
| `17 ^ 45`    | 0   | 0  | 1  | 1  | 1 | 1 | 0 | 0 | 60     |
| `~17`        | 1   | 1  | 1  | 0  | 1 | 1 | 1 | 0 | 238    |

## Increment / Decrement

C++ defines two operators that increase or decrease an integer value by 1:

- the `++` operator – increment;
- the `--` operator – decrement.

These operators are unary, meaning they require one operand. They can be placed before or after the operand.

- `A++` is equivalent to `A = A + 1`. Returns the original value of _A_.
- `++A` is equivalent to `A = A + 1`. Returns the changed value of _A_.
- `A--` is equivalent to `A = A - 1`. Returns the original value of _A_.
- `--A` is equivalent to `A = A - 1`. Returns the changed value of _A_.

## Compound Assignment Operators

Compound assignment operators allow you to perform an arithmetic operation and assign the result to the first operand.

The following compound operations are defined: `+=`, `-=`, `*=`, `/=`, `%=`, `&=`, `|=`, `^=`, `<<=`, `>>=`.

For example, `A += B` is equivalent to `A = A + B`.

## Logical Operations

Logical operations are components of logical expressions and are used for conditional logic, for example, in branches (`if`) or loops (`while`, `for`).

C++ defines 3 logical operations:

- `&&` – AND (conjunction);
- `||` – OR (disjunction);
- `!` – NOT (negation).

Logical operations allow you to compose a more complex logical expression from several simple ones.

Rules for logical operations:

| `A`   | `B`   | `A && B` | `A \|\| B` | `!A`  |
| ----- | ----- | -------- | ---------- | ----- |
| true  | true  | true     | true       | false |
| true  | false | false    | true       | false |
| false | true  | false    | true       | true  |
| false | false | false    | false      | true  |

## Operator Precedence

| Precedence | Operator | Description | Group |
| ---------- | -------- | ----------- | ----- |
| 1 | `::` | Scope resolution | access |
| 2 | `.`  | Member selection | access |
| 2 | `->` | Member selection for pointer to object | access |
| 2 | `[]` | Array indexing | access |
| 2 | `()` | Function call | other |
| 2 | `++` | Postfix increment | increment / decrement |
| 2 | `--` | Postfix decrement | increment / decrement |
| 2 | `typeid` | Type name | special |
| 2 | `const_cast` | Const cast | special |
| 2 | `dynamic_cast` | Dynamic cast | special |
| 2 | `reinterpret_cast` | Reinterpret cast | special |
| 2 | `static_cast` | Static cast | special |
| 3 | `sizeof` | Size of object or type | special |
| 3 | `++` | Prefix increment | increment / decrement |
| 3 | `--` | Prefix decrement | increment / decrement |
| 3 | `~` | Bitwise NOT | arithmetic |
| 3 | `!` | Logical NOT | logical |
| 3 | `-` | Unary minus | arithmetic |
| 3 | `+` | Unary plus | arithmetic |
| 3 | `&` | Address-of | access |
| 3 | `*` | Dereference | access |
| 3 | `new` | Object creation | special |
| 3 | `delete` | Object destruction | special |
| 3 | `()` | Type cast | special |
| 4 | `.*` | Pointer to member selection | access |
| 4 | `->*` | Pointer to member (pointer to object) | access |
| 5 | `*` | Multiplication | arithmetic |
| 5 | `/` | Division | arithmetic |
| 5 | `%` | Modulo | arithmetic |
| 6 | `+` | Addition | arithmetic |
| 6 | `-` | Subtraction | arithmetic |
| 7 | `<<` | Left shift | arithmetic |
| 7 | `>>` | Right shift | arithmetic |
| 8 | `<=>` | Three-way comparison | comparison |
| 9 | `<` | Less than | comparison |
| 9 | `>` | Greater than | comparison |
| 9 | `<=` | Less than or equal | comparison |
| 9 | `>=` | Greater than or equal | comparison |
| 10 | `==` | Equality | comparison |
| 10 | `!=` | Inequality | comparison |
| 11 | `&` | Bitwise AND | arithmetic |
| 12 | `^` | Bitwise XOR | arithmetic |
| 13 | `\|` | Bitwise OR | arithmetic |
| 14 | `&&` | Logical AND | logical |
| 15 | `\|\|` | Logical OR | logical |
| 16 | `?:` | Conditional | other |
| 16 | `=` | Assignment | assignment |
| 16 | `*=` | Multiplication assignment | assignment |
| 16 | `/=` | Division assignment | assignment |
| 16 | `%=` | Modulo assignment | assignment |
| 16 | `+=` | Addition assignment | assignment |
| 16 | `-=` | Subtraction assignment | assignment |
| 16 | `<<=` | Left shift assignment | assignment |
| 16 | `>>=` | Right shift assignment | assignment |
| 16 | `&=` | Bitwise AND assignment | assignment |
| 16 | `\|=` | Bitwise OR assignment | assignment |
| 16 | `^=` | Bitwise XOR assignment | assignment |
| 17 | `,` | Comma (statement separator) | other |

## Operator Overloading

Often, for convenience, it is useful to redefine an operator for a class (for example, + for vectors). This makes the code more compact and understandable. The general form of defining an operator is as follows:

`<return_type> operator <operator_sign> (<operator_parameters>);`

Operators can be unary (working with one object) or binary (working with two objects). Examples of unary operators: `++`, `--`, `*` (dereference operator). Examples of binary operators: `+`, `+=`, `*` (multiplication), `==`.

Operators are functions with special names. They can be declared both outside the class and as class members. Example of operator overloading:

```cpp
class int_pair{
    int first, second;
public:
    int_pair(int f = 0, int s = 0): first(f), second(s) {}
    bool operator == (const int_pair& p) const {
        return (first == p.first) && (second == p.second);
    }
    std::string to_string() const {
        return "[ " + std::to_string(first) + ", " + std::to_string(second) + " ]";
    }
};

bool operator != (const int_pair& p1, const int_pair& p2){
    return !(p1 == p2);
}

std::ostream& operator << (std::ostream& out, const int_pair& p) {
    out << p.to_string();
    return out;
}
```

Unary operators are declared as part of the class. Binary operators can be declared both inside and outside the class. A binary operator declared inside the class has only one input parameter (the second parameter is the object whose operator is called). Binary operators declared outside the class have two parameters.

 > __Recommendation:__ To determine where it is best to define an operator—inside or outside the class—ask yourself whether this operator modifies its operands. If it does, then this operator is part of the class. If not, it is better to define the operator outside the class. For example, the assignment operation modifies the right operand, so it is better to define the operator inside the class; the addition operation does not modify its operands, so it should be defined outside the class.

The following example shows ways to overload operators for a two-dimensional vector:

```cpp
class vector{
    float x, y;
public:
    vector(float p1 = 0, float p2 = 0): x(p1), y(p2) {}
    vector& operator = (const vector& p){
        x = p.x;
        y = p.y;
        return *this;
    }
    void operator += (const vector& p){
        x += p.x;
        y += p.y;
    }
};

vector operator + (const vector& p1, const vector& p2){
    vector tmp = p1;
    tmp += p2;
    return tmp;
}
```

## Comparison Operator

To compare objects, the basic operation `a == b` is used; the operation `a != b` is derived from it.

```cpp
class int_pair{
    int first, second;
public:
    // ...
    // comparison operator
    bool operator == (const int_pair& p) const {
        return (first == p.first) && (second == p.second);
    }
};

bool operator != (const int_pair& p1, const int_pair& p2){
    return !(p1 == p2);
}
```

## The "Spaceship" Operator

Before the `C++20` standard, the basic operation for ordering was `<` (_less than_). The other operators were derived from it and implemented in the standard library, in the `std::rel_ops` namespace.

Starting with the `C++20` standard, the three-way comparison operator (en. __spaceship__ operator) `<=>` was introduced, which became the basis for ordering operations. The semantics of the operator are as follows:

- `a <=> b` is less than zero if `a < b`;
- `a <=> b` is less than or equal to zero if `a <= b`;
- `a <=> b` is greater than zero if `a > b`;
- `a <=> b` is greater than or equal to zero if `a >= b`.

If this operator is defined, the compiler will automatically generate all ordering operators based on it.

```cpp
/**
 * @file spaceship.cpp
 * @brief Example of using the spaceship operator
 * @details g++ -std=c++20 spaceship.cpp
 */
#include <iostream>
class int_pair{
    int first, second;
public:
    // ...
    // spaceship
    auto operator <=> (const int_pair& p) const {
        return first <=> p.first;
    }
};
// ...
int main() {
    int_pair pair(2, 3);
    int_pair pair2(1, 5);
    bool result = pair < pair2;
    std::cout << pair << std::endl;
    return 0;
}
```

## References

1. [C++ Operator Precedence, cppreference.com](https://en.cppreference.com/w/cpp/language/operator_precedence)
2. [Andrey2008, Comparison operations in C++20, Habr: Pvs-Studio](https://habr.com/ru/companies/pvs-studio/articles/465575/)
