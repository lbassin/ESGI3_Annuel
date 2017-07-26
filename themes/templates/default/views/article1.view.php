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
    <div class="comment-container">
        <form action="" method="post">
            <input type="hidden" name="token" value="<?php echo Session::getToken(); ?>">
            <textarea name="content" id="" cols="30" rows="10" class="comment-form" placeholder="Votre commentaire"></textarea>
            <button type="submit" class="submit">Valider</button>
        </form>
        <?php if ($article->comments() != null): ?>
            <?php foreach ($article->comments() as $comment): ?>
                <?php if ($comment->moderate() == false): ?>
                    <?php $comment->getUser(); ?>
                    <div class="comment-content">
                        <p>
                            <?php echo $comment->content(); ?>
                        </p>
                        <a href="?report=<?php echo $comment->id(); ?>" type="submit" class="button-danger"><i class="fa fa-exclamation-circle padding-rigth" aria-hidden="true"></i>Signaler</a>
                        <?php if ($article->user()->avatar() != null): ?>
                            <img src="http://lorempicsum.com/nemo/255/200/.5" alt="">
                        <?php endif; ?>
                        <span>Posté par <?php echo $comment->user()->pseudo(); ?> le <?php echo Helpers::dateFrench($comment->created_at()); ?></span>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
<?php else: ?>
    <?php Helpers::error404(); ?>
<?php endif;