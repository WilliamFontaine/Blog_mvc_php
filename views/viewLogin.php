<?php $this->_t = "Connexion"; ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="<?php global $dir, $style;
    echo $dir . $style['login'] ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <!--<script src="script.js"></script>-->
</head>
<body>
<div class="container rounded">

    <div class="box rounded text-center">
        <h1 class="box-title">Page de connexion <?php
            switch (Nettoyage::CleanChaineCarar($_GET['url'])){
                case "connexionUser":
                    echo "utilisateur";
                    break;
                case "connexionEcrivain":
                    echo "écrivain";
                    break;
                case "connexionAdmin":
                    echo "administrateur";
            }
        ?></h1>
        <form  method="post">
            <label for="nom"></label>
            <input id="nom" type="text" placeholder="Pseudo" name="txtNom" class="box-input form-control" required/>
            <label for="password"></label>
            <input id="password" type="password" placeholder="Mot de passe" name="txtMdp" class="box-input form-control" required/>
            <input type="reset" class="box-button" value="Effacer"/>
            <input type="submit" name="submit" class="box-button" value="Connexion"/>
            <p class="box-register">Vous êtes nouveau ici? <a href="?url=register">S'inscrire</a></p>
            <p class="box-register"><a href="?url=accueil">Retour à l'accueil</a></p>
            <input type="hidden" name="action" value="validationFormulaireConnexionPseudo">
            <?php if (isset($dVueErreur)): ?>
                <?php foreach ((array)$dVueErreur as $erreur): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $erreur ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (isset($dVueSuccess)): ?>
                <?php foreach ((array)$dVueSuccess as $success): ?>
                    <div class="alert alert-success" role="alert">
                        <?= $success ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </form>
    </div>
    <div class="text-center">
        <a href="?url=connexionUser" class="m-2">se connecter en tant qu'utilisateur</a>
        <a href="?url=connexionEcrivain" class="m-2">se connecter en tant qu'écrivain</a>
        <a href="?url=connexionAdmin" class="m-2">se connecter en tant qu'administrateur</a>
    </div>
</div>
</body>
</html>
