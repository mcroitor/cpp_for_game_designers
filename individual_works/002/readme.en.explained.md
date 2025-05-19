# Creating and Using Classes. Multi-file Projects. Project Build.

## Objective

By completing this assignment, the student becomes familiar with the specifics of class implementation and interaction with class objects. The student also obtains basic knowledge about building projects from the command line.

## Task

The assignment is performed based on the previous laboratory work. To simplify the process, it is recommended to use the `Visual Studio Code` development environment, with the `MinGW G++` compiler installed in the operating system, the `make` program for building projects, and also `GIT`.

### Creating a branch

Open a console window and navigate to the `SnakeGame` folder. Get the latest changes of the project by executing the commands:

```bash
# select default branch
git checkout main
# get last changes
git pull
```

Create a branch in which you will perform the assignment:

```bash
# create branch and switch to it
git checkout -B lab02
```

### Adding cpp files

For each `.hpp` file, create a corresponding `.cpp` file. Each C++ file must contain implementations of the class functions declared in the header files.

Approximate content of `.cpp` files:

1. `apple.cpp`

    ```cpp
    #include "apple.hpp"

    Apple::Apple() {}
    Apple::Apple(const Point &position) {}
    Point Apple::GetPosition() const {}
    ```

2. `board.cpp`

    ```cpp
    #include "board.hpp"

    Board::Board(int width, int height) {}
    int Board::GetWidth() const {}
    int Board::GetHeight() const {}
    ```

3. `direction.cpp`

    ```cpp
    #include "direction.hpp"
    ```

4. `game_engine.cpp`

    ```cpp
    #include "game_engine.hpp"

    GameEngine::GameEngine() {}
    void GameEngine::Init() {}
    void GameEngine::Run() {}
    ```

5. `painter.cpp`

    ```cpp
    #include "painter.hpp"

    void Painter::DrawImage(Point topLeft, Point bottomRight, char **image) {}
    void Painter::WriteText(Point position, char *text) {}
    ```

6. `point.cpp`

    ```cpp
    #include "point.hpp"
    ```

7. `snake.cpp`

    ```cpp
    #include "snake.hpp"

    Snake::Snake() {}
    Snake::Snake(const Point &_position) {}
    void Snake::Move(Direction direction) {}
    int Snake::GetSize() const {}
    Point Snake::GetPosition() const {}
    void Snake::Eat(const Apple &apple) {}
    ```

Also create a file `main.cpp`, which will contain the entry point:

```cpp
#include "game_engine.hpp"

int main() {
    GameEngine engine;
    engine.Init();
    engine.Run();
    return 0;
}
```

### Compilation from the command line

To check the compiler operation, in the command line, go to the project directory and execute the following command:

```bash
g++ apple.cpp -o apple.o -c
```

The `-c` flag tells the compiler to create an object file. As a result of this command, a file `apple.o` will be created in the directory.

### Creating a build file

In the project directory, create a `Makefile` file with the following content:

```makefile
all: SnakeGame

SnakeGame: apple.o board.o direction.o game_engine.o painter.o point.o snake.o main.o
    g++ -o Snake.exe apple.o board.o direction.o game_engine.o painter.o point.o snake.o main.o

apple.o:
    g++ apple.cpp -o apple.o -c

board.o:
    g++ board.cpp -o board.o -c

direction.o:
    g++ direction.cpp -o direction.o -c

game_engine.o:
    g++ game_engine.cpp -o game_engine.o -c

painter.o:
    g++ painter.cpp -o painter.o -c

point.o:
    g++ point.cpp -o point.o -c

snake.o:
    g++ snake.cpp -o snake.o -c

main.o:
    g++ main.cpp -o main.o -c

clean:
    rm -f *.o *.exe
```

In the command line, execute the following commands:

```bash
# clean directory from objects and executables
make clean
# build application
make
```

In the project directory, the application `Snake.exe` and a number of object files with the `.o` extension will be created.

### Publishing the branch and merging it

```bash
# add all files to tracking
git add *
# check status
git status
# create a commit
git commit -m "first compilation"
# push commit to remote repository
git push
```

After this, you can add the created branch to the `main` branch.

## Submission

To submit your result, attach a link to your GitHub repository to the assignment in Moodle.

## Grading

- `2p` – implementation of methods for data types;
- `2p` – creation of a project build file;
- `1p` – creation of a `.gitignore` file;
- `1p` – description of the project build method in the `README.md` file;
- `2p` –  adding `.cpp` files and the build file to GitHub in the `lab02` branch;
- `2p` – the work is presented and defended;
- `-1p` – for each day of late submission;
- `-5p` – for plagiarism.
