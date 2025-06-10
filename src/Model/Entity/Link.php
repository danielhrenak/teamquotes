<?php

namespace App\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * @property int $id
 * @property string $title
 * @property string $url
 * @property integer $screen_id
 * @property integer $duration
 * @property FrozenTime $created
 * @property FrozenTime $modified
 */
class Link extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];

}
