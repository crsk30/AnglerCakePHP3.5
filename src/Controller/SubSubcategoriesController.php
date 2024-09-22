<?php
namespace App\Controller;

use App\Controller\AppController;

class SubSubcategoriesController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadModel('Subcategories');
    }

    public function index()
    {
        $subSubcategories = $this->SubSubcategories->find('all', [
            'contain' => ['Subcategories']
        ]);
        $this->set(compact('subSubcategories'));
    }

    public function add()
    {
        $subSubcategory = $this->SubSubcategories->newEntity();
        if ($this->request->is('post')) {
            $subSubcategory = $this->SubSubcategories->patchEntity($subSubcategory, $this->request->getData());
            if ($this->SubSubcategories->save($subSubcategory)) {
                $this->Flash->success(__('The sub-subcategory has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the sub-subcategory.'));
        }
        $subcategories = $this->Subcategories->find('list')->toArray();
        $this->set(compact('subSubcategory', 'subcategories'));
    }

    public function edit($id = null)
    {
        $subSubcategory = $this->SubSubcategories->get($id);
        if ($this->request->is(['post', 'put'])) {
            $this->SubSubcategories->patchEntity($subSubcategory, $this->request->getData());
            if ($this->SubSubcategories->save($subSubcategory)) {
                $this->Flash->success(__('The sub-subcategory has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update the sub-subcategory.'));
        }
        $subcategories = $this->Subcategories->find('list')->toArray();
        $this->set(compact('subSubcategory', 'subcategories'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subSubcategory = $this->SubSubcategories->get($id);
        if ($this->SubSubcategories->delete($subSubcategory)) {
            $this->Flash->success(__('The sub-subcategory has been deleted.'));
        } else {
            $this->Flash->error(__('The sub-subcategory could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
