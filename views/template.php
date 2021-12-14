<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <title><?= $t ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php global $dir, $style; echo $dir . $style['erreur'] ?>">
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="?url=accueil&page=1">MyBlog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="
                        <?php
                        if (isset($_SESSION['username'])) {
                            echo "?url=pageUser";
                        } else {
                            echo "?url=connexionUser";
                        } ?>
                        "><?php
                            if (isset($_SESSION['username'])) {
                                echo $_SESSION['username'];
                            } else {
                                echo "Connexion";
                            } ?></a>
                    </li>
                    <?php if (isset($_SESSION['type']) and (Nettoyage::CleanChaineCarar($_SESSION['type']) == "admin" or Nettoyage::CleanChaineCarar($_SESSION['type']) == "super-admin")): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="?url=pageAdmin">administration</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <?php if (isset($_SESSION['username']) and ($_SESSION['type'] == "admin" or $_SESSION['type'] == "ecrivain" or $_SESSION['type'] == "super-admin")): ?>
                    <a type="submit" class="btn btn-outline-light me-5 m-2" href="index.php?url=addArticle">Ecrire un
                        article</a>
                <?php endif; ?>
                <?php if (isset($_SESSION['username'])): ?>
                    <a type="submit" class="btn btn-outline-light me-5 m-2"
                       href="index.php?url=deconnexion">Deconnexion</a>
                <?php endif; ?>
                <form class="d-flex" method="post">
                    <input class="form-control me-2" name="txtTitre" type="text" placeholder="Votre recherche" aria-label="Votre recherche">
                    <input type="submit" name="submit" class="btn btn-outline-info" value="rechercher">
                    <input type="hidden" name="action" value="formulaireRechercheArticle">
                </form>
            </div>
        </div>
    </nav>
</header>

<?= $content ?>

<footer>
    <div class="ms-5 mt-5">
        <p>Nombre de commentaires total sur le site:
            <?php $comments = (Commentaire::getNbComm());
            echo $comments[0]['COUNT(*)']; ?>.
            <?php if (isset($_SESSION['type']) and isset($_SESSION['username'])): ?>
                Dont
                <?php $comments = (Commentaire::getNbComm(Nettoyage::CleanChaineCarar($_SESSION['type']), Nettoyage::CleanChaineCarar($_SESSION['username'])));
                echo $comments[0]['COUNT(*)']; ?>
                que vous avez ecrit.
            <?php endif; ?>
        </p>
        <p>Créé par William Fontaine.</p>
    </div>
</footer>
</html>