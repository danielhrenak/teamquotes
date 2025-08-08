<?php
/**
 * @var \App\Model\Entity\EmployeeCard $employeeCard
 */
$this->assign('title', 'Upraviť zamestnaneckú kartičku');
$this->setLayout('cardform');
?>
<div class="edit-card-nav">
    <h2>Upraviť zamestnaneckú kartičku</h2>
    <?= $this->element('card_steps', [
        'employeeCard' => $employeeCard,
        'currentStep' => null // žiadny krok nie je aktívny v rozcestníku
    ]) ?>
    <?= $this->element('card_backlink', ['employeeCard' => $employeeCard]) ?>
</div>
