<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Centers Controller
 *
 * @property \App\Model\Table\CentersTable $Centers
 *
 * @method \App\Model\Entity\Center[] paginate($object = null, array $settings = [])
 */
class CentersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $centers = $this->paginate($this->Centers);

        $this->set(compact('centers'));
        $this->set('_serialize', ['centers']);
    }

    /**
     * View method
     *
     * @param string|null $id Center id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $center = $this->Centers->get($id, [
            'contain' => ['Users', 'Departments']
        ]);

        $this->set('center', $center);
        $this->set('_serialize', ['center']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $center = $this->Centers->newEntity();
        if ($this->request->is('post')) {
            $center = $this->Centers->patchEntity($center, $this->request->getData());
            if ($this->Centers->save($center)) {
                $this->Flash->success(__('The center has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The center could not be saved. Please, try again.'));
        }
        $users = $this->Centers->Users->find('list', ['limit' => 200]);
        $this->set(compact('center', 'users'));
        $this->set('_serialize', ['center']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Center id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $center = $this->Centers->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $center = $this->Centers->patchEntity($center, $this->request->getData());
            if ($this->Centers->save($center)) {
                $this->Flash->success(__('The center has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The center could not be saved. Please, try again.'));
        }
        $users = $this->Centers->Users->find('list', ['limit' => 200]);
        $this->set(compact('center', 'users'));
        $this->set('_serialize', ['center']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Center id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $center = $this->Centers->get($id);
        if ($this->Centers->delete($center)) {
            $this->Flash->success(__('The center has been deleted.'));
        } else {
            $this->Flash->error(__('The center could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
