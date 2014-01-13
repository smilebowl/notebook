<?php
App::uses('AppController', 'Controller');
/**
 * Timelogtasks Controller
 *
 * @property Timelogtask $Timelogtask
 * @property PaginatorComponent $Paginator
 */
class TimelogtasksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Timelogtask->recursive = 0;
		$this->set('timelogtasks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Timelogtask->exists($id)) {
			throw new NotFoundException(__('Invalid timelogtask'));
		}
		$options = array('conditions' => array('Timelogtask.' . $this->Timelogtask->primaryKey => $id));
		$this->set('timelogtask', $this->Timelogtask->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Timelogtask->create();
			if ($this->Timelogtask->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The timelogtask has been saved.'). "(#{$this->Timelogtask->id})");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The timelogtask could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Timelogtask->exists($id)) {
			throw new NotFoundException(__('Invalid timelogtask'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Timelogtask->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The timelogtask has been saved.') . "(#$id)");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The timelogtask could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Timelogtask.' . $this->Timelogtask->primaryKey => $id));
			$this->request->data = $this->Timelogtask->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Timelogtask->id = $id;
		if (!$this->Timelogtask->exists()) {
			throw new NotFoundException(__('Invalid timelogtask'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Timelogtask->delete()) {
			$this->Session->setFlashInfo(__('The timelogtask has been deleted.') . "(#$id)");
		} else {
			$this->Session->setFlashError(__('The timelogtask could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
