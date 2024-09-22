<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Category extends Entity
{
    protected $_accessible = [
        'category_code' => true,
        'category_name' => true,
        'status' => true,
    ];
}
