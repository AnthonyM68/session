<h1>Session</h1>
<h2>Centre de formation</h2>
Réalisation d'une application Web permettant de gérer des sessions de formations pour administrateurs d'un centre de formation

L'application sera seulement accessible par les administrateurs du centre.

Chaque session a un nombre de places limité et est définie par une date de démarrage et de fin.

A tout moment l'application est en mesure d'affiché le nombre de places restantes en fonction du nombre de personnes inscrites.

Chaque session de formation possède un programme constitué d'un ou plusieurs cours (module) appartenant à une certaine catégorie. Chaque cours(module) possède une duréeprécise, en nombre de jours qui peuvent varier d'une session de formation à l'autre.

# Bonus :

- nous utiliserons symfony sur ce projet, ainsi que pour la création d'entrées en utilisant la gestion de forms et d'users

# Schémas :

> Réalisation des schémas conceptuels de données :
> ![MCD](https://github.com/AnthonyM68/session/blob/master/MCD.jpg)
> ![UML](https://github.com/AnthonyM68/session/blob/master/UML.jpg)
> ![MLD](https://github.com/AnthonyM68/session/blob/master/MLD.jpg)

# NOTE :
```php
$ git clone https://github.com/AnthonyM68/session.git
```
```php
$ composer update 
```
Utilisez la base de données fournie dans le dépot et modifiez le fichier .env si besoin

> .env

```php
###> doctrine/doctrine-bundle ###
# Format described at https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
# IMPORTANT: You MUST configure your server version, either here or in config/packages/doctrine.yaml
#
# DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
# DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8.0.32&charset=utf8mb4"
DATABASE_URL="mysql://root@127.0.0.1:3306/session"
#DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=16&charset=utf8"
###< doctrine/doctrine-bundle ###
```



<h3 align="center">Languages and Tools:</h3>
<div align="center">
<a href="https://www.mysql.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" alt="mysql" width="40" height="40"/> </a>
<a href="https://www.php.net" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" alt="php" width="40" height="40"/> </a>
</div>
