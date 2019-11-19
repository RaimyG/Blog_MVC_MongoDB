<div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        <h2 class="section-heading"><i class="fas fa-feather-alt"></i> Rédiger un article</h2>
        <?php if (isset($this->data['success'])) echo "<p class='text-success' >" . $this->data['success'] . "</p>" ?>
        <?php if (isset($this->data['erreur'])) echo "<p class='text-danger' >" . $this->data['erreur'] . "</p>" ?>
        <form action="ecrire" name="sentMessage" id="contactForm" method="post" novalidate>
            <div class="control-group mt-3">
                <div class="form-group floating-label-form-group controls">
                    <label>Titre</label>
                    <input type="text" class="form-control" placeholder="Titre" id="titre" name="titre" value="<?php echo (isset($_POST['titre']) && !isset($this->data['success'])) ? $_POST['titre'] : '' ?>" required data-validation-required-message="Please enter your name.">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group mt-3">
                <div class="form-group floating-label-form-group controls">
                    <label>Sous-titre</label>
                    <input type="text" class="form-control" placeholder="Sous-titre" id="sous_titre" name="sous_titre" value="<?php echo (isset($_POST['sous-titre']) && !isset($this->data['success'])) ? $_POST['sous-titre'] : '' ?>">
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <div class="control-group mt-3">
                <div class="form-group floating-label-form-group controls">
                    <textarea id="summernote" name="message"></textarea>
                    <p class="help-block text-danger"></p>
                </div>
            </div>
            <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="sendMessageButton"><i class="fa fa-paper-plane"></i> Envoyer</button>
            </div>
        </form>
    </div>
</div>