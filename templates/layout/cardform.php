<?php
/**
 * Základný layout pre viackrokové formuláre zamestnaneckej kartičky
 *
 * @var \Cake\View\View $this
 */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title><?= h($this->fetch('title')) ?></title>
    <?= $this->Html->css('cardform') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>
</body>
</html>
