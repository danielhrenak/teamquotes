<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class EmployeeCardsTable extends Table
{

    public function initialize(array $config): void
    {
        parent::initialize($config);

        // Basic configuration
        $this->setTable('employee_cards');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        // Define the association with FavoriteItems
        $this->hasMany('FavoriteItems', [
            'foreignKey' => 'employee_card_id',
            'className' => 'App\Model\Table\FavoriteItemsTable'
        ]);

        // Define the association with PersonalityTypes
        $this->belongsTo('PersonalityTypes', [
            'foreignKey' => 'personality_type_id',
            'className' => 'App\Model\Table\PersonalityTypesTable'
        ]);
    }
}
