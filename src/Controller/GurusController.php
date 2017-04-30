<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Gurus Controller
 *
 * @property \App\Model\Table\GurusTable $Gurus
 */
class GurusController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $gurus = $this->paginate($this->Gurus);

        $this->set(compact('gurus'));
        $this->set('_serialize', ['gurus']);
    }

    /**
     * View method
     *
     * @param string|null $id Gurus id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gurus = $this->Gurus->get($id, [
            'contain' => []
        ]);

        $this->set('gurus', $gurus);
        $this->set('_serialize', ['gurus']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $gurus = $this->Gurus->newEntity();
        if ($this->request->is('post')) {
            $gurus = $this->Gurus->patchEntity($gurus, $this->request->getData());
            if ($this->Gurus->save($gurus)) {
                $this->Flash->success(__('The gurus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gurus could not be saved. Please, try again.'));
        }
        $this->set(compact('gurus'));
        $this->set('_serialize', ['gurus']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Gurus id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $gurus = $this->Gurus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gurus = $this->Gurus->patchEntity($gurus, $this->request->getData());
            if ($this->Gurus->save($gurus)) {
                $this->Flash->success(__('The gurus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gurus could not be saved. Please, try again.'));
        }
        $this->set(compact('gurus'));
        $this->set('_serialize', ['gurus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Gurus id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gurus = $this->Gurus->get($id);
        if ($this->Gurus->delete($gurus)) {
            $this->Flash->success(__('The gurus has been deleted.'));
        } else {
            $this->Flash->error(__('The gurus could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
