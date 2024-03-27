# Système d'Authentification Centralisé avec API Laravel

## Contexte du Projet
Notre client est une entreprise qui gère plusieurs applications tierces nécessitant une authentification centralisée. Ils souhaitent mettre en place un système robuste et sécurisé qui permettra aux utilisateurs de s'authentifier une seule fois pour accéder à toutes les applications. La solution doit être basée sur une API Laravel.

## Fonctionnalités

1. **Création d'un Administrateur par Défaut via une Seeder :**
   Pour démarrer le système, une seeder sera utilisée pour créer un administrateur par défaut avec des informations pré-définies.

2. **Gestion des Utilisateurs par l'Administrateur :**
   L'administrateur doit avoir la capacité de créer, modifier et supprimer des utilisateurs. Cela inclut la gestion des informations de base telles que le nom, l'email et le mot de passe.

3. **Authentification des Utilisateurs et Obtention d'un Jeton d'Accès :**
   Les utilisateurs doivent être en mesure de s'authentifier avec leurs identifiants et de recevoir un jeton d'accès qui leur permettra d'accéder aux données protégées des applications tierces.

4. **Création des Groupes et Polices :**
   Les utilisateurs seront organisés en groupes, et des polices seront utilisées pour contrôler l'accès aux ressources et fonctionnalités des applications.

5. **Tests Unitaires avec PHPUnit :**
   Des tests unitaires seront écrits pour chaque composant du système afin de garantir sa fiabilité et sa stabilité. PHPUnit sera utilisé comme outil de test.

6. **Documentation avec Swagger :**
   La documentation de l'API sera générée automatiquement avec Swagger. Cela permettra aux développeurs tiers d'explorer facilement les points d'extrémité disponibles et de comprendre comment les utiliser.

## Instructions d'Installation
1. Clonez le dépôt sur votre machine locale.
2. Installez les dépendances en utilisant Composer : `composer install`.
3. Configurez la base de données dans le fichier `.env`.
4. Exécutez les migrations et les seeders de la base de données : `php artisan migrate --seed`.
5. Démarrez le serveur de développement : `php artisan serve`.
6. Accédez à la documentation de l'API à l'adresse `http://localhost:8000/api/documentation`.

## Exécution des Tests
Pour exécuter les tests PHPUnit, utilisez la commande suivante :
`php artisan test`


## Contributeurs
- [Kholod]

## Licence
Ce projet est sous licence [Apache 2.0 License](http://www.apache.org/licenses/LICENSE-2.0.html).

