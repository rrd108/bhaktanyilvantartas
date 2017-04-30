<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bhaktas Controller
 *
 * @property \App\Model\Table\BhaktasTable $Bhaktas
 */
class BhaktasController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Gurus', 'Hazastars']
        ];
        $bhaktas = $this->paginate($this->Bhaktas);

        $this->set(compact('bhaktas'));
        $this->set('_serialize', ['bhaktas']);
    }

    /**
     * View method
     *
     * @param string|null $id Bhakta id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bhakta = $this->Bhaktas->get($id, [
            'contain' => ['Gurus', 'Hazastars', 'Services']
        ]);

        $this->set('bhakta', $bhakta);
        $this->set('_serialize', ['bhakta']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bhakta = $this->Bhaktas->newEntity();
        if ($this->request->is('post')) {
            $bhakta = $this->Bhaktas->patchEntity($bhakta, $this->request->getData());
            if ($this->Bhaktas->save($bhakta)) {
                $this->Flash->success(__('The bhakta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bhakta could not be saved. Please, try again.'));
        }
        $gurus = $this->Bhaktas->Gurus->find('list', ['limit' => 200]);
        $hazastars = $this->Bhaktas->Hazastars->find('list', ['limit' => 200]);
        $this->set(compact('bhakta', 'gurus', 'hazastars'));
        $this->set('_serialize', ['bhakta']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Bhakta id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bhakta = $this->Bhaktas->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bhakta = $this->Bhaktas->patchEntity($bhakta, $this->request->getData());
            if ($this->Bhaktas->save($bhakta)) {
                $this->Flash->success(__('The bhakta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bhakta could not be saved. Please, try again.'));
        }
        $gurus = $this->Bhaktas->Gurus->find('list', ['limit' => 200]);
        $hazastars = $this->Bhaktas->Hazastars->find('list', ['limit' => 200]);
        $this->set(compact('bhakta', 'gurus', 'hazastars'));
        $this->set('_serialize', ['bhakta']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Bhakta id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bhakta = $this->Bhaktas->get($id);
        if ($this->Bhaktas->delete($bhakta)) {
            $this->Flash->success(__('The bhakta has been deleted.'));
        } else {
            $this->Flash->error(__('The bhakta could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
