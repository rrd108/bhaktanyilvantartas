<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Legalstatuses Controller
 *
 * @property \App\Model\Table\LegalstatusesTable $Legalstatuses
 */
class LegalstatusesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $legalstatuses = $this->paginate($this->Legalstatuses);

        $this->set(compact('legalstatuses'));
        $this->set('_serialize', ['legalstatuses']);
    }

    /**
     * View method
     *
     * @param string|null $id Legalstatus id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $legalstatus = $this->Legalstatuses->get($id, [
            'contain' => ['Bhaktas']
        ]);

        $this->set('legalstatus', $legalstatus);
        $this->set('_serialize', ['legalstatus']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $legalstatus = $this->Legalstatuses->newEntity();
        if ($this->request->is('post')) {
            $legalstatus = $this->Legalstatuses->patchEntity($legalstatus, $this->request->getData());
            if ($this->Legalstatuses->save($legalstatus)) {
                $this->Flash->success(__('The legalstatus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The legalstatus could not be saved. Please, try again.'));
        }
        $this->set(compact('legalstatus'));
        $this->set('_serialize', ['legalstatus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Legalstatus id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $legalstatus = $this->Legalstatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $legalstatus = $this->Legalstatuses->patchEntity($legalstatus, $this->request->getData());
            if ($this->Legalstatuses->save($legalstatus)) {
                $this->Flash->success(__('The legalstatus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The legalstatus could not be saved. Please, try again.'));
        }
        $this->set(compact('legalstatus'));
        $this->set('_serialize', ['legalstatus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Legalstatus id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $legalstatus = $this->Legalstatuses->get($id);
        if ($this->Legalstatuses->delete($legalstatus)) {
            $this->Flash->success(__('The legalstatus has been deleted.'));
        } else {
            $this->Flash->error(__('The legalstatus could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
