<?php if (isset($media)): ?>
    <?php $this->includeModal('list', $media->getListConfig()); ?>
<?php endif; ?>

<br>
    <a href="#">Supprimer les Medias séléctionnés</a>
