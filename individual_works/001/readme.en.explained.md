# Creating a Project. Working with GIT.

## Objective

By completing this assignment, the student learns to work with the GIT version control system and obtains basic knowledge about project organization.

## Task

The assignment is performed based on the previous laboratory work. To simplify the process, it is recommended to use the [`Visual Studio Code`](https://code.visualstudio.com/Download) development environment, with the [`MingW G++`](https://msys2.org) compiler installed in the operating system. [`GIT`](https://git-scm.com/downloads) must also be installed on the computer.

### 1. Register on [GitHub](https://github.com/)

### 2. Create a project

After authentication on GitHub, in the upper right corner, there is a `+` icon. By clicking on it, you can create a new repository.

![new repo](./images/image01.png)

Create a new, empty repository and name it `SnakeGame`.

### 3. Clone the repository to your local computer

Create a copy of the repository you have created. To do this, copy the repository link.

![repo ref](./images/image02.png)

Open the command line, navigate to the folder where you want to keep the project, and execute the command:

```bash
git clone <copied url>
```

Create a new branch for the assignment.

```bash
# create a new branch and switch to it
git checkout -B lab01
```

### 4. Create the file structure

In the resulting `SnakeGame` folder, create the following files:

- `point.hpp`:

```cpp
#pragma once

struct Point{
   int x;
   int y;
};
```

- `apple.hpp`

```cpp
#pragma once

#include "point.hpp"

class Apple {
   Point _position;
public:
   Apple();
   Apple(const Point& position);
   Point GetPosition() const;
};
```

- `direction.hpp`

```cpp
#pragma once

enum class Direction {
   Top, Left, Right, Bottom
};
```

- `snake.hpp`
  
```cpp
#pragma once

#include "apple.hpp"
#include "direction.hpp"
#include "point.hpp"

class Snake {
   Point _segments[100];
   int _nr_segments;
public:
   Snake();
   Snake(const Point& position);
   void Move(Direction direction);
   int GetSize() const;
   Point GetPosition() const;
   void Eat(const Apple& apple);
};
```

- `board.hpp`

```cpp
#pragma once

class Board {
   int _width;
   int _height;
public:
   Board(int width = 20, int height = 20);
   int GetWidth() const;
   int GetHeight() const;
};
```

- `game_engine.hpp`

```cpp
#pragma once
#include "apple.hpp"
#include "snake.hpp"
#include "board.hpp"

class GameEngine {
   Apple _apple;
   Snake _snake;
   Board _board;
public:
   GameEngine();
   void Init();
   void Run();
};
```

- `painter.hpp`

```cpp
#pragma once

#include "point.hpp"

class Painter {
public:
   void DrawImage(Point topLeft, Point bottomRight, const char** image);
   void WriteText(Point position, const char* text);
};
```

### 5. Add a project description

In the `SnakeGame` folder, create a `readme.md` file with the following description:

1. project name;
2. what the project represents;
3. what are the rules of the Snake game;
4. list all declared new data types, give a brief explanation for each (what objects of this type represent).

### 6. Publish the code on GitHub

In the repository folder, execute the following commands from the command line:

```bash
# add all files to tracking
git add *
# check status
git status
# create a commit
git commit -m "structure defined"
# push commit to remote repository
git push
```

After this, you can merge the created `lab01` branch into the `main` branch using a pull request.

## Submission

To submit your result, attach a link to your GitHub repository to the assignment in Moodle.

## Grading

- `1 point` – GitHub account is created;
- `1 point` – project repository is created;
- `3 points` – `hpp` files are created with the necessary structures;
- `2 points` – a project description is defined in the `README.md` file;
- `1 point` – the code is published on GitHub in the `lab01` branch;
- `2 points` – the work is presented and defended;
- `-1 point` – for each day of late submission;
- `-5 points` – for plagiarism.
