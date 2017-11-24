<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * Bhaktas Controller
 *
 * @property \App\Model\Table\BhaktasTable $Bhaktas
 */
class BhaktasController extends AppController
{

    public $paginate = [
        'order' => [
            'Bhaktas.nev_avatott' => 'asc'
        ]
    ];

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent(
            'Search.Prg',
            ['actions' => ['index']]
        );
        $this->loadComponent('RequestHandler');
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $bhaktas = $this->Bhaktas->find('search', ['search' => $this->request->getQuery()]);
        if (!$this->request->getQuery('q')) {
            $bhaktas->where(['Bhaktas.communityrole_id IN' => [1, 2]]);
        }
        $bhaktas = $this->paginate($bhaktas);

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
            'contain' => [
                'Gurus',
                'Tbs',
                'Legalstatuses',
                'Asrams',
                'Communityroles',
                'Services' => [
                    'sort' => ['Services.szolgalat_kezdete']
                ],
                'Services.Departments'
            ]
        ]);

        $this->set('bhakta', $bhakta);
        $this->set('_serialize', ['bhakta']);

        //debug($bhakta);

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
        $asrams = $this->Bhaktas->Asrams->find('list', ['limit' => 200]);
        $gurus = $this->Bhaktas->Gurus->find('list', ['limit' => 200]);
        $tbs = $this->Bhaktas->Tbs->find('list', ['limit' => 200]);
        $hazastars = $this->Bhaktas->Hazastars->find('list', ['limit' => 200]);
        $legalstatuses = $this->Bhaktas->Legalstatuses->find('list', ['limit' => 200]);
        $communityroles = $this->Bhaktas->Communityroles->find('list', ['limit' => 200]);
        $this->set(
            compact('bhakta', 'asrams', 'gurus', 'hazastars', 'tbs', 'legalstatuses', 'communityroles')
        );
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
            'contain' => [
                'Gurus',
                'Tbs',
                'Legalstatuses',
                'Asrams',
                'Communityroles',
            ]
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
        $tbs = $this->Bhaktas->Tbs->find('list', ['limit' => 200]);
        $legalstatuses = $this->Bhaktas->Legalstatuses->find('list', ['limit' => 200]);
        $asrams = $this->Bhaktas->Asrams->find('list', ['limit' => 200]);
        $communityroles = $this->Bhaktas->Communityroles->find('list', ['limit' => 200]);
        //$hazastars = $this->Bhaktas->Hazastars->find('list', ['limit' => 200]);

        $this->set(compact('bhakta', 'gurus', 'tbs', 'legalstatuses', 'asrams', 'communityroles'));
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

    public function endVolunteer(int $bhakta_id = null)
    {
        $this->request->allowMethod(['post']);
        $year = $this->request->getData('year');
        $month = $this->request->getData('month');
        $day = $this->request->getData('day');
        $bhakta = $this->Bhaktas->get($bhakta_id);
        $service = $this->Bhaktas->Services->find('lastBeginedServiceByBhakta',
            ['bhakta_id' => $bhakta_id])->where(['Services.bhakta_id = ' => $bhakta_id])->first();
        $service = $this->Bhaktas->Services->get($service->service_id);
        $bhakta->communityrole_id = 4;
        $bhakta->legalstatus_id = null;
        $service->szolgalat_vege = $year . '-' . $month . '-' . $day;
        $bhakta->services = [$service];
        if ($this->Bhaktas->save($bhakta)) {
            $status = array('status' => 'success');
        } else {
            $status = array('status' => 'fail');
        }
        $response = json_encode($status);
        return $this->response->withStringBody($response);
    }

    public function eucard()
    {
        $bhaktas = $this->Bhaktas->find('EuCardExpired')->select([
            'Bhaktas.id',
            'Bhaktas.nev_avatott',
            'Bhaktas.eu_card_expiry'
        ])->order(['Bhaktas.eu_card_expiry' => 'DESC']);
        $bhaktas = $this->paginate($bhaktas, ['limit' => 10]);
        $this->set('bhaktas', $bhaktas);
        $this->set('_serialize', ['bhaktas']);

    }
}
