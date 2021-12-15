<body>
<?php $this->_t = "Page d'utilisateur"; ?>
<div class="container">
    <br>
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
    <form method="post">
        <h4 class="mb-5 text-center">Modifiez votre pseudo:</h4>
        <div class="row mb-5">
            <div class="col-3 text-end">
                <label for="inputPseudo" class="col-form-label">Pseudo</label>
            </div>
            <div class="col-7">
                <input id="inputPseudo" type="text"
                       placeholder="<?= Nettoyage::CleanChaineCarar($_SESSION['username']) ?>" name="txtNom"
                       class="form-control">
            </div>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-auto">
                <input type="submit" name="submit" class="btn btn-outline-info" value="Confirmer">
            </div>
        </div>
        <input type="hidden" name="action" value="formulaireModifPseudo">
    </form>
    <hr class="mb-5">
    <form method="post">
        <h4 class="mb-5 text-center">Modifiez votre mot de passe:</h4>
        <div class="row mb-5">
            <div class="col-3 text-end">
                <label for="inputMdp" class="col-form-label">Mot de passe</label>
            </div>
            <div class="col-7">
                <input id="inputMdp" type="password" name="txtMdp" class="form-control">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-3 text-end">
                <label for="inputMdpConfirm" class="col-form-label">Confirmez votre nouveau mot de passe</label>
            </div>
            <div class="col-7">
                <input id="inputMdpConfirm" type="password" name="txtMdpConfirm" class="form-control">
            </div>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col-auto">
                <input type="submit" name="submit" class="btn btn-outline-info" value="Confirmer">
            </div>
        </div>
        <input type="hidden" name="action" value="formulaireModifMdp">
    </form>
    <hr>
    <?php if (isset($_SESSION['type']) and Nettoyage::CleanChaineCarar($_SESSION['type']) != "super-admin"): ?>
        <div class="mt-5">
            <form method="post">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <input type="submit" name="submit" class="btn btn-outline-danger" value="Supprimer le compte">
                    </div>
                </div>
                <input type="hidden" name="action" value="formulaireSuppCompte">
            </form>
        </div>
    <?php else: ?>
    <div class="mt-5 text-center">
        <p style="color: lightgray">Vous ne pouvez pas supprimer votre compte en tant que super-admin !</p>
    </div>
    <?php endif; ?>
</div>
</body>
