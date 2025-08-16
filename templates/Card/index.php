<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Hero card – 16 personalities</title>
    <link rel="stylesheet" href="/css/card.css?v=2">
</head>
<body>

<?php
$typeLabels = [
    'hra'   => '🎲 Hra',
    'kniha' => '📚 Kniha',
    'film'  => '🎬 Film',
    'hudba' => '🎵 Hudba',
    'ine'   => '⭐️ Iné'
];
$itemsByType = [];
if (!empty($employeeCard->favorite_items)) {
    foreach ($employeeCard->favorite_items as $item) {
        $itemsByType[$item->item_type][] = $item->item_value;
    }
}
$color = h($employeeCard->personality_type->color ?? '#a076ff');
?>

<!-- Predná strana -->
<div class="card front hero-card" style="border: 3px solid <?= $color ?>;">
    <!-- HERO dekoratívne pozadie -->
    <div class="hero-bg"></div>

    <!-- O mne v špeciálnom rámiku hore -->
    <div class="about hero-about">
        <?= nl2br(h($employeeCard->about_me)) ?>
    </div>

    <div class="front-content">
        <img src="<?= h($employeeCard->photo_url) ?>"
             class="photo hero-photo"
             alt="Fotka zamestnanca"
             style="border:3px solid <?= $color ?>;">
        <div>
            <div class="name hero-name"><?= h(mb_strtoupper($employeeCard->full_name)) ?></div>
        </div>
        <div class="personality-type hero-personality-type" style="color:<?= $color ?>; margin-top: 8px;">
            <?= h($employeeCard->personality_type->code) ?><br/>
            <?= h($employeeCard->personality_type->label) ?>
        </div>
    </div>

    <div class="section-title hero-section-title" style="color:<?= $color ?>;">Obľúbené veci</div>
    <ul>
        <?php foreach ($typeLabels as $type => $label): ?>
            <?php if (!empty($itemsByType[$type])): ?>
                <li><?= $label ?>: <?= h(implode(', ', $itemsByType[$type])) ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>

<!-- Zadná strana -->
<div class="card back hero-card" style="border: 2px solid <?= $color ?>;">
    <div class="hero-bg"></div>
    <div class="personality-desc-title hero-desc-title" style="color:<?= $color ?>;">
        <?= h($employeeCard->personality_type->code) ?> – Popis osobnosti
    </div>
    <div class="desc">
        <div style="font-size:10px">
            Charakterové črty: <br/>
            <?= nl2br($employeeCard->personality_type->traits) ?>
        </div>
        <br/>
        <?= nl2br($employeeCard->personality_type->description) ?>
    </div>
</div>

<div style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); display: flex; gap: 12px;" class="no-print">
    <a href="/card/edit/<?= h($employeeCard->slug) ?>"
       class="btn-edit">
        ✏️ Editovať kartičku
    </a>
    <button type="button"
            onclick="window.print();"
            class="btn-print">
        🖨️ Tlačiť kartičku
    </button>
</div>

</body>
</html>
