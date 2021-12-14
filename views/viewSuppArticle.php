<?php foreach ($article as $art):
    $this->_t = $art->getTitre(); ?>
    <div class="container">
        <h4 class="mt-5 text-center">Page de modification d'un article:</h4>
        <div class="row mt-5 mb-5">
            <div class="col-2 text-end">
                <label for="inputTitre">Titre</label>
            </div>
            <div class="col-8">
                <input id="inputTitre" type="text" value="<?= $art->getTitre() ?>" name="txtTitre"
                       class="form-control" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-2 text-end">
                <label for="inputContenu">Contenu (format html)</label>
            </div>
            <div class="col-8">
                    <textarea id="inputContenu" name="txtCotenu" class="form-control" rows="35" style="resize: none;"
                              readonly>
                        <?= $art->getContenu() ?>
                    </textarea>
            </div>
        </div>
        <form method="post">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <input type="submit" name="submit" class="btn btn-outline-danger mt-5" value="Supprimer l'article">
                </div>
            </div>
            <input type="hidden" name="action" value="formulaireSuppArticle">
        </form>
    </div>
<?php endforeach; ?>