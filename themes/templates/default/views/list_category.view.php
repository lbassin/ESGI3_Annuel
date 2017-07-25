<section class="view-container">
    <?php if (isset($categories)): ?>
        <?php foreach ($categories as $key => $category): ?>
            <?php $category->getArticle(); ?>
            <?php if ($key != 0): ?>
                <a href="<?php echo 'category/' . $category->url(); ?>" class="view-case">
                    <div class="view-case-image" style="background-image: url('http://lorempixel.com/800/800/') !important;"></div>
                    <h3><?php echo $category->title(); ?></h3>
                    <p><?php echo $category->description(); ?></p>
                    <p>Il y a <?php echo count($category->articles()); ?> article<?php echo (count($category->articles()) > 1) ? 's' : ''; ?> dans cette catégorie</p>
                </a>
            <?php else: ?>
                <a href="<?php echo 'category/' . $category->url(); ?>" class="view-first">
                    <div class="view-first-image" style="background-image: url();"></div>
                    <div class="view-first-content">
                        <h3><?php echo $category->title(); ?></h3>
                        <p>
                            <?php echo $category->description(); ?>
                        </p>
                        <div class="view-first-meta">
                            <span>
                                Il y a <?php echo count($category->articles()); ?> article<?php echo (count($category->articles()) > 1) ? 's' : ''; ?> dans cette catégorie
                            </span>
                        </div>
                    </div>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune catégorie n'est disponnible !</p>
    <?php endif; ?>
</section>