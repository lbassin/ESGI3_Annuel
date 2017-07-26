<?php if (isset($article)): ?>
    <section class="article-container">
        <header>
            <div class="article-title">
                <h1><?php echo $article->title(); ?></h1>
            </div>
            <div class="article-image">
                <img src="<?php echo BASE_PATH . $article->content()['path_image1']; ?>" alt="<?php echo $article->content()['image1']; ?>">
            </div>
        </header>
        <article class="article-content">
            <p data-wysiwyg='<?php echo $article->content()['editor0']; ?>'></p>
            <div class="article-details">
                <?php if ($article->user()->avatar() != null): ?>
                    <img src="http://lorempicsum.com/nemo/255/200/.5" alt="">
                <?php endif; ?>
                <span>Posté par <?php echo $article->user()->pseudo(); ?> le <?php echo Helpers::dateFrench($article->created_at()); ?></span>
            </div>
        </article>
    </section>
<?php else: ?>
    <?php Helpers::error404(); ?>
<?php endif;