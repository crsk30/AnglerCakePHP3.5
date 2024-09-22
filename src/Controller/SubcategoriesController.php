<?php
namespace App\Controller;

use App\Controller\AppController;

class SubcategoriesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadModel('Categories');
    }

    public function index()
    {
        $subcategories = $this->Subcategories->find('all', [
            'contain' => ['Categories']
        ]);
        $this->set(compact('subcategories'));
    }

    public function add()
    {
        $subcategory = $this->Subcategories->newEntity();
        if ($this->request->is('post')) {
            $subcategory = $this->Subcategories->patchEntity($subcategory, $this->request->getData());
            if ($this->Subcategories->save($subcategory)) {
                $this->Flash->success(__('The subcategory has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the subcategory.'));
        }
        $categories = $this->Categories->find('list')->toArray();
        $this->set(compact('subcategory', 'categories'));
    }

    public function edit($id = null)
    {
        $subcategory = $this->Subcategories->get($id);
        if ($this->request->is(['post', 'put'])) {
            $this->Subcategories->patchEntity($subcategory, $this->request->getData());
            if ($this->Subcategories->save($subcategory)) {
                $this->Flash->success(__('The subcategory has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update the subcategory.'));
        }
        $categories = $this->Categories->find('list')->toArray();
        $this->set(compact('subcategory', 'categories'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subcategory = $this->Subcategories->get($id);
        if ($this->Subcategories->delete($subcategory)) {
            $this->Flash->success(__('The subcategory has been deleted.'));
        } else {
            $this->Flash->error(__('The subcategory could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
