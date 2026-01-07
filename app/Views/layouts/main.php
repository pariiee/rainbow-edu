<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?? 'Rainbow Edu' ?></title>
</head>
<body>

<?php if (session()->getFlashdata('success')) : ?>
    <p style="color:green;">
        <?= session()->getFlashdata('success') ?>
    </p>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <p style="color:red;">
        <?= session()->getFlashdata('error') ?>
    </p>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')) : ?>
    <ul style="color:red;">
        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
            <li><?= esc($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?= $this->renderSection('content') ?>

</body>
</html>
