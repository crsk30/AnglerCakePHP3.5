<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class SubcategoriesTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('subcategories');  // Set the table
        $this->primaryKey('id');        // Set the primary key
        $this->displayField('subcategory_name');  // Set the display field

        // Association with Categories and SubSubcategories
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('SubSubcategories', [
            'foreignKey' => 'subcategory_id'
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('subcategory_name', 'create')
            ->notEmpty('subcategory_name', 'Subcategory Name is required.')
            ->add('subcategory_name', 'maxLength', [
                'rule' => ['maxLength', 255],
                'message' => 'Subcategory Name cannot exceed 255 characters.'
            ]);

        return $validator;
    }
}
