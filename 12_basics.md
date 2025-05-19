# Basics of the C++ Language

- [Basics of the C++ Language](#basics-of-the-c-language)
  - [Language Elements](#language-elements)
    - [constants](#constants)
    - [identifiers](#identifiers)
    - [keywords](#keywords)
    - [special symbols](#special-symbols)
    - [comments](#comments)
  - [Basic Types and Variables](#basic-types-and-variables)
    - [Integers](#integers)
    - [Floating-point numbers](#floating-point-numbers)
    - [Boolean type](#boolean-type)
    - [Variables](#variables)
  - [Basic Structures](#basic-structures)
    - [Branching](#branching)
    - [Selection](#selection)
    - [Loops](#loops)
      - [Counter loop](#counter-loop)
      - [Precondition loop](#precondition-loop)
      - [Postcondition loop](#postcondition-loop)
    - [Functions](#functions)
  - [Memory Management](#memory-management)
    - [Pointers](#pointers)
    - [References](#references)
    - [Memory allocation and deallocation](#memory-allocation-and-deallocation)
    - [Arrays](#arrays)
  - [Bibliography](#bibliography)

## Language Elements

C++ language (as any other language) defines itself by the following elements:

- __constants__ – define program data;
- __identifiers__ – allow to name data storages and algorithms for their use;
- __keywords__ – reserved words of the language, intended for describing programs;
- __special symbols__ – punctuation marks having special meaning depending on context;
- __comments__ – blocks of text not translated into binary code, intended for code explanation.

### constants

Constants are immutable values and may be represented by a number (integer or floating-point), a character, or a sequence of characters (string).

Examples of constants:

- `1`, `-12l`, `0b0010011`, `01237`, `0xab` – integers
- `1.0`, `-2.32e+05`, `1.0e-5` – floating-point numbers
- `'a'`, `'U'`, `'\n'`, `'\0xa3'`, `'\200'` – characters
- `"this is a string"`, `""`, `"\13\255\32\32"` – string of characters

### identifiers

Identifiers are names of variables, functions, constants, and user-defined data types.

Identifier is a sequence of characters, used for designation:

- Identifier consists of one or more characters;
- Identifier may start with an underscore or a Latin letter;
- After the first character, identifier may contain underscores, Latin letters, or digits;
- Keywords cannot be used as identifiers.

Uppercase and lowercase letters are different! (`sample` != `Sample`)

Examples:

- `sample`
- `_my_variable`
- `THIS_IS_A_CONSTANT`
- `MyVariable10`

### keywords

C89 version defines 32 keywords.

- __auto__ — Tells the compiler to deduce the variable type from the assigned value
- __break__ — Exits a loop
- __case__ — Specifies a selection variant (used with _switch_)
- __char__ — Character data type
- __const__ — Objects of type _const_ cannot be changed by the program during execution
- __continue__ — Continues the loop, skipping the remaining statements in the block
- __default__ — Default selection operator
- __do__ — Loop with postcondition, without counter
- __double__ — Double-precision floating-point data type
- __else__ — Conditional operator "else"
- __enum__ — User-defined data type "enumeration"
- __extern__ — Type specifier for indicating external linkage of a variable
- __float__ — Floating-point data type
- __for__ — Loop with precondition and counter
- __goto__ — Unconditional jump operator
- __if__ — Conditional operator "if"
- __int__ — Integer data type
- __long__ — Type modifier for defining long variables
- __register__ — Type specifier for storing a variable in processor registers
- __return__ — Operator for returning a value from a function
- __short__ — Type modifier for defining short variables
- __signed__ — Type modifier for defining signed variables
- __sizeof__ — Operator for determining the size of a data type at compile time
- __static__ — Tells the compiler to store a local variable for the entire program lifetime
- __struct__ — User-defined data type "structure"
- __switch__ — Selection operator
- __typedef__ — Operator for creating a new data type name
- __union__ — User-defined data type "union"
- __unsigned__ — Type modifier for defining unsigned variables
- __void__ — Void data type
- __volatile__ — Type qualifier tells the compiler that the variable value may be changed by means not explicit in the program
- __while__ — Loop with precondition, without counter

C++ contains all keywords defined in _C89_, as well as the following[^1]:

- __asm__ — Keyword for inserting one or more assembler instructions
- __bool__ — Boolean data type
- __catch__ — Block of code that handles an error
- __class__ — User-defined data type "class"
- __const_cast__ — Type cast operator, used for explicit override of _const_ and/or _volatile_ modifiers
- __delete__ — Operator releases memory pointed to by the argument
- __dynamic_cast__ — Type cast operator, checks the legality of the specified cast operation
- __explicit__ — Constructor defined with the _explicit_ specifier is used only if the initialization exactly matches what is specified by the constructor
- __export__ — Keyword allowing other files to use a template declared in another file by specifying only its declaration
- __false__ — Boolean constant, value "false"
- __friend__ — Keyword defines friend functions or classes
- __inline__ — Specifier used to place the function body directly in the program text
- __mutable__ — Type specifier allows a member of an object to override constness
- __namespace__ — Keyword for creating a namespace
- __new__ — Operator allocates dynamic memory and returns a pointer of the corresponding type to this memory area
- __operator__ — Keyword used for creating overloaded operator functions
- __private__ — Access specifier "private", defines inheritance mode of the base class
- __protected__ — Access specifier "protected", defines inheritance mode of the base class
- __public__ — Access specifier "public", defines inheritance mode of the base class
- __reinterpret_cast__ — Type cast operator, converts one type to a completely different one
- __static_cast__ — Type cast operator, performs non-polymorphic type casting
- __template__ — Keyword _template_ used for creating generic functions and classes
- __this__ — Used to refer to the pointer to the object that generated the call to the member function
- __throw__ — Operator _throw_ generates an exception
- __true__ — Boolean constant, value "true"
- __try__ — Block of code intended for error handling
- __typeid__ — Operator _typeid_ returns a reference to a _type_info_ object describing the type of the object to which _typeid_ is applied
- __typename__ — Keyword that can be used instead of _class_ in a template declaration or to denote an undefined type
- __using__ — Brings a variable from a specific namespace into the global variable scope
- __virtual__ — Type specifier defining virtual functions
- __wchar_t__ — Two-byte character data type

### special symbols

Punctuation marks and special symbols in the C language character set have various uses, from organizing program text to defining tasks performed by the compiler or the compiled program.

C++ uses the following special symbols:

- `( )`
- `[ ]`
- `{ }`
- `*`
- `,`
- `:`
- `=`
- `;`
- `...`
- `#`

These marks do not define operations to be performed and may have different meanings depending on context.

Some punctuation marks are also language operators.

### comments

In source code, both single-line and multi-line comments may be written.

Single-line comment starts with `//` and continues to the end of the line.

Multi-line comment is defined by `/*` and `*/`, between which any number of lines of text may be written.

Comments are widely used not only for explaining program code, but also for creating technical documentation. There are a number of applications (Doxygen, JavaDoc, etc.) that analyze comments and create documentation in HTML, PDF, or other formats. Also, modern IDEs use comments to generate code tooltips.

## Basic Types and Variables

Each program is intended for data processing. Data are numbers, strings, or combinations of numbers and strings (composite data). Accordingly, for storing and working with data, special "storages" are used – _variables_.

A variable is an identifier denoting a certain area in memory. Each variable has its own type.

Basic types: integers, floating-point numbers, boolean type.

Type defines what values a variable may have and how many bytes in memory it will occupy.

### Integers

- __char__ – represents a single character. Occupies 1 byte in memory. May store any value from -128 to 127. Variables of type char may be assigned a single character in single quotes.
- __unsigned char__ – represents a single character. Occupies 1 byte (8 bits) in memory. May store a value from 0 to 255.
- __short__ – represents an integer in the range from –32768 to 32767. Usually occupies 2 bytes in memory.
- __int__ – represents an integer. Depending on processor architecture, may occupy 2, 4, or 8 bytes.
- __long long__ – represents an integer in the range from `-9 223 372 036 854 775 808` to `+9 223 372 036 854 775 807`. Occupies 8 bytes in memory.

Any decimal number is by default considered as a value of type `int` / `long int` / `long long int` (depending on size), and when assigned to variables of other types, conversion is performed.

To explicitly specify the type, a certain suffix is added to the number:

- `unsigned int` – `u` or `U`
- `long int` – `l` or `L`
- `unsigned long int` – `ul` or `UL`
- `long long` – `ll` or `LL`
- `unsigned long long` – `ull` or `ULL`

### Floating-point numbers

- __float__ – represents a single-precision floating-point number in the range `-3.4E+38` to `3.4E+38`. Occupies 4 bytes in memory.
- __double__ – represents a double-precision floating-point number in the range `-1.7E+308` to `1.7E+308`. Occupies 8 bytes in memory.
- __long double__ – represents a double-precision floating-point number in the range +/- 3.4E-4932 to 1.1E+4932. Occupies 10 bytes (80 bits) in memory. On some systems may occupy 96 or 128 bits, depending on compiler and processor architecture.

### Boolean type

C++ language has a special type for boolean values — __bool__. The only valid values for this type are `true` and `false`, and the variable of this type cannot have other values.

A __bool__ variable occupies exactly 1 byte in memory.

Type bool is assignment-compatible with type __int__ in both directions: `true` becomes `1`, `false` becomes `0`.

In reverse conversion, any nonzero number becomes `true`, `0` becomes `false`.

Boolean values are the result of comparison operations or expressions composed of comparisons.

C++ defines the following comparison operations:

| Operator | Example |
| -------- | ------- |
| Less     | X < Y   |
| Greater  | X > Y   |
| Less or equal | X <= Y |
| Greater or equal | X >= Y |
| Equal    | X == Y  |
| Not equal| X != Y  |

C++ language has 3 logical operations

- `&&` – AND (conjunction)
- `||` – OR (disjunction)
- `!` – NOT (negation)

Logical operations allow to compose a more complex logical expression from several simple ones.

| A     | B     | A && B | A \|\| B | !A    |
| ----- | ----- | ------ | ------ | ----- |
| true  | true  | true   | true   | false |
| true  | false | false  | true   | false |
| false | true  | false  | true   | true  |
| false | false | false  | false  | true  |

### Variables

When declaring a variable, its type is specified first, then, separated by a space, the variable name.

```cpp
int variable;
```

Several variables of the same type may be defined at once, separated by commas.

```cpp
int a, b, c;
```

A variable may be initialized immediately, assigning it a default value.

```cpp
int x = 0, y = x;
char chr1 = 10, chr2 = 'x';
```

## Basic Structures

The simplest C++ program looks as follows:

```cpp
int main() {
   return 0;
}
```

The simplest C++ program consists of the `main` function, called the __entry point__[^2].

The `main` function returns an integer – the program exit code. Usually, the value `0` is returned, which means successful completion. The entry point may also have input parameters: program arguments passed at startup (for example, in the command line).

```cpp
int main(int argc, char** argv) {
   return 0;
}
```

The first parameter _argc_ contains the number of arguments passed, the second parameter _argv_ is an array of passed arguments. To understand how entry point arguments work, consider and run the following code:

```cpp
#include <iostream>

int main(int argc, char **argv) {
  for(int i = 0; i < argc; ++i) {
    std::cout << "argv[ " << i << " ] = " << argv[i] << std::endl;
  }
  return 0;
}
```

### Branching

Branching is one of the basic programming blocks. It allows to execute certain code depending on a condition (logical expression).

If the command block after __else__ is empty, it may be omitted.

If the command block in the condition consists of a single command, curly braces may be omitted.

Full branching syntax looks as follows:

```cpp
if(/* condition */) {
    // command block 1
}
else {
    // command block 2
}
```

Shortened (simplified) forms may also be encountered, depending on the construction complexity:

```cpp
// command block contains a single command, curly braces omitted, not recommended
if(/* condition */)
    // command 1
else
    // command 2

// no commands for alternative execution, else block omitted
if(/* condition */) {
    // command block
}
```

### Selection

The __switch__ / __case__ construction allows to compare an expression with a set of values.
After the __switch__ keyword in parentheses comes the expression to compare. The value of this expression is sequentially compared with the values after the __case__ operator. If a match is found, the corresponding __case__ block and all subsequent ones are executed (unless there is a __break__).

```cpp
switch( /* expression */) {
   case /* value_1 */: /* instructions_1 */ ;
   case /* value_2 */: /* instructions_2 */ ;
   // ...................
   case /* value_N */: /* instructions_N */ ;
   default: /* instructions */ ;
}
```

### Loops

Loops are one of the basic language constructs, allowing to execute a series of the same commands multiple times.

C++ language has 3 types of loop operators:

- for loop;
- while loop with precondition;
- do…while loop with postcondition.

Any of the above loop operators may be replaced by another.

Since C++11 standard, a "for each" loop is introduced.

#### Counter loop

Often there is a need to perform the same sequence of actions several (N) times. For this, counter loops are used:

```cpp
for(/* counter initialization */; /* condition */; /* counter change */) {
    // loop body
}
```

_Initializer_ executes once at the start of the loop and sets initial conditions, usually initializing counters – special variables used to control the loop.

_Condition_ is the condition under which the loop executes. Usually, a comparison operation is used as the condition, and if it returns a nonzero value (i.e., the condition is true), the loop body executes, then the iteration executes.

_Iteration_ executes after each completion of the loop block and sets the change of loop parameters. Usually, loop counters are incremented here.

#### Precondition loop

__while__ loop with precondition allows to execute the same sequence of actions while the checked condition is true. The condition is written before the loop body and checked before the loop body executes.

```cpp
while (/* condition */) {
    // loop body
}
```

#### Postcondition loop

__while__ loop with postcondition differs from the precondition loop in that the loop block executes first, then the condition is checked. If the condition is true, the loop executes again, and so on until the condition becomes false.

```cpp
do {
    // loop body
}
while (/* condition */);

```

### Functions

In many cases, there is a need to execute a series of commands multiple times in different parts of the code. In this case, these commands may be separated into a block, given a name, and used by name.

A function is a named block of program code. A function may have input parameters, allowing arguments (values for calculations) to be passed when working with the function.

The function name should reflect/describe its purpose.

```cpp
/* return type */ /* function name */(/* parameters */) {
   // function body
}
```

A function may be called from any number of places in the program. Values passed to the function are arguments, whose types must be compatible with the parameter types in the function definition.

```cpp
int sum (int a, int b) {
   return a + b;
}

int value = sum(5, 10);
```

> The term _argument_ refers to the value used when calling a function. The variable that receives this argument is called a _parameter_. Functions that accept arguments are called _parameterized functions_. [Schildt][^3]

## Memory Management

Programs, during execution, use two types of memory: stack (__stack__) and heap (__heap__).

Stack (__stack__) – fixed memory allocated at compile time. Variable declarations are written to it, and changing the placement of variables in memory during program execution is impossible.

Heap (__heap__) – dynamic memory, in which memory blocks may be allocated during program execution.

### Pointers

C / C++ languages offer a specialized data type: pointer to a memory area of a certain type. The value of a variable of this type is an integer representing a memory address. The size of the memory pointed to by this pointer is determined by the specified data type [^4].

Pointer declaration is performed by specifying the type, then the special sign `*`, then the variable name.

```cpp
// <type> * <pointer_name>;
int * sampleIntPointer;
char * sampleCharPointer;
```

In the example, `sampleIntPointer` may contain the address of a 4-byte memory area.

To initialize a pointer, the variable must be assigned the address of a memory cell. The address of a variable is obtained using the special symbol `&`.

Pointer usage example:

```cpp
#include <iostream>

int main() {
    int coolValue = 256;
    int * intPtr = &coolValue;
    char * charPtr = (char*)&coolValue;

    std::cout << "Cool value = " << coolValue << std::endl;
    std::cout << "pointer of cool value = " << intPtr << std::endl;
    std::cout << "access value by pointer = " << *intPtr << std::endl;
    std::cout << "first byte = " << (int)*charPtr << std::endl;
    std::cout << "second byte = " << (int)*(charPtr + 1) << std::endl;
    std::cout << "third byte = " << (int)*(charPtr + 2) << std::endl;
    std::cout << "fourth byte = " << (int)*(charPtr + 3) << std::endl;

    return 0;
}
```

Reference behavior is similar to constant pointer behavior.

### References

Variable declaration allocates memory on the stack, into which a value may be stored later. In some cases, it is necessary to introduce aliases for variables. These aliases are called references and are declared using the `&` (ampersand) sign.

Reference declaration example:

```cpp
int a = 10;
int& another_ref_a = a;
```

__A reference is always initialized, and it is initialized by another variable.__

```cpp
#include <iostream>

int main() {
    int value = 10;
    int &ref = value;

    std::cout << "value: " << value << ", reference = " << ref << std::endl;
    value = 12;
    std::cout << "value: " << value << ", reference = " << ref << std::endl;
    ref = 15;
    std::cout << "value: " << value << ", reference = " << ref << std::endl;
    return 0;
}
```

Since a reference is an alias for an existing variable, changing the variable value changes the reference value.

Most often, a reference is used when declaring function parameters.

### Memory allocation and deallocation

C++ language uses the `new` and `delete` operators for memory allocation and deallocation.

The `new` operator allocates memory for an object and returns a pointer to this object. The `delete` operator deallocates memory allocated for the object.

```cpp
int * intPtr = new int;
*intPtr = 10;
std::cout << *intPtr << std::endl;
delete intPtr;
```

### Arrays

An array is a data structure that allows storing several elements of the same type. To declare an array, specify the data type, array name, and the number of elements in square brackets. Access to array elements is performed using the element index in square brackets.

```cpp
int sampleArray[10];
sampleArray[0] = 10;
sampleArray[10] = 20; // error! index is greater than or equal to the array size
```

An array may be allocated dynamically in memory using the `new` operator. This allows allocating memory for the array at runtime. After using the array, memory must be properly deallocated using the `delete` operator.

```cpp
int * sampleArray = new int[10];
sampleArray[0] = 10;

// delete[] is used to deallocate memory allocated for an array
// deleting the sampleArray array with delete will cause an error
delete[] sampleArray;
```

## Bibliography

[^1]: [C++ Keywords](https://en.cppreference.com/w/cpp/keyword)
[^2]: [Main function](https://en.cppreference.com/w/cpp/language/main_function)
[^3]: [Schildt] Herbert Schildt. C++: The Complete Reference, 4th Edition. McGraw-Hill Education, 2003. ISBN: 978-0-07-223215-8
[^4]: [Pointer declaration](https://en.cppreference.com/w/cpp/language/pointer)
