<?php $this->_t = "Page d'administrateur"; ?>
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
        <h4 class="mb-5 text-center">Créer un utilisateur:</h4>
        <div class="row mb-5">
            <div class="row mb-5">
                <div class="col-3 text-end">
                    <label for="inputPseudo" class="col-form-label">Pseudo</label>
                </div>
                <div class="col-7">
                    <input id="inputPseudo" type="text" name="txtNom" class="form-control" required>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-3 text-end">
                    <label for="inputEmail" class="col-form-label">Email</label>
                </div>
                <div class="col-7">
                    <input id="inputEmail" type="text" name="txtEmail" class="form-control" required>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-3 text-end">
                    <label for="inputMdp">Mot de passe</label>
                </div>
                <div class="col-7">
                    <input id="inputMdp" type="password" name="txtMdp" class="form-control" required>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-3 text-end">
                    <label for="inputMdpConfirm">Confirmez le mot de passe</label>
                </div>
                <div class="col-7">
                    <input id="inputMdpConfirm" type="password" name="txtMdpConfirm" class="form-control" required>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-3">
                    <label for="type" class="col-form-label"></label>
                </div>
                <div class="col-7">
                    <div>
                        <select name="type" id="type" class="btn btn-outline-secondary dropdown-toggle" required>
                            <option value="" disabled selected>Type</option>
                            <?php if (isset($_SESSION['type']) && Nettoyage::CleanChaineCarar($_SESSION['type']) == "super-admin")
                                echo "<option value=\"super-admin\">Super-administrateur</option>"; ?>
                            <option value="admin">Administrateur</option>
                            <option value="ecrivain">Ecrivain</option>
                            <option value="user">Utilisateur</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-auto">
                <input type="submit" name="submit" class="btn btn-outline-info" value="Confirmer">
            </div>
            <input type="hidden" name="action" value="formulaireCreerUser">
        </div>
    </form>
    <div class="mt-5">
    </div>
</div>