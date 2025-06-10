<?php

namespace App\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * @property int $id
 * @property string $content
 * @property string $author
 * @property string $category
 * @property FrozenTime $created
 * @property FrozenTime $modified
 */
class Item extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

}
