<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Communityroles Controller
 *
 * @property \App\Model\Table\CommunityrolesTable $Communityroles
 */
class CommunityrolesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $communityroles = $this->paginate($this->Communityroles);

        $this->set(compact('communityroles'));
        $this->set('_serialize', ['communityroles']);
    }

    /**
     * View method
     *
     * @param string|null $id Communityrole id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $communityrole = $this->Communityroles->get($id, [
            'contain' => ['Bhaktas']
        ]);

        $this->set('communityrole', $communityrole);
        $this->set('_serialize', ['communityrole']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $communityrole = $this->Communityroles->newEntity();
        if ($this->request->is('post')) {
            $communityrole = $this->Communityroles->patchEntity($communityrole, $this->request->getData());
            if ($this->Communityroles->save($communityrole)) {
                $this->Flash->success(__('The communityrole has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The communityrole could not be saved. Please, try again.'));
        }
        $this->set(compact('communityrole'));
        $this->set('_serialize', ['communityrole']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Communityrole id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $communityrole = $this->Communityroles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $communityrole = $this->Communityroles->patchEntity($communityrole, $this->request->getData());
            if ($this->Communityroles->save($communityrole)) {
                $this->Flash->success(__('The communityrole has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The communityrole could not be saved. Please, try again.'));
        }
        $this->set(compact('communityrole'));
        $this->set('_serialize', ['communityrole']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Communityrole id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $communityrole = $this->Communityroles->get($id);
        if ($this->Communityroles->delete($communityrole)) {
            $this->Flash->success(__('The communityrole has been deleted.'));
        } else {
            $this->Flash->error(__('The communityrole could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
