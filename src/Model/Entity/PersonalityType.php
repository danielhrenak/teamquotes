<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class PersonalityType extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    protected function _getLabelCode()
    {
        return $this->code . ' (' . $this->label . ')';
    }

}
