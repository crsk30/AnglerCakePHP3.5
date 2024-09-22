<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Validation\Validator;

class Subcategory extends Entity
{
    // Allow mass assignment for all fields, except the ID
    protected  $_accessible = [
        '*' => true,
        'id' => false,
        "category_id" => true,    // Foreign key to categories
        "subcategory_code" => true,
        "subcategory_name" => true,
        "status" => true,
    ];

    // Validation logic can be added in the Table class
}
