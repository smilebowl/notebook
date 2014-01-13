<?php
App::uses('AppController', 'Controller');
/**
 * Timelogcategories Controller
 *
 * @property Timelogcategory $Timelogcategory
 * @property PaginatorComponent $Paginator
 */
class TimelogcategoriesController extends AppController {

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
		$this->Timelogcategory->recursive = 0;
		$this->set('timelogcategories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Timelogcategory->exists($id)) {
			throw new NotFoundException(__('Invalid timelogcategory'));
		}
		$options = array('conditions' => array('Timelogcategory.' . $this->Timelogcategory->primaryKey => $id));
		$this->set('timelogcategory', $this->Timelogcategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Timelogcategory->create();
			if ($this->Timelogcategory->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The timelogcategory has been saved.'). "(#{$this->Timelogcategory->id})");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The timelogcategory could not be saved. Please, try again.'));
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
		if (!$this->Timelogcategory->exists($id)) {
			throw new NotFoundException(__('Invalid timelogcategory'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Timelogcategory->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The timelogcategory has been saved.') . "(#$id)");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The timelogcategory could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Timelogcategory.' . $this->Timelogcategory->primaryKey => $id));
			$this->request->data = $this->Timelogcategory->find('first', $options);
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
		$this->Timelogcategory->id = $id;
		if (!$this->Timelogcategory->exists()) {
			throw new NotFoundException(__('Invalid timelogcategory'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Timelogcategory->delete()) {
			$this->Session->setFlashInfo(__('The timelogcategory has been deleted.') . "(#$id)");
		} else {
			$this->Session->setFlashError(__('The timelogcategory could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
