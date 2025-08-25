<?php
/**
 * @var \App\Model\Entity\EmployeeCard $employeeCard
 * @var array $personalityTypes
 */
$this->assign('title', 'Krok 1 z 3 – Zamestnanecká kartička');
$this->setLayout('cardform'); // použije layout/cardform.php
?>

<div class="form-card" xmlns="http://www.w3.org/1999/html">
    <div class="step-info">Krok 1 z 3: Základné údaje</div>
    <?= $this->element('card_steps', ['employeeCard' => $employeeCard, 'currentStep' => 'name']) ?>

    <div class="test-warning" style="background: #f3f0ff; border-left: 4px solid #a076ff; padding: 18px 16px 12px 16px; margin-bottom: 26px;">
        Pred výberom typu osobnosti si <b>urob <a href="https://www.16personalities.com/sk/bezplatny-test-osobnosti" target="_blank" rel="noopener" style="color:#512da8;text-decoration:underline;">bezplatný osobnostný test (16personalities.com)</a></b>.<br>
        (Test zaberie cca 15 minút.)<br>
        Výsledok testu potom zadaj nižšie.<br>
    </div>

    <?= $this->Form->create($employeeCard) ?>

    <?= $this->Form->control('full_name', [
        'label' => 'Meno, prezývka - ako ťa poznáme',
        'required' => true,
        'templates' => ['inputContainer' => '{{content}}'],
    ]) ?>

    <?= $this->Form->control('personality_type_id', [
        'label' => 'Typ osobnosti (čo ti vyšlo v teste)',
        'options' => $personalityTypes,
        'empty' => '-- vyberte typ --',
        'required' => true,
        'templates' => ['inputContainer' => '{{content}}'],
        'class' => 'custom-select', // pridaj vlastnú triedu
    ]) ?>

    <br/>

    <button type="submit" id="continue_btn">Uložiť a pokračovať</button>
    <?= $this->Form->end() ?>

    <?= $this->element('card_backlink', ['employeeCard' => $employeeCard]) ?>
</div>
