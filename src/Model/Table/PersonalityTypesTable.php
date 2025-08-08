<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class PersonalityTypesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('personality_types');
        $this->setPrimaryKey('id');
        $this->setDisplayField('label');

        $this->hasMany('EmployeeCards', [
            'foreignKey' => 'personality_type_id'
        ]);
    }
}
