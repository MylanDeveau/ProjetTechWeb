<p>ACCUEIL</p>
<?php
//affiche le nom de la 1ere personne dans la db
$pdo = new Mypdo();
$PM = new PersonneManager($pdo);
$personne = $PM->getPersonne(1);
?><p><?php echo $personne->getNom(); ?></p>