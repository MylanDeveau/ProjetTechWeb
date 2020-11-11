<?php
$pdo = new Mypdo();
$managerSport = new SportManager($pdo);
$managerPersonne = new PersonneManager($pdo);
$managerPratique = new PratiqueManager($pdo);

$listeSport = $managerSport->getAllSport();
$listePersonne = $managerPersonne->getAllPersonne();
$listeNiveau = $managerPratique->getNiveauExistants();

$utilisateur = $managerPersonne->getPersonne($_COOKIE['connect']);
$sportUtilisateur = $managerSport->getFirstSport($_COOKIE['connect']);
$niveautilisateur = $managerPratique->getNiveau($utilisateur->getIdPersonne(), $sportUtilisateur->getIdSport()); ?>

<p>Rechercher des partenaires</p>

<?php
if (empty($_POST['id_sport'])) {
    ?>
<form method ="post" action ="#">
  Sport : <select size="1" name="id_sport">
  <option value=<?php echo $sportUtilisateur->getIdSport(); ?>> <?php echo $sportUtilisateur->getNom(); ?></option><?php
  foreach ($listeSport as $sport) {  ?>
      <option value= <?php echo $sport->getIdSport(); ?>>  <?php echo $sport->getNom(); ?> </option> <?php }?>
  </select> <br>

  Niveau : <select size="1" name="niveau">
  <option value=<?php echo $niveautilisateur->getNiveau(); ?> > <?php echo $niveautilisateur->getNiveau(); ?></option><?php
  foreach ($listeNiveau as $niveau) {  ?>
      <option value= <?php echo $niveau->getNiveau(); ?>>  <?php echo $niveau->getNiveau(); ?> </option> <?php }?>
  </select> <br>

  Département : <select size="1" name="depart">
  <option value=<?php echo $utilisateur->getDepartement(); ?> > <?php echo $utilisateur->getDepartement(); ?></option><?php
  foreach ($listePersonne as $personne) {  ?>
      <option value= <?php echo $personne->getDepartement(); ?>>  <?php echo $personne->getDepartement(); ?> </option> <?php }?>
  </select> <br>
  <input type="submit" name="Valider" value="Rechercher">
</form>
<?php } else {

    $id_sport=$_POST['id_sport'];
    $niveau=$_POST['niveau'];
    $depart=$_POST['depart'];
    $listeRecherche = $managerPersonne->getRecherche($id_sport, $niveau, $depart);?>
    <?php
        if(!empty($listeRecherche)){ ?>
      	<table>
         <tr>
           <th>Nom</th>
           <th>Prenom</th>
        </tr>
        <?php
      foreach ($listeRecherche as $personne) {
          ?>
          <tr>
            <td> <?php echo $personne->getNom(); ?> </td>
            <td> <?php echo $personne->getPrenom(); ?> </td>
          </tr>
        <?php }
      ?>
        </table>
      <?php }else {
        echo " Aucuns resultats corespondants aux critères de recherche";
      }
  }
?>
