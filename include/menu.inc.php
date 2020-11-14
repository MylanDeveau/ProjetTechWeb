<nav >
    <ul>
        <li><p><a href="index.php?page=0">Accueil</a></p></li>
        <li><p><a href="index.php?page=1">Inscription</a></p></li>
        <?php if (!empty($_COOKIE['connect'])){?>
        <li><p><a href="index.php?page=2">Recherche</a></p></li>
        <?php }?>
    </ul>
</nav>
