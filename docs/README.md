# polonia-in-space

## Description

Application is created to learn about how are enterprise web applications build. In application, we can notice the
division into directories like Domain, Infrastructure, Application, Presentation. It's called
[DDD](https://pl.wikipedia.org/wiki/Domain-driven_design) </br></br>
In domain layer we specify what we do, in infrastructure we make domain specified rules and in presentation we connect
to our application for example via HTTP.

# Run app

```
$ docker-compose up
$ symfony serve
```

# Run tests

```
$ php vendor/bin/phpunit tests
```

# Run code style and PHPStan

```
$ vendor/bin/ecs check --config vendor/landingi/php-coding-standards/ecs.php
$ vendor/bin/phpstan analyze -c phpstan.neon
```

![Screenshot](assets/appinfrastructure.png)
![Screenshot](assets/scientists.png)
![Screenshot](assets/researchstations.png)
