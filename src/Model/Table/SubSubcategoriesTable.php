<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class SubSubcategoriesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('sub_subcategories');  // Set the table name
        $this->primaryKey('id');            // Set the primary key
        $this->displayField('sub_subcategory_name');  // Set the display field

        // Association with Subcategories
        $this->belongsTo('Subcategories', [
            'foreignKey' => 'subcategory_id',
            'joinType' => 'INNER'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('sub_subcategory_name', 'create')
            ->notEmpty('sub_subcategory_name', 'Sub Subcategory Name is required.')
            ->add('sub_subcategory_name', 'maxLength', [
                'rule' => ['maxLength', 255],
                'message' => 'Sub Subcategory Name cannot exceed 255 characters.'
            ]);

        return $validator;
    }
}
