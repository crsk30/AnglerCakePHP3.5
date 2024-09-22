<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ProductsTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->setTable('products');
        $this->setPrimaryKey('id');
        
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
        ]);
        $this->belongsTo('Subcategories', [
            'foreignKey' => 'subcategory_id',
        ]);
        $this->belongsTo('Subsubcategories', [
            'foreignKey' => 'subsubcategory_id',
        ]);
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->requirePresence('product_name')
            ->notEmpty('product_name', 'Product Name is required')
            ->add('product_price', 'numeric', [
                'rule' => 'numeric',
                'message' => 'Please enter a valid price',
            ]);

        return $validator;
    }
}
