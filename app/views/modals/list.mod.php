<?php if (isset($config[Listable::LIST_STRUCT])): ?>

    <?php if (!isset($config[Listable::LIST_ROWS])): ?>
        <?php $config[Listable::LIST_ROWS] = []; ?>
    <?php endif; ?>
    <?php $data = $config[Listable::LIST_ROWS]; ?>

    <h1><?php echo $config[Listable::LIST_STRUCT][Listable::LIST_TITLE]; ?></h1>
    <a href="<?php echo $config[Listable::LIST_STRUCT][Listable::LIST_NEW_LINK]; ?>">
        <button>New</button>
    </a>

    <table>
        <tr>
            <?php foreach ($config[Listable::LIST_STRUCT][Listable::LIST_HEADER] as $column): ?>
                <th><?php echo $column; ?></th>
            <?php endforeach; ?>
        </tr>
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
                <td colspan="<?php echo count($config[Listable::LIST_STRUCT][Listable::LIST_HEADER]); ?>">No data</td>
            </tr>
        <?php endif; ?>
    </table>
<?php endif; ?>