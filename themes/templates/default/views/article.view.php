<?php if (isset($article)): ?>
    <section class="article-container">
        <header>
            <div class="article-title">
                <h1><?php echo $article->title(); ?></h1>
            </div>
            <div class="article-image">
                <img src="<?php // TODO echo $article->proprietyMedia(); ?>" alt="">
            </div>
        </header>
        <article class="article-content">
            <p>
                <?php echo $article->content(); ?>
            </p>
            <div class="article-details">
                <img src="<?php // TODO echo $article->user()->avatar(); ?>" alt="">
                <span>Posté par <?php echo $article->user()->pseudo(); ?> le <?php echo Helpers::dateFrench($article->created_at()); ?></span>
            </div>
        </article>
    </section>
<?php else: ?>
    <?php Helpers::error404(); ?>
<?php endif;