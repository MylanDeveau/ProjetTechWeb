<?php
$pdo = new Mypdo();
$SM = new SportManager($pdo);
$sports = $SM->getAllSport();
$PratiqueManager = new PratiqueManager($pdo);
$PersonneManager = new PersonneManager($pdo);
$niveaux = $PratiqueManager->getNiveauExistants();
$erreurNouv = false;
$ajout = false;

if (!empty($_POST['valider'])) {
    if ($_POST['valider'] == 'Ajouter') {
        if (empty($_POST['nouveauSport'])) {
            $erreurNouv = true;
        } else {
            $ajout = true;
            if ($SM->add(new Sport(array("nom" => $_POST['nouveauSport']))) == 1) {
                ?> <p>Le sport a bien été ajouté<br>Redirection automatique dans 2 secondes</p> <?php
                header("refresh:2;url=index.php?page=1.php");
            } else {
                ?> <p>Une erreur est survenue, le sport n'a pas été ajouté<br>Redirection automatique dans 2 secondes
                </p> <?php
                header("refresh:2;url=index.php?page=1.php");
            }

        }
    } else {
        $ajout = true;
        if (!empty($_COOKIE['connect'])) {
            $personne = $PersonneManager->getPersonneMail($_POST['mail']);
            $pratique = new Pratique(array(
                "id_personne" => $personne->getIdPersonne(), "id_sport" => $_POST['sportPratique'], "niveau" => $_POST['niveau']
            ));
            if ($PratiqueManager->add($pratique) == 1) {
                ?> <p>Vous etes maintenant inscrit pour un nouveau sport !<br>Redirection automatique dans 2 secondes</p> <?php
                header("refresh:2;url=index.php?page=1.php");
            } else{
                ?> <p>Une erreur est survenue, l'inscription n'a pas été effectué<br>Redirection automatique dans 2 secondes
                </p> <?php
                header("refresh:2;url=index.php?page=1.php");
            }
        } else {
            $personne = new Personne(array(
                'nom' => $_POST['nom'], 'prenom' => $_POST["prenom"], 'depart' => $_POST['departement'], 'mail' => $_POST['mail']
            ));
            if ($PersonneManager->add($personne) == 1) {
                $personne = $PersonneManager->getPersonneMail($_POST['mail']);
                $pratique = new Pratique(array(
                    "id_personne" => $personne->getIdPersonne(), "id_sport" => $_POST['sportPratique'], "niveau" => $_POST['niveau']
                ));
                if ($PratiqueManager->add($pratique) == 1) {
                    ?> <p>Vous etes maintenant inscrit, retournez sur la page d'accueil pour vous connecter</p> <?php
                }
            }else{
                ?> <p>Une erreur est survenue, l'inscription n'a pas été effectué<br>Redirection automatique dans 2 secondes
                </p> <?php
                header("refresh:2;url=index.php?page=1.php");
            }
        }
    }
}
if (!$ajout) {
    ?>
    <form action="index.php?page=1" method="post">
        <?php if (empty($_COOKIE['connect'])) { ?>
            <h2>Inscription</h2>
            <label for="nom">Nom : </label><input type="text" name="nom" id="nom" required><br>
            <label for="prenom">Prénom : </label><input type="text" name="prenom" id="prenom" required><br>
            <label for="departement">Département : </label><input type="number" name="departement" id="departement"
                                                                required><br>
            <label for="mail">Mail : </label><input type="mail" name="mail" id="mail" required><br>
        <?php }else { ?> <h2>Ajouter un nouveau sport pratiqué</h2> <?php } ?>

        <label for="sportPratique">Sport Pratiqué : </label><select name="sportPratique" id="sportPratique">
            <?php foreach ($sports as $sport) {
                ?>
                <option value="<?php echo $sport->getIdSport(); ?>"><?php echo $sport->getNom(); ?></option> <?php
            } ?></select>
        <label for="nouveauSport">Ajouter un sport a la liste </label>
        <input type="text" name="nouveauSport" id="nouveauSport">
        <input type="submit" name="valider" value="Ajouter">
        <?php if ($erreurNouv) echo "<p>vous devez entrer un nom pour le sport</p>"; ?>
        <br>
        <label for="niveau">Niveau : </label><select name="niveau" id="niveau">
            <?php foreach ($niveaux as $niveau) {
                ?>
                <option value="<?php echo $niveau->getNiveau(); ?>"><?php echo $niveau->getNiveau(); ?></option> <?php
            } ?></select>
        <br>
        <div id="btnInscription">
          <input type="submit" value="Envoyer" name="valider"><br>
          <input type="reset" value="Effacer">
        </div>
    </form>
<?php } ?>
