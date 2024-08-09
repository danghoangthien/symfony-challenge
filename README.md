# symfony-challenge

## Class Diagram
+--------------------+          +-----------------+          +--------------------+
|  UserController    |          |   UserService   |          |   UserRepository   |
|--------------------|          |-----------------|          |--------------------|
| - userRepository   |<>--------| - userRepository|<>--------| Extends            |
| - formFactory      |          | - createUser()  |          | ServiceEntityRepo- |
| - userService      |<>--------| - findUserById()|          | sitory             |
|                    |          | - deleteUser()  |          |                    |
| + fetchUser()      |          | + getAllUsers() |          | - save()           |
| + createUser()     |          |                 |          | - find()           |
| + deleteUser()     |          |                 |          | - delete()         |
+--------------------+          +-----------------+          +--------------------+
          |                             |                            |
          |                             |                            |
          v                             v                            |
+-------------------+         +----------------+                     |
| CreateUserDTO     |         | User           |<>-------------------+
|-------------------|         |----------------|
| - firstname       |         | - id           |
| - lastname        |         | - data         |
| - address         |         |                |
|                   |         | + getId()      |
| + getFirstname()  |         | + setId()      |
| + getLastname()   |         | + getData()    |
| + getAddress()    |         | + setData()    |
+-------------------+         +----------------+
                                     |
                                     |
                                     v
                        +-----------------------+
                        | FormErrorHelper       |
                        |-----------------------|
                        | + getFormErrors()     |
                        +-----------------------+
