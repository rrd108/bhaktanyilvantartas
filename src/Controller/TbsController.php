<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tbs Controller
 *
 * @property \App\Model\Table\TbsTable $Tbs
 */
class TbsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $tbs = $this->paginate($this->Tbs);

        $this->set(compact('tbs'));
        $this->set('_serialize', ['tbs']);
    }

    /**
     * View method
     *
     * @param string|null $id Tb id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tb = $this->Tbs->get($id, [
            'contain' => ['Bhaktas']
        ]);

        $this->set('tb', $tb);
        $this->set('_serialize', ['tb']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tb = $this->Tbs->newEntity();
        if ($this->request->is('post')) {
            $tb = $this->Tbs->patchEntity($tb, $this->request->getData());
            if ($this->Tbs->save($tb)) {
                $this->Flash->success(__('The tb has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb could not be saved. Please, try again.'));
        }
        $this->set(compact('tb'));
        $this->set('_serialize', ['tb']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Tb id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tb = $this->Tbs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tb = $this->Tbs->patchEntity($tb, $this->request->getData());
            if ($this->Tbs->save($tb)) {
                $this->Flash->success(__('The tb has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tb could not be saved. Please, try again.'));
        }
        $this->set(compact('tb'));
        $this->set('_serialize', ['tb']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Tb id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tb = $this->Tbs->get($id);
        if ($this->Tbs->delete($tb)) {
            $this->Flash->success(__('The tb has been deleted.'));
        } else {
            $this->Flash->error(__('The tb could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
