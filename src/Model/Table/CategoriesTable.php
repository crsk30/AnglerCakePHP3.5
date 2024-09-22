<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CategoriesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        // Table configuration
        $this->table('categories');  // Use `table` instead of `setTable` in CakePHP 3.5
        $this->primaryKey('id');     // Use `primaryKey` instead of `setPrimaryKey`
        $this->displayField('category_name');  // Use `displayField` instead of `setDisplayField`
    }

    public function validationDefault(Validator $validator)
    {
        // Validation for Category Name
        $validator
            ->notEmpty('category_name', 'Category Name is required')  // `notEmpty` instead of `notEmptyString`
            ->add('category_name', 'alpha', [
                'rule' => ['custom', '/^[a-zA-Z]+$/'],
                'message' => 'Category Name should only contain letters.',
            ])
            ->maxLength('category_name', 50, 'Category Name must be less than 50 characters.')
            ->add('category_name', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'Category Name already exists.',
            ]);

        // Validation for Status
        $validator
            ->boolean('status', 'Status should be a boolean value.')
            ->notEmpty('status', 'Status is required');  // `notEmpty` instead of `notEmptyString`

        return $validator;
    }
}
