<p>ACCUEIL</p>
<?php
$pdo = new Mypdo();
$SM = new SportManager($pdo);
$sports = $SM->getAllSport();
$PM = new PersonneManager($pdo);
?>

<p>Liste des sports disponibles : </p>
<ul>
    <?php foreach ($sports as $sport) { ?>
        <li><?php echo $sport->getNom(); ?></li>
    <?php } ?>
</ul>

<?php if (empty($_COOKIE['connect'])) {
    if (empty($_POST['mail'])) { ?>
        <form action="index.php?page=0" method="post">
            <label for="mail">Mail:</label><input id="mail" type="email" name="mail">
            <input type="submit" value="Valider">
        </form><?php
    } else {
        $personne = $PM->getPersonneMail($_POST['mail']);
        if (empty($personne->getIdPersonne())) { ?>
            <p>Vous n'apparaissez pas dans la base , inscrivez vous avec le lien ci dessous</p>
            <button onclick="window.location.href='/index.php?page=1'">S'inscrire</button>
        <?php } else {
            setcookie('connect',$personne->getIdPersonne(), array("httponly"=>false,"expires"=>time()+360*34*30));
            header("refresh:0;url=index.php");
            ?>
            <p>Bienvenue <?php echo $personne->getPrenom()." ".$personne->getNom(); ?></p>
            <button onclick="window.location.href='/index.php?page=1'">S'inscrire pour un nouveau sport</button>
            <button onclick="window.location.href='/index.php?page=1'">Faire une recherche</button>
            <button onclick="document.cookie = 'connect=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';document.location.reload(true);">Se Deconnecter</button>
        <?php }
    }
} else {
    $personne = $PM->getPersonne($_COOKIE['connect']);
    ?>
    <p>Bienvenue <?php echo $personne->getPrenom()." ".$personne->getNom(); ?></p>
    <button onclick="window.location.href='/index.php?page=1'">S'inscrire pour un nouveau sport</button>
    <button onclick="window.location.href='/index.php?page=2'">Faire une recherche</button>
    <button onclick="document.cookie = 'connect=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';document.location.reload(true);">Se Deconnecter</button>
    <?php
}
?>
