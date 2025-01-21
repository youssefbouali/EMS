# EMS : Application de Gestion des Examens

Cette application est conçue pour faciliter la gestion des examens dans un environnement académique. Elle offre des fonctionnalités essentielles permettant aux enseignants, étudiants et administrateurs de gérer efficacement le processus des examens.

## Fonctionnalités Principales

- **Saisie des Notes** : Les enseignants peuvent enregistrer et modifier les notes des étudiants pour chaque examen.
- **Réclamations** : Les étudiants peuvent soumettre des réclamations concernant leurs résultats d'examen pour révision.
- **Consultation des Résultats** : Les étudiants peuvent consulter leurs notes et résultats finaux directement sur la plateforme.
- **Sécurité et Authentification** : Accès sécurisé via des rôles et des permissions spécifiques.

## Technologies Utilisées

- **Back-end** : Php avec codeigniter4
- **Front-end** : React
- **Base de Données** : MySQL

HEAD
## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> - The end of life date for PHP 8.1 will be December 31, 2025.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

# Diagramme de Classe

Voici le diagramme de classe de notre application :

```mermaid
classDiagram
    class User {
        +int id
        +string nom
        +string prenom
        +string cne
        +string cni
        +string dateNaissance
        +inscription()
    }

    class Account {
        +int id
        +string email
        +string password
        +add()
        +login()
        +updateAccount()
        +deleteAccount()
        +getAccountByEmail()
    }

    class Role {
        +int id
        +string role_name
        +add()
        +get()
    }

    class Note {
        +int id
        +float noteNormal
        +float noteRattrapage
        +bool valide
        +int idUserProfessor
        +int idUserStudent
        +archiveOldNote()
        +getNotesByProfessor()
        +getNotesByStudent()
        +getNoteById()
    }

    class Module {
        +int id
        +string nom
        +string description
        +int idSector
        +getModulesBySectorUser()
        +getModuleById()
    }
    class Sector {
        +int id
        +string nom
        +string description
        +getSectorByUser()
        +getSectorById()
    }

    %% Relations
    User --> Account : "possède un"
    Account --> Role : "a un rôle"
    User --> Note : "soumet"
    Note --> Module : "appartient à"
    Module --> Sector : "fait partie de"
    
    %% Rôle spécifique
    User : +string cne (visible si rôle = "Etudiant")
    User : +string cni (visible si rôle = "Prof")
    User : +string dateNaissance (visible si rôle = "Etudiant")

    %% Cardinalités
    User "1" --> "1" Account : "possède un"
    Account "1" --> "1" Role : "a un rôle"
    User "1" --> "0..*" Note : "soumet"
    Note "0..*" --> "1" Module : "appartient à"
    Module "1..*" --> "1" Sector : "fait partie de"

e3453189555336c55cc72cc6564294ab1765e588
