<?php foreach ($article as $art):
    $this->_t = $art->getTitre(); ?>
    <div class="container">
        <div class="mt-5">
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
        </div>
        <h4 class="mt-5 text-center">Page de modification d'un article:</h4>
        <form method="post">
            <div class="row mt-5 mb-5">
                <div class="col-2 text-end">
                    <label for="inputTitre">Titre</label>
                </div>
                <div class="col-8">
                    <input id="inputTitre" type="text" value="<?= $art->getTitre() ?>" name="txtTitre"
                           class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-end">
                    <label for="inputContenu">Contenu (format html)</label>
                </div>
                <div class="col-8">
                    <textarea id="inputContenu" name="txtCotenu" class="form-control" rows="35" style="resize: none;">
                        <?= $art->getContenu() ?>
                    </textarea>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <input type="submit" name="submit" class="btn btn-outline-warning mt-5" value="Modifier l'article">
                </div>
            </div>
            <input type="hidden" name="action" value="formulaireModifArticle">
        </form>
    </div>

<?php endforeach; ?>
