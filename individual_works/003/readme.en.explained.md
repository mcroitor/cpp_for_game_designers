# Constructors and Operators

## Objective

In this assignment, the student learns how to override operators and becomes familiar with the options for defining and using constructors.

Additionally, this assignment prepares the project for using the C++ Standard Library.

## Task

The assignment is performed based on the previous laboratory work.

### Creating the lab03 branch

Open a console window and navigate to the `SnakeGame` folder. Get the latest changes of the project by executing the commands:

```bash
# select the main branch
git checkout main
# get the latest changes
git pull
```

Create a branch in which you will perform the assignment:

```bash
# create a branch and switch to it
git checkout -B lab03
```

### Updating the `Point` class

Change the header file `point.hpp` as follows:

```cpp
#pragma once

#include <iostream>

struct Point{
   int x;
   int y;

   Point(int _x = 0, int _y = 0);
   Point(const Point& other);

   Point& operator = (const Point& other);
   bool operator == (const Point& other) const;
};

std::istream& operator >> (std::istream& in, Point& point);
std::ostream& operator << (std::ostream& out, const Point& point);
```

Change the file `point.cpp` as follows:

```cpp
#include "point.hpp"

Point::Point(int _x, int _y) : x(_x), y(_y) {}

Point::Point(const Point &other) : x(other.x), y(other.y) {}

Point& Point::operator=(const Point &other)
{
    if (this == &other) return *this;
    x = other.x;
    y = other.y;
    return *this;
}

bool Point::operator==(const Point &other) const
{
    return x == other.x && y == other.y;
}

std::istream& operator >> (std::istream& in, Point& point){
    int x, y;
    in >> x >> y;
    point = Point(x, y);
    return in;
}

std::ostream& operator << (std::ostream& out, const Point& point){
    out << point.x << " " << point.y;
    return out;
}
```

### Updating the `Apple` class

Change the header file `apple.hpp` as follows:

```cpp
#pragma once

#include <iostream>
#include "point.hpp"

class Apple {
   Point _position;
public:
   Apple();
   Apple(const Point& position);
   Apple(const Apple& other);
   Point GetPosition() const;

   Apple& operator = (const Apple& other);
   bool operator == (const Apple& other) const;
};

std::istream& operator >> (std::istream& in, Apple& apple);
std::ostream& operator << (std::ostream& out, const Apple& apple);
```

Change the file `apple.cpp` as follows:

```cpp
#include "apple.hpp"

Apple::Apple() : _position(0, 0) {}

Apple::Apple(const Point &position) : _position(position) {}

Apple::Apple(const Apple &other) : _position(other.GetPosition()) {}

Point Apple::GetPosition() const
{
    return _position;
}

Apple& Apple::operator = (const Apple& other){
    if (this == &other) return *this;
    _position = other.GetPosition();
    return *this;
}
bool Apple::operator == (const Apple& other) const{
    return GetPosition() == other.GetPosition();
}

std::istream& operator >> (std::istream& in, Apple& apple){
    Point position;
    in >> position;
    apple = Apple(position);
    return in;
}

std::ostream& operator << (std::ostream& out, const Apple& apple){
    out << apple.GetPosition();
    return out;
}
```

### Updating the `Board` class

Change the header file `board.hpp` as follows:

```cpp
#pragma once

#include <iostream>

class Board {
   int _width;
   int _height;
public:
   Board(int width = 20, int height = 20);
   Board(const Board& other);
   int GetWidth() const;
   int GetHeight() const;

   Board& operator = (const Board& other);
   bool operator == (const Board& other) const;
};

std::istream& operator >> (std::istream& in, Board& board);
std::ostream& operator << (std::ostream& out, const Board& board);
```

Change the file `board.cpp` as follows:

```cpp
#include "board.hpp"

Board::Board(int width, int height) : _width(width), _height(height) {}

Board::Board(const Board &other) : _width(other.GetWidth()), _height(other.GetHeight()) {}

int Board::GetWidth() const
{
    return _width;
}

int Board::GetHeight() const
{
    return _height;
}

Board& Board::operator=(const Board &other)
{
    if (this == &other) return *this;
    _width = other.GetWidth();
    _height = other.GetHeight();
    return *this;
}

bool Board::operator==(const Board &other) const
{
    return GetWidth() == other.GetWidth() && GetHeight() == other.GetHeight();
}

std::istream &operator>>(std::istream &in, Board &board)
{
    int width, height;
    in >> width >> height;
    board = Board(width, height);
    return in;
}

std::ostream &operator<<(std::ostream &out, const Board &board)
{
    out << board.GetWidth() << " " << board.GetHeight();
    return out;
}
```

### Updating the `Direction` class

Change the header file `direction.hpp` as follows:

```cpp
#pragma once

#include <iostream>

enum class Direction {
   Top, Left, Right, Bottom
};

std::ostream& operator<<(std::ostream& out, const Direction& direction);
```

Change the file `direction.cpp` as follows:

```cpp
#include "direction.hpp"

std::ostream& operator<<(std::ostream& out, const Direction& direction){
    switch (direction)
    {
    case Direction::Top:
        out << "Top";
        break;
    case Direction::Left:
        out << "Left";
        break;
    case Direction::Right:
        out << "Right";
        break;
    case Direction::Bottom:
        out << "Bottom";
        break;
    default:
        break;
    }
    return out;
}
```

### Abstract class AbstractPainter

Create the header file `abstract_painter.hpp`:

```cpp
#pragma once

#include "point.hpp"

struct AbstractPainter {
   virtual void DrawImage(Point topLeft, Point bottomRight, char** image) = 0;
   virtual void WriteText(Point position, const char* text) = 0;
};
```

### Updating the `Painter` class

Change the header file `painter.hpp` as follows:

```cpp
#pragma once

#include "abstract_painter.hpp"

class Painter: public AbstractPainter {
public:
   void DrawImage(Point topLeft, Point bottomRight, char** image) override;
   void WriteText(Point position, const char* text) override;
};
```

### Verification

Check the correctness of the program by building the project from the command line:

```bash
make
```

### Committing changes

Commit the changes to the local repository and push them to GitHub:

```bash
git add .
git commit -m "feat(lab03): add constructors and operators"
git push origin lab03
```

Create a pull request to merge the changes into the main branch of the project.

## Submission

To submit your result, attach a link to your GitHub repository to the assignment in Moodle.

## Grading

- `1p` - implementation of constructors;
- `1p` - implementation of the assignment operator;
- `2p` - implementation of comparison operators;
- `2p` - implementation of input and output operators;
- `2p` - implementation of the base abstract class;
- `2p` - the work is presented and defended;
- `-1p` - for each day of late submission;
- `-5p` - for plagiarism.
