<?php /** @var View $this */ ?>
<?php /** @var Page $page */ ?>

<h1>Nouvelle page</h1>
<small><a href="<?php echo Helpers::getAdminRoute('page'); ?>">Back</a></small>

<?php if(isset($page)): ?>
    <?php $this->includeModal('form', $page->getFormConfig()); ?>
<?php endif; ?>
