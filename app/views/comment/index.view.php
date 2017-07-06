<?php if (isset($comment)): ?>
    <?php $this->includeModal('list', $comment->getListConfig(), $configList); ?>
<?php endif; ?>

<br>
    <a href="#">Supprimer les Commentaires séléctionnés</a>
