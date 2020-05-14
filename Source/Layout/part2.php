</head>

<body>
    <header class="top">
        <div class="logo"></div>
        <nav class="navbar">
            <ul class="navbar-menu">

                <div class="navlogo" onclick="openSubMenu()">
                    <div>
                        <div class="navlogo-0">
                            <div class="navlogo-1"></div>
                            <div class="navlogo-2"></div>
                            <div class="navlogo-3"></div>
                        </div>
                        <span class="navlogo-menu">MENU</span>
                    </div>
                </div>
                <a href="Index.php" class="menu" onmouseout="closeMenu()">
                    <li>News</li>
                </a>
                <a href="Pages.php?category=0&num=1" class="menu" onmouseout="closeMenu()">
                    <li>Latest</li>
                </a>
                <a href="#" class="menu" onmouseout="closeMenu()">
                    <li>About Us</li>
                </a>
                <a href="#" class="menu" onmouseout="closeMenu()">
                    <li>Contact Us</li>
                </a>
                <a href="#" class="menu" onmouseout="closeMenu()">
                    <li>Work With Us</li>
                </a>
                <a href="#" class="menu" onmouseout="closeMenu()">
                    <li>Store</li>
                </a>
                <a href="#" class="menu" onmouseout="closeMenu()">
                    <li>Forum</li>
                </a>
                <a href="Login.php" class="menu" onmouseout="closeMenu()">
                    <li>Login</li>
                </a>
                <a href="Register.php" class="menu register" onmouseout="closeMenu()">
                    <li>Register</li>
                </a>
            </ul>
        </nav>
        <nav class="sub-navbar">
            <ul class="sub-navbar-menu">
                <a href="Pages.php?category=1&num=1">
                    <li class="menu" onmouseover="openOneNav()">Economy</li>
                </a>
                <a href="Pages.php?category=2&num=1">
                    <li class="menu" onmouseover="closeOneNav()">Tech</li>
                </a>
                <a href="Pages.php?category=3&num=1">
                    <li class="menu" onmouseover="closeOneNav()">Sport</li>
                </a>
                <a href="Pages.php?category=4&num=1">
                    <li class="menu" onmouseover="closeOneNav()">Entertainment</li>
                </a>
                <a href="Pages.php?category=5&num=1">
                    <li class="menu" onmouseover="closeOneNav()">Culture</li>
                </a>
            </ul>
        </nav>
        <nav class="one-navbar">
            <ul class="one-navbar-menu">
                <a href="Pages.php?subcategory=1&num=1">
                    <li class="one-menu" onmouseover="closeOneSubNav()">World</li>
                </a>
                <a href="Pages.php?subcategory=2&num=1" onmouseover="openOneSubNav()">
                    <li class="one-menu">South America</li>
                </a>
            </ul>
        </nav>
        <nav class="one-sub-navbar">
            <ul class="one-sub-navbar-menu" onmouseout="closeOneSubNav()">
                <a href="Pages.php?subsubcategory=1&num=1">
                    <li class="one-menu">Brazil</li>
                </a>
            </ul>
        </nav>
    </header>