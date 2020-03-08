# M151 - Projekt

## Infos

- PHP MVC Framework [Symfony](https://symfony.com/)
- CSS-Framework mit [Bulma](https://bulma.io/)
- Tooling mit Dependency-Manager [Composer](https://getcomposer.org/)
- Datenbankmanager mit [Doctrine](https://www.doctrine-project.org/)
- Templates mit [Twig](https://twig.symfony.com/doc/3.x/)

## Update Database

### Create Migration

    php bin/console doctrine:migrations:diff

### Push Migrations

    php bin/console doctrine:migrations:migrate
