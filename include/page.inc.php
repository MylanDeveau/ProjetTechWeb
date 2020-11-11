<article>
    <?php
    if (!empty($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 0;
    }
    if (empty($_COOKIE['connect']))
        switch ($page) {
            case 1:
                include_once('pages/ajout.inc.php');
                break;

            default :
                include_once('pages/accueil.inc.php');
                break;
        }
    else
        switch ($page) {
            case 1:
                include_once('pages/ajout.inc.php');
                break;

            case 2:
                include_once('pages/recherche.inc.php');
                break;
            default :
                include_once('pages/accueil.inc.php');
                break;
        }
    ?>
</article>
