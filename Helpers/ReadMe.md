1. Prérequis

PHP 8.5

MySQL

Composer

WAMP

2. Installation
   1️⃣ Cloner le projet
   git clone <lien-du-projet>
   cd projet

2️⃣ Installer les dépendances
composer install

3. Base de données

Créez une base MySQL.

executer les requêtes présentes dans le fichier requeteSQL.txt

4. Configuration

Dans Config/prod.ini (ou dev.ini), indiquez vos paramètres MySQL :

dsn = "mysql:host=localhost;dbname=VOTRE_DB;charset=utf8"
user = root
pass =

5. Lancer l’application
   ➤ Avec XAMPP / WAMP

Placez le projet dans www/ puis ouvrez votre projet dans un IDE (phpstorm, VSC...)


Puis lancez depuis le source index.php depuis l'IDE

6. Fonctionnalités principales

  - Ajouter / modifier / supprimer un personnage

- Ajouter un élément, une classe, une origine

- Tri des personnages

- Historique des actions (logs)