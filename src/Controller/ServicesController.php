<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Collection\Collection;
use Cake\I18n\Date;
use Cake\I18n\Time;

/**
 * Services Controller
 *
 * @property \App\Model\Table\ServicesTable $Services
 */
class ServicesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bhaktas', 'Departments']
        ];
        $services = $this->paginate($this->Services);

        $this->set(compact('services'));
        $this->set('_serialize', ['services']);
    }

    /**
     * View method
     *
     * @param string|null $id Service id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $service = $this->Services->get($id, [
            'contain' => ['Bhaktas', 'Departments']
        ]);

        $this->set('service', $service);
        $this->set('_serialize', ['service']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $service = $this->Services->newEntity();
        if ($this->request->is('post')) {
            $service = $this->Services->patchEntity($service, $this->request->getData());
            if ($this->Services->save($service)) {
                $this->Flash->success(__('The service has been saved.'));
            }
            $this->Flash->error(__('The service could not be saved. Please, try again.'));
        }

        $bhaktas = $this->Services->Bhaktas->find('list')
            ->where(['Bhaktas.communityrole_id IN' => [1,2]])
            ->innerJoinWith(
                'Services.Departments.Centers',
                function ($q) {
                    return $q->find('accessible', $this->Auth->user());
                }
            );
        $bhaktas = $bhaktas->distinct()
            ->union($this->Services->Bhaktas->find('withoutService')->find('list'))
            ->epilog('ORDER BY Bhaktas__nev_avatott');


        $departments = $this->Services->Departments->find()
            ->contain(
                'Centers',
                function ($q) {
                    return $q->find('accessible', $this->Auth->user());
                }
            )
            ->order(['Departments.name'])
            ->formatResults(
                function ($results) {
                    return $results->combine(
                        'id',
                        function ($row) {
                            return $row->center->name . ' / ' . $row->name;
                        }
                    );
                }
            );

        $this->set(compact('service', 'bhaktas', 'departments'));
        $this->set('_serialize', ['service']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Service id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $service = $this->Services->get($id, [
            'contain' => ['Bhaktas', 'Departments']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $service = $this->Services->patchEntity($service, $this->request->getData());
            if ($this->Services->save($service)) {
                $this->Flash->success(__('The service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The service could not be saved. Please, try again.'));
        }
        $bhaktas = $this->Services->Bhaktas->find('list');
        $departments = $this->Services->Departments->find('list');
        $this->set(compact('service', 'bhaktas', 'departments'));
        $this->set('_serialize', ['service']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Service id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $service = $this->Services->get($id);
        if ($this->Services->delete($service)) {
            $this->Flash->success(__('The service has been deleted.'));
        } else {
            $this->Flash->error(__('The service could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * Add Service by given bhaktaId, and departmentId
     *
     * @return \Cake\Network\Response|null
     */
    public function addByBhaktaAndDepartment()
    {
        $this->request->allowMethod(['post']);
        $bhaktaId = $this->request->getData('bhaktaId');
        $departmentId = $this->request->getData('departmentId');
        $beginServiceDate = new Date($this->request->getData('beginDate'));
        $service = $this->Services->newEntity();
        $service->bhakta_id = $bhaktaId;
        $service->department_id = $departmentId;
        $service->szolgalat_kezdete = $beginServiceDate;
        if ($this->Services->save($service)) {
            $status = 'success';
        } else {
            $status = 'fail';
        }
        $this->set(compact('status'));
        $this->set('_serialize', ['status']);
    }
}
