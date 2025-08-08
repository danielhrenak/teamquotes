<?php
/**
 * Krokový progress bar pre editáciu kartičky
 *
 * @var \App\Model\Entity\EmployeeCard $employeeCard
 * @var string $currentStep ('name'|'photo'|'info')
 */
$steps = [
    'name'  => ['label' => 'Meno a typ osobnosti', 'action' => 'edit_name'],
    'photo' => ['label' => 'Fotka', 'action' => 'edit_photo'],
    'info'  => ['label' => 'Osobné údaje a o mne', 'action' => 'edit_info'],
];
?>
<ol class="progress">
    <?php foreach ($steps as $key => $step): ?>
        <li<?= ($currentStep === $key) ? ' style="background:#f3f0ff"' : '' ?>>
            <?= $this->Html->link(
                $step['label'],
                ['action' => $step['action'], $employeeCard->slug]
            ) ?>
        </li>
    <?php endforeach; ?>
</ol>
