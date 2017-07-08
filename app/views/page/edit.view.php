<?php /** @var Page $page */ ?>
<?php /** @var View $view */ ?>

<h1>Editer une Page</h1>

<?php if(isset($page)): ?>
    <?php $this->includeModal('form', $page->getFormConfig()); ?>
<?php endif; ?>
