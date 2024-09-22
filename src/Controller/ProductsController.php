<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\File;

class ProductsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadModel('Categories');
        $this->loadModel('Subcategories');
        $this->loadModel('SubSubcategories');
    }

    public function display(){

    }
    public function add()
    {
        $product = $this->Products->newEntity();
    if ($this->request->is('post')) {
        $file = $this->request->getData('product_image');

        if (!empty($file['name'])) {
            $fileName = basename($file['name']);
            $targetPath = WWW_ROOT . 'img/uploads/' . $fileName;

            $uploadsDir = WWW_ROOT . 'img/uploads/';
            if (!is_dir($uploadsDir)) {
                mkdir($uploadsDir, 0755, true);
            }

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                $this->Flash->success(__('File uploaded successfully.'));
            } else {
                $this->Flash->error(__('File upload failed.'));
            }
        }
    }
        $categories = $this->Categories->find('list');
        $this->set(compact('product', 'categories'));
    }

    public function getSubcategories($categoryId = null)
    {
        $this->log('Category ID: ' . $categoryId, 'debug');
        $this->autoRender = false; // Prevent CakePHP from rendering a view
        $subcategories = $this->Subcategories->find('list', [
            'conditions' => ['category_id' => $categoryId],
            'keyField' => 'id',
            'valueField' => 'subcategory_name'
        ])->toArray();

        $this->response = $this->response->withType('application/json')
                                          ->withStringBody(json_encode(['subcategories' => $subcategories]));

        return $this->response;
    }

    public function getSubsubcategories($subcategoryId = null)
    {   
        
        $this->autoRender = false; // Prevent CakePHP from rendering a view
        $subsubcategories = $this->SubSubcategories->find('list', [
            'conditions' => ['subcategory_id' => $subcategoryId],
            'keyField' => 'id',
            'valueField' => 'sub_subcategory_name'
        ])->toArray();

        $this->response = $this->response->withType('application/json')
                                      ->withStringBody(json_encode(['subsubcategories' => $subsubcategories]));

        return $this->response;
    }

}
