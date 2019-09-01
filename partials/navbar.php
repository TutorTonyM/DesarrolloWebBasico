<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <a class="navbar-brand" href="index.php">XvloX</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <div class="navbar-nav ml-auto">

        <a class=" nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>        

        <?php
        if(isset($_SESSION['user'])){
            echo '
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        '.$_SESSION['user'].'
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="my-posts">My Posts</a>
                        <a class="dropdown-item" href="new-post.php">New Post</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="resources/logout.php">Logout</a>
                    </div>
                </div>
            ';                       
        }
        else{
            echo '
                <a class="nav-item nav-link" href="register.php">Register</a>
                <a class="nav-item nav-link" href="login.php">Login</a>
            ';
        }
        ?>

    </div>

    <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

    </div>

</nav>