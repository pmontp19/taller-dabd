# Practica final DABD
_Disseny i administració de bases de dades_
Objectiu: dissenyar una aplicació a partir d'un problema i un disseny UML.

# Getting started
## Requisits
- PHP 7.1.3 o superior;
- [i els requeriments usuals de Symfony](https://symfony.com/doc/current/reference/requirements.html)

## Usage
Clonar o baixar el repositori. Modificar les variables per la connexió amb la base de dades SQL.

Crear la base de dades i les taules
```
cd taller-dabd
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:database:migrate
```

Posar en marxa el servidor web intern
```
php bin/console server:run
```
