# LobbyWars 💼
---
Approach to LobbyWars

## How to install & run 🚀
---
After git clone, move to project directory and **.env** file

```
 touch .env
 ```

Then install dependencies with **PHP Composer**:

```
composer install
```

To **run tests**:
```
php bin/phpunit
```

To **run app**:

```
symfony server:start
```

And at explorer go to: http://localhost:8000/

## Architecture 🧅
---

![Architecture ](https://ekiketa.es/wp-content/uploads/2022/08/ddd-layers.png)

This is one approach to DDD / Ports and Adapters / Hexagonal.
At image, this arrows means that internal layers doesn't know external layers. Only external layers knows internal layers.

I developed it being fully Symfony agnostic and when the use cases was working I implemented the framework controllers. If we move along commits we can run tests without any Symfony logic.

## Some considerations 🌚
---
- TDD
- Git setted with git-flow
- Command and Query
- CSS / Methodology / BEM
- ES6 imports
- PHP 8.1.8 With types
- API-first approach
- Alphabetize your CSS properties
- CSS Variables


### License
---

Coded with ♥️  by Kike Beltrán