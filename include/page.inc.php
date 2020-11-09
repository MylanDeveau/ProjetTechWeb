<article>
    <?php
    if (!empty($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 0;
    }
    switch ($page) {

        case 0:
            // inclure ici la page accueil photo
            include_once('pages/accueil.inc.php');
            break;
        case 2:
            include_once('pages/recherche.php');
            break;

        default :
            include_once('pages/accueil.inc.php');
    }

    ?>
</article>
