# Multithreaded Programming

- [Multithreaded Programming](#multithreaded-programming)
  - [Concepts of Multithreaded Programming](#concepts-of-multithreaded-programming)
  - [Threads](#threads)
  - [Working with the System and Threads](#working-with-the-system-and-threads)
  - [The Problem of Shared Data Between Threads](#the-problem-of-shared-data-between-threads)
    - [Mutexes](#mutexes)
    - [Atomic Variables and Operations](#atomic-variables-and-operations)
  - [Asynchronous Programming](#asynchronous-programming)

## Concepts of Multithreaded Programming

A __program__ is a sequence of instructions stored in a file, executable or interpretable. A __process__ is the direct execution of a program (its instructions). Sometimes, a process is also defined as a combination of the executing program and its associated resources: address space, global variables, open files, etc. Within a single process, one or more _threads_ can operate.

A __thread of execution__ (or simply __thread__) is the smallest unit of execution managed by the operating system. The implementation of threads and processes differs between operating systems, but in most cases, a thread exists within a process. Multiple threads can exist within the same process and share resources such as memory, whereas processes do not share these resources. In particular, threads share the instruction sequence of the process (its code) and its context—the values of variables (CPU registers and call stack) they have at any given time.

The ability of the operating system (and processor) to execute multiple threads simultaneously is called __multithreading__. Modern computers allow several operations to be performed at once due to multiple processor cores.

A __parallel algorithm__ is an algorithm that can be implemented in parts on multiple computing devices with subsequent combination of the obtained results to produce a correct outcome. An example of a parallel algorithm is matrix addition and multiplication.

The term _parallel_ does not necessarily mean literal simultaneity. Two tasks are performed _in parallel_ if they occur during the same period of time.

__Parallel programming__ (or __multithreaded programming__) is a method of writing programs in which the solution to a problem is divided into several independent subtasks, each of which will be executed simultaneously with others, on different processors (cores) within a single physical or virtual computer.

__Distributed programming__ is a method of writing programs in which the solution to a problem is divided into several independent subtasks, each of which will be executed simultaneously with others, on different computers, physical or virtual.

When designing parallel algorithms, the following steps should be performed:

- __decomposition__ – the process of dividing the problem and its solution into parts;
- __communication__ – defining the interactions between parts of the solution;
- __synchronization__ – coordinating the order of execution of parts of the solution.

Threads running in parallel may have their own memory, but they also have access to shared memory, called __shared memory__.

Starting from the __C++11__ standard, the language provides support for multithreaded programming. C++ supports the following elements of parallel programming (classification by standards):

- __C++11__
  - memory model
  - atomic variables
  - threads
  - mutexes and locks
  - thread-local storage
  - tasks
- __C++14__
  - read/write locks
- __C++17__
  - parallel algorithms
- __C++20__
  - atomic smart pointers
  - joining threads
  - latches and barriers
  - general semaphores
  - coroutines

## Threads

Working with threads in C++ is defined in the `<thread>` header. A thread is created by declaring an object of the `std::thread` class, passing the function to be executed in the child thread as a constructor parameter, as well as any arguments for that function.

A simple example of creating a child thread is shown below:

```cpp
/**
  * @file thread_example.cpp
  * @brief Example of creating a thread
  * @details g++ -std=c++11 thread_example.cpp -o thread_example
  */
#include <thread>
#include <iostream>

void hello() {
    std::cout << "hello!";
}
int main() {
    std::thread t(hello);
    t.join();
    return 0;
}
```

In this example, a thread is created in which the `hello` function is executed, and the main program waits for the child thread to finish (`t.join();`). If you do not wait for the child thread to finish, the program's behavior is undefined (and usually results in the child thread crashing with an error).

Starting from __C++20__, you can create automatically joining threads using the `std::jthread` class.

```cpp
/**
  * @file jthread_example.cpp
  * @brief Example of creating a thread
  * @details g++ -std=c++20 jthread_example.cpp -o jthread_example
  */
#include <thread>
#include <iostream>

void hello() {
    std::cout << "hello from " << std::this_thread::get_id() << std::endl;
}

int main() {
    std::jthread t(hello);
    return 0;
}
```

## Working with the System and Threads

To work efficiently with the operating system, it is important to know its configuration. In particular, when working with threads, it is useful to know how many cores are available to the operating system. The C++ standard library provides the following function to get the number of cores available to the OS:

```cpp
std::thread::hardware_concurrency();
```

This function returns the number of processor cores available to the operating system. If the number of cores is unknown, the function returns 0.

Additionally, the C++ standard library provides the following methods for working with threads:

- `std::this_thread::get_id()` – returns the ID of the current thread;
- `std::this_thread::sleep_for(<time duration>)` – suspends the execution of the current thread for `<time duration>`. The time is specified as an object of the `std::chrono::duration` class;
- `std::this_thread::sleep_until(<time point>)` – suspends the execution of the current thread until `<time point>`. The time is specified as an object of the `std::chrono::time_point` class.

Example usage:

```cpp
/**
  * @file 23_threads_01.cpp
  * @brief Example of working with threads
  * @details g++ -std=c++11 23_threads_01.cpp -o 23_threads_01
  */
#include <iostream>
#include <vector>
#include <thread>
#include <chrono>

int main() {
    unsigned int total_threads = std::thread::hardware_concurrency();
    std::cout << "threads: " << total_threads << std::endl;
    if(total_threads == 0) {
        std::cout << "unknown number of threads, exit" << std::endl;
        return 1;
    }

    std::cout << "main thread id: " << std::this_thread::get_id() << std::endl;

    std::vector<std::thread> threads;

    for(unsigned int i = 0; i < total_threads; ++i) {
        threads.push_back(std::thread([i]() {
            std::cout << "thread id: " << std::this_thread::get_id() << " started" << std::endl;
            std::this_thread::sleep_for(std::chrono::seconds(i));
            std::cout << "thread id: " << std::this_thread::get_id() << " finished" << std::endl;
        }));
    }
    for(unsigned int i = 0; i < total_threads; ++i) {
        threads[i].join();
    }
    return 0;
}
```

## The Problem of Shared Data Between Threads

One of the problems of parallel programming is the interaction of threads with shared memory. If two threads have access to the same memory segment, they can interfere with each other by changing the value stored in that segment. The problem where the result of operations in two or more threads depends on their execution order is called a __race condition__.

Solutions to the race condition problem:

- wrap the data structure in a protection mechanism that guarantees the object can only be modified by the thread that has acquired it;
- rewrite the data structure to eliminate races (lock-free programming).

### Mutexes

A __mutex__ (from "mutual exclusion") is a simple object (synchronization primitive) that marks all code fragments accessing the same data structure to prevent race conditions.

A mutex is declared in the `<mutex>` header as `std::mutex`. Locking/unlocking is performed using the `lock`/`unlock` methods, but direct use is not recommended. Instead, it is recommended to use the `std::lock_guard` class, which automatically locks the mutex when the object is created and unlocks it when destroyed.

```cpp
/**
  * @file mutex_example.cpp
  * @brief Example of using a mutex
  * @details g++ -std=c++11 mutex_example.cpp -o mutex_example
  */
#include <iostream>
#include <thread>
#include <mutex>
#include <vector>
#include <algorithm>

using vector = std::vector<int>;

std::mutex locker;

void populate_vector(vector& v, size_t size) {
    std::lock_guard<std::mutex> lg(locker);
    std::this_thread::sleep_for(std::chrono::microseconds(10));
    while(size > 0) {
        v.push_back(size);
        --size;
    }
}

void find_value(const vector& v, size_t value) {
    std::lock_guard<std::mutex> lg(locker);
    auto it = std::find(v.begin(), v.end(), value);
    it == v.end()
        ? std::cout << "not found!" << std::endl
        : std::cout << "found!" << std::endl;
}

int main() {
    vector v;
    std::jthread t_populate(populate_vector, std::ref(v), 10);
    std::jthread t_find2(find_value, std::cref(v), 7);
    return 0;
}
```

### Atomic Variables and Operations

An operation is called __atomic__ if it cannot be performed partially: it is either performed completely or not at all. An atomic operation can only be performed by one thread at a time.

Atomicity can be provided either by hardware or software. In the first case, special machine instructions are used, whose atomicity is guaranteed by the processor. In the second case, synchronization mechanisms are used to lock the shared resource for the operation. _Locking is an atomic operation_.

An __atomic data type__ is a data type for which operations are atomic.

Standard atomic types are defined in the `<atomic>` header.

> [!NOTE]
> `std::atomic` works only with types that are [TriviallyCopyable](https://en.cppreference.com/w/cpp/named_req/TriviallyCopyable). For simple types like `int`, `float`, or pointers, atomic operations are always supported. For user-defined types (e.g., structures), atomic operations are only possible if the type is trivially copyable (i.e., can be copied with `memcpy` and does not have custom copy/move constructors, destructors, or virtual methods). Attempting to use `std::atomic` with a non-trivially copyable type will result in a compilation error.

__Example of using `std::atomic`:__

```cpp
/**
  * @file atomic_example.cpp
  * @brief Example of using std::atomic
  * @details g++ -std=c++11 atomic_example.cpp -o atomic_example
  */
#include <iostream>
#include <thread>
#include <atomic>
#include <vector>

std::atomic<int> counter{0};

void increment(int times) {
    for (int i = 0; i < times; ++i) {
        ++counter; // atomic increment
    }
}

int main() {
    const int num_threads = 4;
    const int increments_per_thread = 10000;
    std::vector<std::thread> threads;

    for (int i = 0; i < num_threads; ++i) {
        threads.emplace_back(increment, increments_per_thread);
    }
    for (auto& t : threads) {
        t.join();
    }

    std::cout << "Final counter value: " << counter << std::endl;
    return 0;
}
```

In this example, multiple threads increment a shared atomic counter. Thanks to `std::atomic`, all increments are performed safely without data races.

## Asynchronous Programming

__Asynchronous programming__ is a way of organizing a program in which some operations are not performed in the order they were called. Instead of waiting for an operation to complete, the program continues to work, and the operation completes in the background.

The C++11 standard introduced the `std::future` class, which allows you to obtain the result of an asynchronous operation. The `std::future` class represents an object that stores the result of an asynchronous operation and provides methods to check for completion and retrieve the result. An asynchronous operation is implemented using the `std::async` function, which takes as parameters the
