<?php
$pdo = new Mypdo();
$managerSport = new SportManager($pdo);
$managerPersonne = new PersonneManager($pdo);
$managerPratique = new PratiqueManager($pdo);

$listeSport = $managerSport->getAllSport();
$listePersonne = $managerPersonne->getAllPersonne();
$listeNiveau = $managerPratique->getNiveauExistants();


 ?>

<p>Rechercher des partenaires</p>

<form method ="post" action ="#">

  Sport : <select size="1" name="id_sport">
  <option value="0" > Choissisez sport </option><?php
  foreach ($listeSport as $sport) {  ?>
      <option value= <?php echo $sport->getIdSport(); ?>>  <?php echo $sport->getNom(); ?> </option> <?php }?>
  </select> <br>

  Niveau : <select size="1" name="depart ">
  <option value="0" > Choissisez niveau </option><?php
  foreach ($listeNiveau as $niveau) {  ?>
      <option value= <?php echo $niveau->getNiveau(); ?>>  <?php echo $niveau->getNiveau(); ?> </option> <?php }?>
  </select> <br>

  Département : <select size="1" name="depart ">
  <option value="0" > Choissisez département </option><?php
  foreach ($listePersonne as $personne) {  ?>
      <option value= <?php echo $personne->getIdPersonne(); ?>>  <?php echo $personne->getDepartement(); ?> </option> <?php }?>
  </select> <br>


      <input type="submit" name="Valider" value="Rechercher">
</form>
