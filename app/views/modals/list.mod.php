<div id="list">
    <?php if (isset($config[Listable::LIST_STRUCT])): ?>

        <?php if (!isset($config[Listable::LIST_ROWS])): ?>
            <?php $config[Listable::LIST_ROWS] = []; ?>
        <?php endif; ?>
        <?php $data = $config[Listable::LIST_ROWS]; ?>

        <h1><?php echo $config[Listable::LIST_STRUCT][Listable::LIST_TITLE]; ?></h1>

        <div id="menu">
            <form action="" method="get">
                <input type="text" placeholder="Search by keyword" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            </form>
            <div id="action">
                <a href="<?php echo $config[Listable::LIST_STRUCT][Listable::LIST_NEW_LINK]; ?>" class="button primary">
                    New
                </a>
            </div>
        </div>

        <div id="filters">
            <div id="mass-action">
                <select name="" id="">
                    <option value="">Mass Action</option>
                    <option value="delete">Delete</option>
                </select>
                <span class="records-count"><?php echo $pagination['count']; ?> Records found</span>
            </div>
            <div id="pagination">
                <select name="currentSize">
                    <?php $currentSize = $pagination['size']; ?>
                    <?php foreach ($pagination['availableSize'] as $size): ?>
                        <option value="<?php echo $size; ?>"
                            <?php if ($size == $currentSize): ?>
                                <?php echo 'selected="selected"'; ?>
                            <?php endif; ?>
                        ><?php echo $size; ?></option>
                    <?php endforeach; ?>
                </select><span>per page</span>
                <div class="change-page previous">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                </div>
                <input id="input-page" type="text" data-max="<?php echo ($pagination['count'] / $pagination['size']) + 1; ?>"
                       value="<?php echo $pagination['page']; ?>"><span> of
                    <?php echo ceil($pagination['count'] / $pagination['size']); ?></span>
                <div class="change-page next">
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                </div>
            </div>
        </div>

        <table>
            <thead>
            <tr>
                <?php foreach ($config[Listable::LIST_STRUCT][Listable::LIST_HEADER] as $column): ?>
                    <th><?php echo $column; ?></th>
                <?php endforeach; ?>
            </tr>
            </thead>
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <?php foreach ($row as $column): ?>
                            <?php if ($column['type'] == 'text'): ?>
                                <td><?php echo $column['value']; ?></td>
                            <?php elseif ($column['type'] == 'checkbox'): ?>
                                <td><label><input type="checkbox"></label></td>
                            <?php elseif ($column['type'] == 'action'): ?>
                                <td>
                                    <a href="<?php echo $config[Listable::LIST_STRUCT][Listable::LIST_EDIT_LINK] . $column['id']; ?>">Editer</a>
                                </td>
                            <?php else: ?>
                                <td></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="<?php echo count($config[Listable::LIST_STRUCT][Listable::LIST_HEADER]); ?>">No data
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    <?php endif; ?>
</div>
<script>
    let massiveDeleteUrl = '<?php echo Helpers::getAdminRoute(Routing::$currentClass.'/delete'); ?>';
</script>
<script src="<?php echo Helpers::getAsset('js/modals/list.js'); ?>"></script>