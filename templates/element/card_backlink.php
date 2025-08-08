<?php
/**
 * Element: card_backlink
 *
 * Zobrazuje spätný odkaz na verejný náhľad kartičky podľa slugu.
 * @var \App\Model\Entity\EmployeeCard $employeeCard
 */
if (!empty($employeeCard->slug)):
    ?>
    <a href="<?= $this->Url->build(['controller' => 'Card', 'action' => 'index', $employeeCard->slug], ['fullBase' => true]) ?>"
       class="back-link" target="_blank">
        ← Náhľad kartičky
    </a>
<?php endif; ?>
