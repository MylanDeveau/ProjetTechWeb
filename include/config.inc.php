<?php
// Paramètres de l'application

define('DBHOST', "localhost");
define('DBNAME', "rencontre");
define('DBUSER', "database");
define('DBPASSWD', "supersecret");
define('ENV','dev');
define('SALT','48@!alsd');
define('DBPORT',3306);
// pour un environememnt de production remplacer 'dev' (développement) par 'prod' (production)
// les messages d'erreur du SGBD s'affichent dans l'environememnt dev mais pas en prod
?>