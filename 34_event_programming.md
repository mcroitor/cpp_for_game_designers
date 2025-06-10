# Event-Driven Programming

- [Event-Driven Programming](#event-driven-programming)
  - [Key Concepts](#key-concepts)
  - [Application Architecture](#application-architecture)
  - [Example](#example)
  - [Libraries and Frameworks](#libraries-and-frameworks)
  - [Bibliography](#bibliography)

## Key Concepts

An information system can be viewed as an object with state and behavior. The state of an information system is defined by a set of values (attributes) describing the system. The behavior of the system is defined by a set of actions that can be performed on the system.

A change in the state of an object is called an __event__. As a result of an event, a message is created containing information about the event that occurred, which can be processed by the system. Often, the event and the message created as a result of the event are used as synonyms.

Events initiated by external factors are called __external events__, while events initiated by the system itself are called __internal events__.

The information system responds to event messages by processing them with special methods called __event handlers__.

__Event-driven programming__ (or __event-oriented programming__) is a programming paradigm that focuses on event handling. A program written according to the principles of event-driven programming consists of a set of event handlers that are called when certain events occur.

Event-driven programming involves dividing the program into independent parts, each responsible for handling a specific event. These parts of the information system can run in separate threads and interact with each other through events.

This approach simplifies the development and maintenance of the program, as each event handler can be implemented as a separate function or method.

## Application Architecture

Event-driven programming is widely used in graphical user interfaces, as it allows the program to respond to user actions. In a graphical interface, events can be associated with various interface elements such as buttons, input fields, menus, etc. Each interface element can generate events that should be handled by the corresponding event handlers.

Event-driven programming allows you to divide the application logic into independent parts, each responsible for handling a specific event. This simplifies development and maintenance, as each event handler can be implemented as a separate function or method.

The simplest architecture of an event-driven application includes the following components:

- __Event__ — a signal message sent to the information system that can be processed. An event contains information about the event type and additional data needed for processing.

The simplest way to define events in a system is to use an enumeration (enum) for all possible event types. For example, for a graphical interface, you can define the following event types:

```cpp
enum class EventType {
    NoEvent,
    ButtonClick,
    MouseMove,
    KeyPress
};

struct Event {
    EventType type;
    // additional data
};
```

More complex events may contain additional data, such as information about the object that generated the event.

- __Event source__ — an object that generates events. An event source can be a GUI element (such as a button or input field) or another part of the program (such as a network socket or file descriptor).
- __Event queue__ — a data structure that stores events waiting to be processed. The event queue separates the process of generating events from their processing.

The simplest implementation of an event queue is a FIFO queue (First-In-First-Out), where events are added to the end and removed from the front.

```cpp
class EventQueue {
    std::deque<Event> events;
public:
    void Push(const Event& event) {
        events.push_back(event);
    }

    Event Pop() {
        if(events.empty()) {
            return Event{EventType::NoEvent};
        }
        Event event = events.front();
        events.pop_front();
        return event;
    }
};
```

- __Event handler__ — a function or method that is called when a specific event occurs. The event handler performs the necessary actions in response to the event.

Usually, an event handler interface is defined, declaring a method for handling events. Each event handler implements this interface.

```cpp
struct EventHandler {
    virtual void operator()(const Event& event) = 0;
    virtual ~EventHandler() = default;
};
```

Alternatively, event handlers can be implemented as class methods; in this case, the class object should regularly check the event queue and call the appropriate event handler for the object.

- __Event dispatcher__ — a program component responsible for generating events and adding them to the event queue. The event dispatcher connects the event source with the corresponding event handlers.

The simplest way to implement an event dispatcher is to use a mapping table of events to event handlers. You can also use a regular switch statement to select the event handler.

```cpp
EventHandler buttonClickHandler;
EventHandler mouseMoveHandler;
EventHandler keyPressHandler;

void DispatchEvent(const Event& event) {
    switch (event.type) {
        case EventType::ButtonClick:
            buttonClickHandler(event);
            break;
        case EventType::MouseMove:
            mouseMoveHandler(event);
            break;
        case EventType::KeyPress:
            keyPressHandler(event);
            break;
    }
}
```

- __Event loop__ — the main loop of the program, which retrieves events from the event queue and passes them to the appropriate event handlers.

Usually, the event loop is an infinite loop that retrieves events from the event queue and passes them to the handlers. The event loop can be stopped, for example, when the program terminates.

```cpp
EventQueue eventQueue;

void EventLoop() {
    while (true) {
        Event event = eventQueue.Pop();
        DispatchEvent(event);
    }
}
```

## Example

As an example, consider a system with a virtual cat. The virtual cat can generate the following events:

- __hungry__ — the cat is hungry and wants to eat;
- __wants affection__ — the cat wants affection and to play;
- __full__ — the cat is full and wants to sleep.

The user can generate the following events:

- __feed__ — the user feeds the cat;
- __pet__ — the user pets the cat;
- __exit__ — the user exits the system.

Events are generated by the virtual cat and the user and added to the event queue. The event handling system retrieves events from the queue and passes them to the appropriate handlers.

```cpp
enum class EventType {
    CatHungry,
    CatWantsToPlay,
    CatSleepy,
    FeedCat,
    PetCat,
    SystemExit
};

struct Event {
    EventType type;
    // additional data
};
```

In this case, event handlers can be implemented as follows:

```cpp
struct EventHandler {
    virtual void operator()(const Event& event) = 0;
    virtual ~EventHandler() = default;
};

struct CatHungryHandler : public EventHandler {
    void operator()(const Event& event) override { /* handle event */ }
};

struct CatWantsToPlayHandler : public EventHandler {
    void operator()(const Event& event) override { /* handle event */ }
};

struct CatSleepyHandler : public EventHandler {
    void operator()(const Event& event) override { /* handle event */ }
};

struct FeedCatHandler : public EventHandler {
    void operator()(const Event& event) override { /* handle event */ }
};

struct PetCatHandler : public EventHandler {
    void operator()(const Event& event) override { /* handle event */ }
};

struct SystemExitHandler : public EventHandler {
    void operator()(const Event& event) override { exit(0); }
};
```

Without a virtual destructor, deleting through `std::shared_ptr<EventHandler>` may cause a memory leak if the derived class allocates resources.

The event dispatcher is sometimes implemented as a mapping table of events to event handlers:

```cpp
std::map<EventType, std::shared_ptr<EventHandler>> eventHandlers = {
    {EventType::CatHungry, std::make_shared<CatHungryHandler>()},
    {EventType::CatWantsToPlay, std::make_shared<CatWantsToPlayHandler>()},
    {EventType::CatSleepy, std::make_shared<CatSleepyHandler>()},
    {EventType::FeedCat, std::make_shared<FeedCatHandler>()},
    {EventType::PetCat, std::make_shared<PetCatHandler>()},
    {EventType::SystemExit, std::make_shared<SystemExitHandler>()}
};
```

The familiar event loop retrieves events from the queue and passes them to the appropriate handlers:

```cpp
void EventLoop() {
    while (true) {
        Event event = eventQueue.Pop();
        (*eventHandlers[event.type])(event);
    }
}
```

It is important that program objects do not interact with each other directly. Instead, they should generate events and pass them to the appropriate handlers. This reduces coupling between components and makes the program easier to extend.

## Libraries and Frameworks

There are many libraries and frameworks that simplify the development of programs using event-driven programming. Some of the most popular libraries and frameworks for GUI development are:

- __WinAPI__ — a set of functions for developing Windows applications (Windows only).
- __MFC__ — a library for developing graphical interfaces in C++ (Windows only).
- __Qt__ — a cross-platform framework for developing graphical interfaces in C++.
- __GTK__ — a library for developing graphical interfaces in C.
- __wxWidgets__ — a cross-platform library for developing graphical interfaces in C++.
- __FLTK__ — a cross-platform library for developing graphical interfaces in C++.

Interaction with the graphical interface in these libraries is carried out using event-driven programming. Each interface element (for example, a button or input field) generates events that can be handled by defining the appropriate event handlers.

## Bibliography

1. [Event-driven programming, Wikipedia](https://en.wikipedia.org/wiki/Event-driven_programming)
2. Fowler M. _Design Patterns: Elements of Reusable Object-Oriented Software._ Addison-Wesley. (1994)
3. Gamma E., Helm R., Johnson R., Vlissides J. _Design Patterns: Elements of Reusable Object-Oriented Software._ Addison-Wesley. (1994)
4. [Windows API, Microsoft](https://docs.microsoft.com/en-us/windows/win32/apiindex/windows-api-list)
5. [MFC, Microsoft](https://docs.microsoft.com/en-us/cpp/mfc/mfc-desktop-applications)
6. [Qt, Qt Project](https://www.qt.io/)
7. [GTK, GTK](https://www.gtk.org/)
8. [wxWidgets, wxWidgets](https://www.wxwidgets.org/)
9. [FLTK, FLTK](https://www.fltk.org/)
