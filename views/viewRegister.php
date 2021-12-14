<?php $this->_t = "Incsription"; ?>
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
    <form class="box rounded" method="post">
        <h1 class="box-title">Page d'inscription</h1>
        <input type="text" placeholder="Pseudo" name="txtNom" class="box-input form-control" required/>
        <input type="text" placeholder="Email" name="txtEmail" class="box-input form-control" required/>
        <input type="password" placeholder="Mot de passe" name="txtMdp" class="box-input form-control" required/>
        <input type="password" placeholder="Confirmez le mot de passe" name="txtMdpConfirm"
               class="box-input form-control" required/>
        <input type="reset" class="box-button" value="Effacer"/>
        <input type="submit" name="submit" class="box-button" value="Valider"/>
        <p class="box-register"><a href="?url=login">Se connecter</a></p>
        <p class="box-register"><a href="?url=accueil">Retour à l'accueil</a></p>
        <input type="hidden" name="action" value="formulaireInscription">
        <?php if (isset($dVueErreur)): ?>
            <?php foreach ((array)$dVueErreur as $erreur): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $erreur ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </form>
</div>
</body>
</html>
