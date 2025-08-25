<?php
/**
 * @var \App\Model\Entity\EmployeeCard $employeeCard
 */
$this->assign('title', 'Uprav svoju Hero card');
$this->setLayout('cardform');
?>
<div class="edit-card-nav">
    <h2>Uprav svoju Hero card</h2>
    <h3>Postupne si prejdi troma krokmi nižšie.</h3>
    <div>Čítaj si inštrukcie, postupuj podľa nich a ak ti niečo nie je jasné, pýtaj sa. <br/>
        Celé ti to zaberie cca pol hodinu času, ale ber to ako prípravu na náš teambuilding :). <br/>
        </div>
    <?= $this->element('card_steps', [
        'employeeCard' => $employeeCard,
        'currentStep' => null // žiadny krok nie je aktívny v rozcestníku
    ]) ?>
    <?= $this->element('card_backlink', ['employeeCard' => $employeeCard]) ?>
</div>
