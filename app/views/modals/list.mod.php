<?php
if (!isset($config['rows'])) {
    $config['rows'] = [];
}
$data = $config['rows'];
?>

<h1><?php echo $config['struct']['title']; ?></h1>
<a href="<?php echo $config['struct']['newLink']; ?>">
    <button>New</button>
</a>

<table>
    <tr>
        <?php foreach ($config['struct']['header'] as $column): ?>
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
                        <td><input type="checkbox"></td>
                    <?php elseif ($column['type'] == 'action'): ?>
                        <td><a href="<?php echo Helpers::getAdminRoute('user/edit') . $column['id']; ?>">Editer</a></td>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="<?php echo count($config['struct']['header']); ?>" style="text-align: center;">No data</td>
        </tr>
    <?php endif; ?>
</table>


<br>
<a href="#">Supprimer les utilisateurs selectionnés</a>