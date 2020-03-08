# M151 - Projekt

## Infos

- PHP MVC Framework [Symfony](https://symfony.com/)
- CSS-Framework mit [Bulma](https://bulma.io/)
- Icons mit [FontAwesome](https://fontawesome.com/)
- Tooling mit Dependency-Manager [Composer](https://getcomposer.org/)
- Datenbankmanager mit [Doctrine](https://www.doctrine-project.org/)
- Templates mit [Twig](https://twig.symfony.com/doc/3.x/)

## Setup

``` bash
    # Install dependencies
    composer install

    # Edit the env file and add DB params

    # Create Article schema
    php bin/console doctrine:migrations:diff

    # Run migrations
    php bin/console doctrine:migrations:migrate
```

## Start

``` bash
    # Build for production (TODO!)
    npm run build

    # Run symfony server
    symfony server:start
```

## Update Database

### Create Migration

``` bash
    php bin/console doctrine:migrations:diff
```

### Push Migrations

``` bash
    php bin/console doctrine:migrations:migrate
```
