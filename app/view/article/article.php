<!-- Article -->
<div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        <h2 class="section-heading"><?php echo $this->data["article"]->titre ?></h2>
        <p><?php echo $this->data["article"]->message ?></p>
    </div>
</div>

<hr>

<!-- Ecrire un commentaire -->
<div class="row mb-5">
    <div class="col-lg-8 col-md-10 mx-auto">
        <h2 class="section-heading"><i class="far fa-comments"></i> Commentaires</h2>
        <?php if (count($this->data["commentaires"]) == 0) { ?>
            <p>Personne n'a encore réagi</p>
        <?php } else { ?>
            <?php
                $i = 0;
                foreach ($this->data["commentaires"] as $commentaire) { ?>
                <div class="border pl-3 pr-3 mt-4 mb-3">

                    <!-- Commentaire -->
                    <p class="text-muted">Posté par <?php echo $commentaire->redacteur . ", le " . $commentaire->date ?></p>
                    <p class=""><?php echo $commentaire->message ?></p>
                    <?php if (isset($_SESSION["_id"])) { ?>
                    <button class="btn btn-secondary btn-block mb-3" id="repondreComment">Répondre à ce commentaire</button>
                    <form action="/blog/article/repondre/<?php echo $this->data["article"]->_id ?>/<?php echo $commentaire->_id ?>" class="d-none justify-content-between mt-2 mb-3" method="post">
                        <input type="text" placeholder="Réponse" name="message" class="flex-grow-1 mr-3 pl-2">
                        <button class="mb-2 btn btn-primary mt-1">Envoyer <i class="fa fa-paper-plane"></i></button>
                    </form>
                    <?php } ?>

                    <!-- Réponse -->
                    <?php echo $this->data["reponses"][$i];
                    $i++; 
                    ?>

                </div>
            <?php } ?>
        <?php } ?>

        <h3 class="section-heading">Commentez vous-aussi !</h3>
        <?php if (isset($_SESSION["_id"])) { ?>
            <form name="sentMessage" id="contactForm" action="/blog/article/commenter/<?php echo $this->data["article"]->_id ?>" method="post">
                <div class="control-group">
                    <div class="form-group floating-label-form-group controls">
                        <label>Message</label>
                        <textarea rows="3" class="form-control" placeholder="Message" id="message" name="message" required></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary float-right" id="sendMessageButton"><i class="fa fa-paper-plane"></i> Envoyer</button>
                </div>
            </form>
        <?php } else { ?>
            <!-- Pager -->
            <div class="clearfix">
                <a class="btn btn-primary" href="/blog/user/connexion">Vous devez être connecté pour réagir &rarr;</a>
            </div>
        <?php } ?>
    </div>
</div>


<hr>

<script>
    document.querySelectorAll("#repondreComment").forEach(element => {
        element.addEventListener("click", () => {
            let parent = element.parentElement;
            let form = parent.getElementsByTagName("form")[0].classList.replace('d-none', 'd-flex')
        })
    })
</script>