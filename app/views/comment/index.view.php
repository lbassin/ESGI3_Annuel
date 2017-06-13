<?php if (isset($comment)): ?>
    <?php $this->includeModal('list', $comment->getListConfig()); ?>
<?php endif; ?>

<br>
    <a href="#">Supprimer les Commentaires séléctionnés</a>
