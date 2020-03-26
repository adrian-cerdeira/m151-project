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
    # Clone
    git clone https://github.com/ac-webdesign/m151-project.git
    cd m151-project.git

    # Install dependencies
    composer install

    # Edit the env file and add DB params

    # Create Database
    php bin/console doctrine:database:create

    # Create Migration (if Entity is changed)
    # php bin/console doctrine:migrations:diff

    # Run migrations
    php bin/console doctrine:migrations:migrate
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
