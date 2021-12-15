<body>
<?php $this->_t = "Ecrire un article"; ?>
<div class="container">
    <form method="post">
        <h4 class="mt-5 text-center">Page de modification d'un article:</h4>
        <div class="row mt-5 mb-5">
            <div class="col-2 text-end">
                <label for="inputTitre">Titre</label>
            </div>
            <div class="col-8">
                <input id="inputTitre" type="text" name="txtTitre" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-2 text-end">
                <label for="inputContenu">Contenu (format html)</label>
            </div>
            <div class="col-8">
                    <textarea id="inputContenu" name="txtCotenu" class="form-control" rows="35" style="resize: none;"
                              required>
                    </textarea>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-auto">
                <input type="submit" name="submit" class="btn btn-outline-success mt-5" value="Publier l'article">
            </div>
        </div>
        <input type="hidden" name="action" value="formulaireAddArticle">
    </form>
</div>
</body>