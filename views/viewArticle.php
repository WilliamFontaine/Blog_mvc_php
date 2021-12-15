<body>
<?php foreach ($article as $art): ?>
    <div class="container mt-5">
        <h2>Article : <?= $art->getTitre() ?> </h2>
        <p><?= $art->getContenu() ?></p>
        <p class="mt-5" style="font-size: 18px">Ecrit par '<?= $art->getPseudoAuteur() ?>' le
            <time> <?= $art->getDate() ?>.</time>
        </p>
        <div>
            <div class="row justify-content-center">
                <?php if (isset($_SESSION['userId']) and (Nettoyage::CleanChaineCarar($_SESSION['userId']) == $art->getIdAuteur())): ?>
                    <div class="col-auto">
                        <a href="?url=modifierArticle&id=<?= $art->getId() ?>" class="btn btn-outline-info mt-5">Modifier
                            l'article</a>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['userId']) and (isset($_SESSION['type'])) and (Nettoyage::CleanChaineCarar($_SESSION['userId']) == $art->getIdAuteur() or Nettoyage::CleanChaineCarar($_SESSION['type']) == "admin" or Nettoyage::CleanChaineCarar($_SESSION['type']) == "super-admin")): ?>
                    <div class="col-auto">
                        <a href="?url=deleteArticle&id=<?= $art->getId() ?>" class="btn btn-outline-danger mt-5">Supprimer
                            l'article</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php $this->_t = "Article: " . $art->getTitre(); ?>
        <hr>
    </div>
<?php endforeach; ?>

<div class="container">
    <br>
    <h3 class="mb-5">Laissez un commentaire :</h3>
    <form method="post">
        <div class="container">
            <div class="row mb-5">
                <div class="col-2 text-end">
                    <label for="inputPseudo" class="col-form-label">Pseudo</label>
                </div>
                <div class="col-5">
                    <input id="inputPseudo" type="text" placeholder="Pseudo" name="txtNom" class="form-control   "
                           style="width: 25rem"
                           value="<?php if (isset($_SESSION['username'])) echo Nettoyage::CleanChaineCarar($_SESSION['username']); ?>"
                        <?php if (isset($_SESSION['username'])) echo "readonly aria-describedby=\"connectedInfo\"" ?>
                           required>
                </div>
                <div class="col-5">
                    <?php if (isset($_SESSION['username'])) echo "<span id=\"connectedInfo\" class=\"form-text\">Vous êtes connecté, vous n'avez pas besoin de renseigner votre pseudo.</span>" ?>
                </div>
            </div>
            <div class="row align-items-center mb-5">
                <div class="col-2 text-end">
                    <label for="inputComm" class="col-form-label">Commentaire</label>
                </div>
                <div class="col-8">
                    <textarea id="inputComm" placeholder="Commentaire" name="txtComm" class="form-control"
                              rows="6" style="resize: none;" required></textarea>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-auto">
                <input type="submit" name="submit" class="btn btn-outline-info mt-5" value="Commenter">
            </div>
        </div>
        <input type="hidden" name="action" value="formulaireCommentaire">
    </form>
    <hr>
</div>

<div class="container">
    <?php $comments = (new GatewayComment())->getComment($_GET['id']);
    if (!empty($comments)): ?>
        <br>
        <h3 class="mb-5">Commentaires :</h3>
        <?php foreach ($comments as $comm): ?>
            <div class="container">
                <p class="mb-4" style="font-size: 18px">(<em><?= $comm->getTypeAuteur() ?></em>)
                    <i><?= $comm->getPseudoAuteur() ?></i>,
                    le <?= $comm->getDate() ?>.</p>
                <p style="font-size: 18px">Commentaire: <?= $comm->getComment() ?></p>
            </div>
            <?php if (isset($_SESSION['username']) and isset($_SESSION['type']) and (Nettoyage::CleanChaineCarar($_SESSION['type']) == "admin" or Nettoyage::CleanChaineCarar($_SESSION['type']) == "super-admin" or Nettoyage::CleanChaineCarar($_SESSION['username']) == $comm->getPseudoAuteur())): ?>
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <a href="?url=deleteComment&id=<?= $comm->getId() ?>" class="btn btn-outline-danger mt-5">Supprimer
                            le commentaire</a>
                    </div>
                </div>
            <?php endif; ?>
            <hr>
        <?php endforeach;
    endif; ?>
</div>
</body>