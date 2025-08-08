<?php
/**
 * @var \App\Model\Entity\EmployeeCard $employeeCard
 * @var array $itemTypes
 */
$this->assign('title', 'Krok 3 z 3 – Zamestnanecká kartička');
$this->setLayout('cardform');
$maxChars = 200;
$currentLength = mb_strlen($employeeCard->about_me ?? '');
$remaining = $maxChars - $currentLength;
?>

<div class="form-card">
    <div class="step-info">Krok 3 z 3: Osobné údaje</div>
    <?= $this->element('card_steps', ['employeeCard' => $employeeCard, 'currentStep' => 'info']) ?>

    <?= $this->Form->create($employeeCard) ?>

    <label for="about-me">O mne</label>
    <span style="float:right;color:#888;font-size:0.99em;">
        <span id="aboutMeCharsLeft"><?= $remaining ?></span> znakov zostáva
    </span>
    <?= $this->Form->control('about_me', [
        'label' => false,
        'type' => 'textarea',
        'rows' => 4,
        'maxlength' => $maxChars,
        'placeholder' => 'Krátky popis o tebe...',
        'id' => 'about-me'
    ]) ?>

    <div class="fav-section-title">Obľúbené diela / ľudia / skupiny / veci</div>
    <?php foreach ($itemTypes as $type => $label): ?>
        <?php
        $fav = null;
        if (!empty($employeeCard->favorite_items)) {
            foreach ($employeeCard->favorite_items as $item) {
                if ($item->item_type === $type) {
                    $fav = $item;
                    break;
                }
            }
        }
        ?>
        <div class="favorite-group">
            <label for="fav-<?= h($type) ?>"><?= h($label) ?>:</label>
            <?= $this->Form->control("favorite_items.{$type}.item_value", [
                'label' => false,
                'value' => $fav ? $fav->item_value : '',
                'id' => "fav-{$type}"
            ]) ?>
            <?= $this->Form->hidden("favorite_items.{$type}.item_type", [
                'value' => $type
            ]) ?>
            <?php if ($fav && $fav->id): ?>
                <?= $this->Form->hidden("favorite_items.{$type}.id", [
                    'value' => $fav->id
                ]) ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <div class="clearfix">
        <?= $this->Form->button('Uložiť a pokračovať', ['class' => 'save-btn']) ?>
    </div>
    <?= $this->Form->end() ?>

    <?= $this->element('card_backlink', ['employeeCard' => $employeeCard]) ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var textarea = document.getElementById('about-me');
        var counter = document.getElementById('aboutMeCharsLeft');
        var maxChars = <?= $maxChars ?>;
        function updateCounter() {
            var len = textarea.value.length;
            counter.textContent = maxChars - len;
        }
        if (textarea && counter) {
            textarea.addEventListener('input', updateCounter);
            updateCounter();
        }
    });
</script>
