<?php /** @var Page $page */ ?>
<?php /** @var View $view */ ?>

<h1>Nouvelle Page</h1>

<h2>Informations</h2>
<?php if(isset($page)): ?>
    <?php $this->includeModal('form', $page->getFormConfig()); ?>
<?php endif; ?>

<h2>Contenu</h2>