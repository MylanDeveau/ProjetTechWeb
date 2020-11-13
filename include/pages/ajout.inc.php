<?php
$pdo = new Mypdo();
$SM = new SportManager($pdo);
$sports = $SM->getAllSport();
$PratiqueManager = new PratiqueManager($pdo);
$PersonneManager = new PersonneManager($pdo);
$niveaux = $PratiqueManager->getNiveauExistants();
$erreurNouv = false;

if (!empty($_POST['valider'])){
    if ($_POST['valider'] == 'Ajouter'){
        if (empty($_POST['nouveauSport'])){
            $erreurNouv = true;
        } else{
            $SM->add(new Sport(array("nom"=>$_POST['nouveauSport'])));
            ?> <p>Le sport a bien été ajouté</p> <?php
        }
    } else{
        $personne = new Personne(array(
                'nom'=>$_POST['nom'], 'prenom'=>$_POST["prenom"],'depart'=>$_POST['departement'],'mail'=>$_POST['mail']
        ));
        $PersonneManager->add($personne);
        $personne = $PersonneManager->getPersonneMail($_POST['mail']);
        $pratique = new Pratique(array(
                "id_personne"=>$personne->getIdPersonne(),"id_sport"=>$_POST['sportPratique'],"niveau"=>$_POST['niveau']
        ));
        $PratiqueManager->add($pratique);
?> <p>Vous etes maintenant inscrit, retournez sur la page d'accueil pour vous connecter</p> <?php

    }
}
?>
<form action="index.php?page=1" method="post">
    <label for="nom">Nom:</label><input type="text" name="nom" id="nom" required><br>
    <label for="prenom">Prénom:</label><input type="text" name="prenom" id="prenom" required><br>
    <label for="departement">Département:</label><input type="text" name="departement" id="departement" required><br>
    <label for="mail">Mail:</label><input type="mail" name="mail" id="mail" required><br>
    <label for="sportPratique">Sport Pratiqué:</label><select name="sportPratique" id="sportPratique">
        <?php foreach ($sports as $sport) {
            ?>
            <option value="<?php echo $sport->getIdSport(); ?>"><?php echo $sport->getNom(); ?></option> <?php
        } ?></select>
    <label for="nouveauSport">Ajouter un sport a la liste</label><input type="text" name="nouveauSport"
                                                                        id="nouveauSport"><input type="submit" name="valider"
                                                                                                 value="Ajouter">
    <?php if ($erreurNouv) echo "<p>vous devez entrer un nom pour le sport</p>"; ?>
    <br>
    <label for="niveau">Niveau:</label><select name="niveau" id="niveau">
        <?php foreach ($niveaux as $niveau) {
            ?>
            <option value="<?php echo $niveau->getNiveau(); ?>"><?php echo $niveau->getNiveau(); ?></option> <?php
        } ?></select>
    <br>
    <input type="submit" value="Envoyer" name="valider"><input type="reset" value="Effacer">
</form>