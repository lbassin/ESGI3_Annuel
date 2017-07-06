<?php /** @var Exception $exception */ ?>

<h1>Something went wrong</h1>
<h2>
    <?php echo $exception->getMessage(); ?><br>
    <?php echo $exception->getFile(); ?>:<?php echo $exception->getLine(); ?>
</h2>

<table>
    <tr>
        <th>#</th>
        <th>File</th>
        <th>Line</th>
        <th>Class</th>
        <th>Function</th>
        <th>Args</th>
    </tr>
    <?php foreach ($exception->getTrace() as $key => $trace): ?>
        <tr>
            <td><?php echo $key; ?></td>
            <td><?php echo isset($trace['file']) ? $trace['file'] : ''; ?></td>
            <td><?php echo isset($trace['line']) ? $trace['line'] : ''; ?></td>
            <td><?php echo isset($trace['class']) ? $trace['class'] : ''; ?></td>
            <td><?php echo isset($trace['function']) ? $trace['function'] : ''; ?></td>
            <td><?php isset($trace['args']) ? Helpers::debug($trace['args']) : null; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
