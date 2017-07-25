<section class="view-container">
    <?php if (isset($articles)): ?>
        <?php foreach ($articles as $key => $article): ?>
            <?php $article->getUser(); ?>
            <?php if ($key != 0): ?>
                <a href="<?php //echo $article->url(); ?>" class="view-case">
                    <div class="view-case-image" style="background-image: url('http://lorempixel.com/800/800/') !important;"></div>
                    <h3><?php echo $article->title(); ?></h3>
                    <p><?php echo $article->description(); ?></p>
                    <p>Posté par <?php echo $article->user()->pseudo(); ?> le <?php echo $article->created_at(); ?></p>
                </a>
            <?php else: ?>
                <a href="<?php echo 'article/'.$article->url(); ?>" class="view-first">
                    <div class="view-first-image" style="background-image: url();"></div>
                    <div class="view-first-content">
                        <h3><?php echo $article->title(); ?></h3>
                        <p>
                            <?php echo $article->description(); ?>
                        </p>
                        <div class="view-first-meta">
                            <span>
                                Posté par <?php echo $article->user()->pseudo(); ?> le <?php echo Helpers::dateFrench($article->created_at()); ?>
                            </span>
                        </div>
                    </div>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucun article récemment posté disponnible !</p>
    <?php endif; ?>
</section>
