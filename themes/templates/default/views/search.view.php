<section class="view-container">
    <form action="" method="get" class="form-container">
        <h2>Recherche</h2>
        <input type="text" placeholder="Search" name="search" value="<?php echo ((isset($search)) ? $search : ''); ?>">
        <button type="submit">Rechercher</button>
    </form>
    <?php if (isset($pages) || isset($articles)): ?>
        <?php if (!empty($pages)): ?>
            <?php foreach ($pages as $page): ?>
                <a href="page/<?php echo $page->url(); ?>" class="view-case">
                    <div class="view-case-image"></div>
                    <div class="view-case-content">
                        <h3><?php echo $page->title(); ?></h3>
                        <p><?php echo $page->description(); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            Aucune page trouvée
        <?php endif; ?>
        <?php if (!empty($articles)): ?>
            <?php foreach ($articles as $article): ?>
                <a href="article/<?php echo $article->url(); ?>" class="view-case">
                    <div class="view-case-image"></div>
                    <div class="view-case-content">
                        <h3><?php echo $article->title(); ?></h3>
                        <p><?php echo $article->description(); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            Aucun article trouvé
        <?php endif; ?>
    <?php endif; ?>
</section>
