<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Hero card – 16 personalities</title>
    <link rel="stylesheet" href="/css/card.css?v=3">
</head>
<body>

<?php
$typeLabels = [
    'hra'   => '🎲',
    'kniha' => '📚',
    'film'  => '🎬',
    'hudba' => '🎵',
    'ine'   => '⭐️'
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
    <div class="hero-bg"></div>

    <!-- Fotka v hornej tretine s jemným fade -->
    <div class="front-content">
        <div class="photo-wrapper">
            <img src="<?= h($employeeCard->photo_url) ?>" class="photo hero-photo" alt="Fotka zamestnanca">
            <div class="photo-overlay"></div>
        </div>

        <div class="name hero-name"><?= h(mb_strtoupper($employeeCard->full_name)) ?></div>
        <div class="personality-type hero-personality-type" style="color:<?= $color ?>;">
            <?= h($employeeCard->personality_type->code) ?><br/>
            <?= h($employeeCard->personality_type->label) ?>
        </div>
    </div>

    <!-- O mne -->
    <div class="about hero-about">
        <?= nl2br(h($employeeCard->about_me)) ?>
    </div>

   <div class="about hero-about" style="font-size: 0.85em; color: #888; margin-top: 10px;">
       <?= nl2br(h($employeeCard->favorite_things)) ?>
   </div>
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
    <a href="/card/edit/<?= h($employeeCard->slug) ?>" class="btn-edit">
        ✏️ Editovať kartičku
    </a>
    <button type="button" onclick="window.print();" class="btn-print">
        🖨️ Tlačiť kartičku
    </button>
</div>

</body>
</html>
