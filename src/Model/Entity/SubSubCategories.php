<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Validation\Validator;

class SubSubcategory extends Entity
{
    // Allow mass assignment for all fields, except the ID
    protected  $_accessible = [
        '*' => true,
        'id' => false,
        "subcategory_id" => true,  // Foreign key to subcategories
        "sub_subcategory_code" => true,
        "sub_subcategory_name" => true,
        "status" => true,
    ];

    // Validation logic can be added in the Table class
}
