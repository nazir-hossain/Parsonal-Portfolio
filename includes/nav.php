<header>
    <div class="logo">
        <a href="index.php">MD Nazir Hossain</a>
    </div>

    <nav>
        <ul class="nav-links">
            <li>
                <a href="index.php" class="<?php echo ($pageTitle === $lang_pack['page_title_home']) ? 'active' : ''; ?>">
                    <?php echo $lang_pack['nav_home']; ?>
                </a>
            </li>
            <li>
                <a href="about.php" class="<?php echo ($pageTitle === $lang_pack['page_title_about']) ? 'active' : ''; ?>">
                    <?php echo $lang_pack['nav_about']; ?>
                </a>
            </li>
            <li>
                <a href="projects.php" class="<?php echo ($pageTitle === $lang_pack['page_title_projects']) ? 'active' : ''; ?>">
                    <?php echo $lang_pack['nav_projects']; ?>
                </a>
            </li>
            <li>
                <a href="contact.php" class="<?php echo ($pageTitle === $lang_pack['page_title_contact']) ? 'active' : ''; ?>">
                    <?php echo $lang_pack['nav_contact']; ?>
                </a>
            </li>
        </ul>

        <div class="lang-switcher">
            <a href="?lang=en" class="<?php echo ($lang === 'en') ? 'active' : ''; ?>">EN</a>
            <span class="lang-separator">|</span>
            <a href="?lang=bn" class="<?php echo ($lang === 'bn') ? 'active' : ''; ?>">BN</a>
        </div>

        <button id="theme-toggle" title="Toggle theme">
            <svg class="sun-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="5"></circle>
                <line x1="12" y1="1" x2="12" y2="3"></line>
                <line x1="12" y1="21" x2="12" y2="23"></line>
                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                <line x1="1" y1="12" x2="3" y2="12"></line>
                <line x1="21" y1="12" x2="23" y2="12"></line>
                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
            </svg>
            <svg class="moon-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
        </button>

        <div class="hamburger">
            <div class="line line1"></div>
            <div class="line line2"></div>
            <div class="line line3"></div>
        </div>
    </nav>
</header>