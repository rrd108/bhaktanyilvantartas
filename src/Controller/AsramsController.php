<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Asrams Controller
 *
 * @property \App\Model\Table\AsramsTable $Asrams
 */
class AsramsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $asrams = $this->paginate($this->Asrams);

        $this->set(compact('asrams'));
        $this->set('_serialize', ['asrams']);
    }

    /**
     * View method
     *
     * @param string|null $id Asram id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $asram = $this->Asrams->get($id, [
            'contain' => ['Bhaktas']
        ]);

        $this->set('asram_id', $asram);
        $this->set('_serialize', ['asram_id']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $asram = $this->Asrams->newEntity();
        if ($this->request->is('post')) {
            $asram = $this->Asrams->patchEntity($asram, $this->request->getData());
            if ($this->Asrams->save($asram)) {
                $this->Flash->success(__('The asram has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asram could not be saved. Please, try again.'));
        }
        $this->set(compact('asram_id'));
        $this->set('_serialize', ['asram_id']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Asram id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $asram = $this->Asrams->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $asram = $this->Asrams->patchEntity($asram, $this->request->getData());
            if ($this->Asrams->save($asram)) {
                $this->Flash->success(__('The asram has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The asram could not be saved. Please, try again.'));
        }
        $this->set(compact('asram_id'));
        $this->set('_serialize', ['asram_id']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Asram id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $asram = $this->Asrams->get($id);
        if ($this->Asrams->delete($asram)) {
            $this->Flash->success(__('The asram has been deleted.'));
        } else {
            $this->Flash->error(__('The asram could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
