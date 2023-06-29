<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Departments Controller
 *
 * @property \App\Model\Table\DepartmentsTable $Departments
 *
 * @method \App\Model\Entity\Department[] paginate($object = null, array $settings = [])
 */
class DepartmentsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow('bhaktaList');
    }

    public $paginate = [
        'order' => ['Departments.name' => 'asc'],
    ];

    public function bhaktaList($date = null)
    {
        $departments = $this->Departments
            ->find('members', ['date' => $date])
            ->find('inCenter', ['centerId' => 1])
            ->formatResults(
                function (\Cake\Collection\CollectionInterface $results) {
                    return $results->map(
                        function ($department) {
                            $department->department = $department->name;
                            $department->bhaktas = collection($department->services)->map(
                                function ($service) {
                                    return $service->bhakta->nev_avatott;
                                }
                            );
                            unset($department->services, $department->id, $department->name);
                            return $department;
                        }
                    )->filter(function ($department) {
                        return $department->bhaktas->count();
                    });
                }
            )->toList();

        $this->set(compact('departments'));
        $this->set('_serialize', ['departments']);
    }

    public function members($date = null)
    {
        $departments = $this->Departments
            ->find(
                'members',
                ['date' => $date]
            )
            ->innerJoinWith(                //TODO should be findAccessible here but causing SQL error
                'Centers.AppUsers',
                function ($q) {
                    return $q->where(['AppUsers.id' => $this->Auth->user('id')]);
                }
            )
            ->formatResults(
                function (\Cake\Collection\CollectionInterface $results) {
                    return $results->map(
                        function ($row) {
                            $row['manpower'] = count($row->services);
                            return $row;
                        }
                    );
                }
            )
            ->sortBy('manpower');

        $this->set(compact('departments'));
        $this->set('_serialize', ['departments']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Centers']
        ];
        $departments = $this->paginate(
            $this->Departments->find(
                'inCenter',
                [
                    'centerId' => $this->Departments->Centers->find(
                        'accessible',
                        $this->Auth->user()
                    )->select('Centers.id')
                ]
            )
        );

        $this->set(compact('departments'));
        $this->set('_serialize', ['departments']);
    }

    /**
     * View method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => ['Centers', 'Services']
        ]);

        $this->set('department', $department);
        $this->set('_serialize', ['department']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $department = $this->Departments->newEntity();
        if ($this->request->is('post')) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
            if ($this->Departments->save($department)) {
                $this->Flash->success(__('The department has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department could not be saved. Please, try again.'));
        }
        $centers = $this->Departments->Centers->find('list', ['limit' => 200]);
        $this->set(compact('department', 'centers'));
        $this->set('_serialize', ['department']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $department = $this->Departments->patchEntity($department, $this->request->getData());
            if ($this->Departments->save($department)) {
                $this->Flash->success(__('The department has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The department could not be saved. Please, try again.'));
        }
        $centers = $this->Departments->Centers->find('list', ['limit' => 200]);
        $this->set(compact('department', 'centers'));
        $this->set('_serialize', ['department']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Department id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $department = $this->Departments->get($id);
        if ($this->Departments->delete($department)) {
            $this->Flash->success(__('The department has been deleted.'));
        } else {
            $this->Flash->error(__('The department could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
