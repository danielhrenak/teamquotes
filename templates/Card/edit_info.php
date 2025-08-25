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
    <p style="font-size: 0.9em; color: #666; margin-bottom: 5px;">
        <b>Minimálne dve</b> zaujímavosti o tebe. <br>
        Niečo, čo sa o tebe možno všeobecne nevie, ale čo by mohlo ostatných zaujímať. <br>
    </p>
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

    <div class="fav-section-title">Obľúbené jedlo / ľudia / skupiny / veci / kultúra / whatever</div>
    <p style="font-size: 0.9em; color: #666; margin-bottom: 10px;">
        Vyplňte aspoň 5 obľúbených vecí, ktoré ťa vystihujú. <br> Môže byť aj viac, buď co najkonkrétnejší. <br>
    </p>
    <?= $this->Form->control('favorite_things', [
        'label' => false,
        'type' => 'textarea',
        'rows' => 4,
        'maxlength' => $maxChars,
        'placeholder' => 'Tvoje obľúbené veci (napr. jedlo, knihy, filmy, hudba, osobnosti atď.)',
        'id' => 'favorite_things-me'
    ]) ?>


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
