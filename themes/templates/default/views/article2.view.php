<?php if (isset($article)): ?>
    <div class="container-cases">
        <h1><?php echo $article->title(); ?></h1>

        <div class="cases">
            <div class="case" style="border: none;">
                <img src="<?php echo BASE_PATH . $article->content()['path_image1']; ?>" alt="<?php echo $article->content()['image1']; ?>">
            </div>
            <div class="case" style="border: none;">
                <img src="<?php echo BASE_PATH . $article->content()['path_image2']; ?>" alt="<?php echo $article->content()['image2']; ?>">
            </div>
            <div class="case" style="border: none;">
                <img src="<?php echo BASE_PATH . $article->content()['path_image3']; ?>" alt="<?php echo $article->content()['image3']; ?>">
            </div>
        </div>
    </div>
    <section class="article-container">
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
                        <br>
                        <?php if ($article->user()->avatar() != null): ?>
                            <img src="http://lorempicsum.com/nemo/255/200/.5" alt="">
                        <?php endif; ?>
                        <span style="display: inline-block;margin-top: 10px">Posté par <?php echo $comment->user()->pseudo(); ?> le <?php echo Helpers::dateFrench($comment->created_at()); ?></span>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
<?php else: ?>
    <?php Helpers::error404(); ?>
<?php endif;