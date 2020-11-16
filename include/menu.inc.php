<nav >
    <ul>
        <li><p class="textNav"><a href="index.php?page=0">Acceuil</a></p></li>
        <li><p class="textNav"><a href="index.php?page=1">Inscription</a></p></li>
        <?php if (!empty($_COOKIE['connect'])){?>
        <li><p class="textNav"><a href="index.php?page=2">Recherche</a></p></li>
        <?php }?>
    </ul>
</nav>
