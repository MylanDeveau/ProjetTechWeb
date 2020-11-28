<?php
$pdo = new Mypdo();
$managerSport = new SportManager($pdo);
$managerPersonne = new PersonneManager($pdo);
$managerPratique = new PratiqueManager($pdo);

$listeSport = $managerSport->getAllSport();
$listePersonne = $managerPersonne->getAllPersonne();
$listeNiveau = $managerPratique->getNiveauExistants();
$listeDepartement = $managerPersonne->getDepartement();

$utilisateur = $managerPersonne->getPersonne($_COOKIE['connect']);
$sportUtilisateur = $managerSport->getFirstSport($_COOKIE['connect']);
$niveautilisateur = $managerPratique->getNiveau($utilisateur->getIdPersonne(), $sportUtilisateur->getIdSport()); ?>

<h2>Rechercher des partenaires</h2>

<?php
if (empty($_POST['id_sport'])) {
    ?>
    <form method="post" action="#" id="formRecherche">
        <div id="formRechercheLabels">

            <label for="sport">Sport : </label> <select size="1" name="id_sport">
                <option value=<?php echo $sportUtilisateur->getIdSport(); ?>> <?php echo $sportUtilisateur->getNom(); ?></option><?php
                foreach ($listeSport as $sport) { ?>
                    <option value= <?php echo $sport->getIdSport(); ?>>  <?php echo $sport->getNom(); ?> </option> <?php } ?>
            </select> <br>

            <label for="niveau">Niveau : </label> <select size="1" name="niveau">
                <option value=<?php echo $niveautilisateur->getNiveau(); ?>> <?php echo $niveautilisateur->getNiveau(); ?></option><?php
                foreach ($listeNiveau as $niveau) { ?>
                    <option value= <?php echo $niveau->getNiveau(); ?>>  <?php echo $niveau->getNiveau(); ?> </option> <?php } ?>
            </select> <br>

            <label for="departement">Département : </label> <select size="1" name="depart">
                <option value=<?php echo $utilisateur->getDepartement(); ?>> <?php echo $utilisateur->getDepartement(); ?></option><?php
                foreach ($listeDepartement as $departement) { ?>
                    <option value= <?php echo $departement->getDepartement(); ?>>  <?php echo $departement->getDepartement(); ?> </option> <?php } ?>
            </select> <br>
        </div>
        <input type="submit" name="Valider" value="Rechercher">
    </form>
<?php } else {

    $id_sport = $_POST['id_sport'];
    $niveau = $_POST['niveau'];
    $depart = $_POST['depart'];
    $listeRecherche = $managerPersonne->getRecherche($id_sport, $niveau, $depart); ?>
    <?php
    if (!empty($listeRecherche)) { ?>
        <table id="hoverTable">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Département</th>
            </tr>
            </thead>
            <tbody>
            <?php

            foreach ($listeRecherche as $personne) {
                ?>
                <tr>
                    <td> <?php echo $personne->getNom(); ?> </td>
                    <td> <?php echo $personne->getPrenom(); ?> </td>
                    <td> <?php echo $personne->getDepartement(); ?></td>
                </tr>
            <?php }
            ?>
            </tbody>
        </table>
    <?php } else {
        echo " Aucuns resultats corespondants aux critères de recherche";
    }
}
?>
