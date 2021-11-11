<link rel="stylesheet" href="./static/styles/navbar.css">
<div class="navbar" id="nav-bar">
    <div class="container-box">
        <a class="logo" href="/">Dora<span>Yummy</span></a>
        <img id="mobile-menu" class="mobile-menu-icon" src="static/images/menu-icon.svg" alt="Open Navbar">
        <nav>
            <img id="mobile-close" class="mobile-close-icon" src="static/images/close-icon.svg" alt="Close Navbar">
            <ul class="left-navbar">
                <form id="form-search-dorayaki" action="search.php" enctype="multipart/form-data" >
                    <div class="navbar-search" >
                        <input type="text" class="navbar-search-box" id="dorayaki-name" name="dorayaki-name" aria-describedby="dorayaki-name" placeholder="Cari Dorayaki" required>
                        <button role="button" type="submit" class="navbar-search-icon"><i class="fas fa-2x fa-search"></i></button>
                    </div>
                </form>
            </ul>
            <ul id="right-navbar" class="right-navbar">
                <li ><a href="/">Dashboard</a></li>
                <li ><a id="functional-menu" href="variant-add.php">Add Dorayaki</a></li>
                <li class="functional-icon"><a  id="functional-icon" href="variant-add.php"><img  id="functional-icon-image" src="static/images/post-add.svg" alt="logo" class="add"></a></li>
                <li class="account">
                    <div class="account-logo-outline">
                        <img src="static/images/person.svg" alt="logo" class="account-logo">
                    </div>
                    <p id="username"></p>
                </li>
                <li class="nav-button">
                    <form action="./api/auth/logout.php" method="post">
                        <input type="submit" class="logout-button" name="logout" value="Logout"/>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</div>
<script src="/static/scripts/navbar.js"></script>
<script src="https://kit.fontawesome.com/7daea7707d.js" crossorigin="anonymous"></script>

