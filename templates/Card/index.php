<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Hero card – 16 personalities</title>
    <link rel="stylesheet" href="/css/card.css?v=10">
    <style>
        html, body {
            width: 210mm;
            height: 297mm;
            min-height: 297mm;
            margin: 0;
            padding: 0;
            background: #fff;
        }
        .a4-sheet {
            width: 210mm;
            height: 297mm;
            min-height: 297mm;
            margin: 0 auto;
            background: #fff;
            display: flex;
            flex-direction: column;
            page-break-after: avoid;
        }
        .half {
            width: 100%;
            height: 50%;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .half.top {
            transform: rotate(180deg);
        }
        .card-full {
            width: 100%;
            max-width: 210mm;
            height: 100%;
            min-height: unset;
            min-width: unset;
            box-shadow: none;
            border-radius: 0;
            border-width: 4px !important;
            background: linear-gradient(135deg, #fafcff 70%, #e4e9f7 100%);
            padding: 0;
            display: flex;
            flex-direction: row;
            align-items: stretch;
            border: 0;
        }
        .card-photo {
            width: 76%;
            max-width: 220px;
            max-height: 220px;
            border-radius: 20px;
            border: 4px solid #fff;
            object-fit: cover;
            margin-bottom: 30px;
            margin-top: 20px;
            box-shadow: none;
            position: relative;
        }
        .photo-overlay-big {
            position: absolute;
            bottom: 0; left: 0; width: 100%; height: 55%;
            background: linear-gradient(to top, rgba(255,255,255,0.85), rgba(255,255,255,0));
            border-radius: 20px;
            pointer-events: none;
        }
        .card-name {
            font-size: 1.65em;
            font-weight: bold;
            color: #222;
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            text-shadow: 0 2px 8px #e8eaf6, 0 1px 0 #fff;
            text-align: center;
        }
        .card-personality-type {
            font-size: 1.25em;
            font-weight: bold;
            margin-bottom: 18px;
            text-shadow: 0 1px 0 #fff, 0 0 2px #d1d2f6;
            letter-spacing: 0.02em;
            text-align: center;
        }
        .card-about {
            font-size: 1.15em;
            margin: 14px 0;
            padding: 18px 20px;
            background: rgba(255,255,255,0.78);
            border-radius: 14px;
            text-align: center;
        }
        .card-favorites {
            font-size: 1em;
            color: #888;
            margin-top: 11px;
            padding: 9px 16px;
        }
        .desc-title {
            font-weight: bold;
            font-size: 1.17em;
            margin-bottom: 10px;
            text-align: center;
            letter-spacing: 0.02em;
            text-shadow: 0 1px 0 #fff;
        }
        .card-desc {
            color: #444;
            font-size: 1em;
            line-height: 1.47;
            padding: 0 16px 0 13px;
            overflow-y: auto;
            max-height: 64vh;
            background: rgba(255,255,255,0.72);
            border-radius: 12px;
        }
        .card-traits {
            font-size: 0.95em;
            margin-bottom: 14px;
            color: #6a6a7a;
        }
        @media print {
            html, body {
                width: 210mm !important;
                height: 297mm !important;
                min-height: 297mm !important;
                margin: 0 !important; padding: 0 !important;
                background: #fff !important;
                overflow: visible !important;
            }
            .a4-sheet {
                width: 210mm !important;
                height: 297mm !important;
                min-height: 297mm !important;
                margin: 0 !important;
                page-break-after: avoid !important;
                box-sizing: border-box;
            }
            .half, .card-full {
                page-break-inside: avoid !important;
                break-inside: avoid !important;
            }
            .no-print { display: none !important; }
            @page {
                size: A4 portrait;
                margin: 0;
            }
        }
    </style>
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

<div class="a4-sheet">
    <!-- Vrchná polovica: Predná strana (hore nohami) -->
    <div class="half top">
        <div class="card-full" style="border-top: 6px solid <?= $color ?>; border-bottom: 0;">
            <div class="card-left" >
                <div style="position:relative;width:100%;display:flex;justify-content:center;">
                    <img src="<?= h($employeeCard->photo_url) ?>" class="card-photo" alt="Fotka zamestnanca">
                </div>
                <div class="card-name"><?= h(mb_strtoupper($employeeCard->full_name)) ?></div>
            </div>
            <div class="card-right" >
                <div class="card-personality-type" style="color:<?= $color ?>;">
                    <?= h($employeeCard->personality_type->code) ?><br/>
                    <?= h($employeeCard->personality_type->label) ?>
                </div>
                <?php if (!empty($employeeCard->about_me)) { ?>
                    <div class="card-about">
                        <?= nl2br(h($employeeCard->about_me)) ?>
                    </div>
                <?php } ?>
                <?php if (!empty($employeeCard->favorite_things)) { ?>
                    <div class="card-favorites">
                        <?= nl2br(h($employeeCard->favorite_things)) ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Spodná polovica: Zadná strana -->
    <div class="half">
        <div class="card-full" style="border-bottom: 6px solid <?= $color ?>; border-top: 0;">
            <div class="card-left">
                <div style="position:relative;width:100%;display:flex;justify-content:center;">
                    <img src="<?= h($employeeCard->photo_url) ?>" class="card-photo" alt="Fotka zamestnanca">
                </div>
                <div class="card-name"><?= h(mb_strtoupper($employeeCard->full_name)) ?></div>
            </div>
            <div class="card-right" style="align-items: flex-start; justify-content: flex-start; height: 100%;">
                <div class="card-personality-type" style="color:<?= $color ?>;">
                    <?= h($employeeCard->personality_type->code) ?><br/>
                    <?= h($employeeCard->personality_type->label) ?>
                </div>
                <?php if (!empty($employeeCard->personality_type->traits)) { ?>
                    <div class="card-traits">
                        <?= nl2br(($employeeCard->personality_type->traits)) ?>
                    </div>
                <?php } ?>
                <div >
                    <?= $employeeCard->personality_type->description ?>
                </div>
            </div>
        </div>
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
