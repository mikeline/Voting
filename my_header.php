<nav class="navbar navbar-expand-lg navbar-light bg-light" style="width: 100%;">
    <a class="navbar-brand" href="default.php">Voting</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item<?php echo $basename == 'default.php' ? ' active' : '' ?>">
                <a class="nav-link" href="default.php">Home<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item<?php echo $basename == 'list.php' ? ' active' : '' ?>">
                <a class="nav-link" href="list.php">Questions<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item<?php echo $basename == 'contact.php' ? ' active' : '' ?>">
                <a class="nav-link" href="contact.php">Contact<span class="sr-only">(current)</span></a>
            </li>
            <?php
            if ($login != 'guest')
            {
              ?>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Log out</a>
            </li>
            <?php } else {?>
            <li class="nav-item<?php echo $basename == 'login.html' ? ' active' : '' ?>">
                <a class="nav-link" href="login.html">Log in<span class="sr-only">(current)</span></a>
            </li>
            <?php } ?>
            <li class="nav-item">
                <a href="account_panel.php" class="nav-link" id="nav-username"><?php
                    if (isset($login))
                    {
                        echo $login != 'guest'?$login:'';
                    }
                    ?></a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="get" action="search.php">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

