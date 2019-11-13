<h1>Inscription</h1>
<div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        <form action="inscription" name="sentMessage" id="contactForm" method="post" novalidate>
            <div class="control-group mt-3">
                <div class="form-group floating-label-form-group controls">
                    <label>Pseudo</label>
                    <input type="text" class="form-control" placeholder="Pseudo" id="pseudo" name="pseudo" required data-validation-required-message="Veuillez renseigner un pseudo.">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group mt-3">
                <div class="form-group floating-label-form-group controls">
                    <label>Mot de passe</label>
                    <input type="password" class="form-control" placeholder="Mot de passe" id="password" name="password" required data-validation-required-message="Veuillez renseignez un mot de passe.">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <?php if (isset($this->data['erreur'])) echo "<p class='text-danger' >" . $this->data['erreur'] . "</p>" ?>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="sendMessageButton">S'inscrire</button>
                <a class="float-right" href="connexion">Déjà inscrit ?</a>
            </div>
        </form>
    </div>
</div>