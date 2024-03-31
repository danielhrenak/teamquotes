<?php

namespace App\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * @property FrozenTime $published_until
 * @property string $title
 * @property string $body
 * @property string $image
 * @property int $user_id
 * @property string $slug
 * @property int $id
 * @property FrozenTime $created
 * @property FrozenTime $modified
 */
class Article extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];

    public function hide(): void
    {
        $this->published_until = FrozenTime::now()->subMinute();
    }

    public function isPublished(): bool
    {
        return $this->published_until > FrozenTime::now();
    }

    public function showFor(int $days): void
    {
        if($this->isPublished()) {
            $this->published_until = $this->published_until->addDays($days);
            return;
        }
        $this->published_until = FrozenTime::now()->addDays($days);
    }

}
