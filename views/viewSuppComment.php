<body>
<?php $this->_t = "Suppression de commentaire";
foreach ($comm as $com): ?>
    <div class="container">
        <h3 class="text-center mt-5">Suppression d'un commentaire</h3>
        <div class="row align-items-center mt-5">
            <div class="col-3 text-end">
                <p>Commentaire</p>
            </div>
            <div class="col-7">
                <p class="form-control"><?= $com->getComment() ?></p>
            </div>
        </div>
        <div class="row align-items-center mt-5">
            <div class="col-3 text-end">
                <p>Auteur</p>
            </div>
            <div class="col-7">
                <p class="form-control"><?= $com->getPseudoAuteur() ?></p>
            </div>
        </div>
        <div class="row align-items-center mt-5">
            <div class="col-3 text-end">
                <p>Date</p>
            </div>
            <div class="col-7">
                <p class="form-control"><?= $com->getDate() ?></p>
            </div>
        </div>
        <form method="post">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <input type="submit" name="submit" class="btn btn-outline-danger mt-5"
                           value="Supprimer le commentaire">
                </div>
            </div>
            <input type="hidden" name="action" value="formulaireSuppCommentaire">
        </form>
        <hr>
    </div>
<?php endforeach; ?>
</body>
