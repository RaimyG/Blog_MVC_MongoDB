<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap core CSS -->
    <link href="/blog/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="/blog/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="/blog/css/clean-blog.css" rel="stylesheet">

    <!-- CSS Summernote -->
    <link href="/blog/vendor/summernote/summernote-bs4.css" rel="stylesheet" type="text/css">


    <title><?php echo $this->_route["params"]["title"] ?> - Mon ptit blog</title>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="/blog">Mon ptit blog</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/blog"><i class="fas fa-home"></i> Accueil</a>
                    </li>
                    <?php if (isset($_SESSION['_id'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/blog/article/ecrire"><i class="fas fa-feather-alt"></i> Rédiger un article</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/blog/user/deconnexion"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/blog/user/connexion"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('/blog/img/home-bg.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Mon p'tit blog</h1>
                        <span class="subheading">Le p'tit endroit où chacun raconte sa p'tite vie.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container">