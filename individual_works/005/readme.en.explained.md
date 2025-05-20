# Creating and Using Modules / Libraries

## Objective

By completing this assignment, the student becomes familiar with the specifics of creating programming libraries and their usage.

## Task

The assignment is performed based on the previous laboratory work, in the `lab05` branch.

### Creating the lab05 branch

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
git checkout -B lab05
```

### Updating the build file

Define variables that will list all dynamic libraries to be created as part of this work:

```makefile
DLLS=apple.dll board.dll direction.dll point.dll snake.dll
LDFLAGS=-L$(BINDIR) -lapple -lboard -ldirection -lpoint -lsnake
```

For each data class, define its own library. For example, change the compilation of the `point.cpp` file as follows:

```makefile
# Point
point.o:
    $(CC) $(SRCDIR)/point.cpp -o $(OBJDIR)/point.o -c

point.dll:
    $(CC) $(OBJDIR)/point.o -shared -o $(BINDIR)/point.dll
```

Similarly, define compilation for the files `apple.cpp`, `board.cpp`, `direction.cpp`, and `snake.cpp`. Keep in mind that the `Apple` and `Board` classes depend on the `Point` class, and the `Snake` class depends on the `Point` and `Apple` classes.

Rewrite the project build as follows:

```makefile
$(APPNAME): game_engine.o painter.o main.o $(DLLS)
    $(CC) -o $(BINDIR)/$(APPNAME) \
        $(OBJDIR)/game_engine.o $(OBJDIR)/painter.o $(OBJDIR)/main.o \
        $(LDFLAGS)
```

### Verification

Build the project:

```bash
make
```

Check for the presence of all dynamic libraries and the executable file:

```bash
ls -l bin/*
```

### Committing changes

Commit the changes to the local repository and push them to GitHub:

```bash
git add .
git commit -m "feat(lab05): build dynamic libraries"
git push origin lab05
```

Create a pull request to merge the changes into the main branch of the project.

## Submission

To submit your result, attach a link to your GitHub repository to the assignment in Moodle.

## Grading

- `3p` – creation of libraries;
- `3p` – usage of libraries;
- `2p` – updating the build file;
- `2p` - the work is presented and defended;
- `-1p` - for each day of late submission;
- `-5p` - for plagiarism.
