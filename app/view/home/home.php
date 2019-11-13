<h1>Les derniers postes</h1>
<div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
        <?php foreach ($this->data['articles'] as $article) { ?>
            <div class="post-preview">
                <a href="<?php echo "article/$article->_id" ?>">
                    <h2 class="post-title">
                        <?php echo $article->titre ?>
                    </h2>
                    <h3 class="post-subtitle">
                        <?php echo $article->sous_titre ?>
                    </h3>
                </a>
                <p class="post-meta">Posté par
                    <a href="#"><?php echo $article->redacteur ?></a>
                    le <?php echo $article->date ?></p>
            </div>
            <hr>
        <?php } ?>
    </div>
</div>