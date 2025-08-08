<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class FavoriteItemsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('favorite_items');
        $this->setPrimaryKey('id');

        $this->belongsTo('EmployeeCards', [
            'foreignKey' => 'employee_card_id',
            'joinType' => 'INNER'
        ]);
    }
}
