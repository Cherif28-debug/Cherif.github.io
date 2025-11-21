<nav>
    <ul>
        <li>
            <a href="index.php" class="<?= basename($_SERVER['PHP_SELF'])=='index.php' ? 'current_page' : '' ?>">
                <img src="images/ballon.jpg" alt="Mon site" style="height:40px;">
            </a>
        </li>
        <li>
            <a href="login.php" class="<?= basename($_SERVER['PHP_SELF'])=='login.php' ? 'current_page' : '' ?>">Mes tâches</a>
        </li>
        <li>
            <a href="my_form.php" class="<?= basename($_SERVER['PHP_SELF'])=='my_form.php' ? 'current_page' : '' ?>">Quiz</a>
        </li>
        <li>
            <a href="#" id="discover-link">Découvrez-moi !</a>
            <ul class="dropdown" id="discover-dropdown">
                <li><a href="my_artistic_self.php">Mon moi artistique</a></li>
                <li><a href="my_vacations.php">Mes vacances de rêve</a></li>
                <li><a href="blog.php"> Blog </a></li>

            </ul>
        </li>
    </ul>
</nav>

<script>
const discoverLink = document.getElementById('discover-link');
const discoverDropdown = document.getElementById('discover-dropdown');
discoverDropdown.style.display = 'none';

discoverLink.addEventListener('click', e => {
    e.preventDefault();
    discoverDropdown.style.display = (discoverDropdown.style.display === 'block') ? 'none' : 'block';
});

document.addEventListener('click', e => {
    if(!e.target.closest('#discover-link') && !e.target.closest('#discover-dropdown')) {
        discoverDropdown.style.display = 'none';
    }
});
</script>
