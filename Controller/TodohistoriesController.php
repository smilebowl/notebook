<?php
App::uses('AppController', 'Controller');
/**
 * Todohistories Controller
 *
 * @property Todohistory $Todohistory
 * @property PaginatorComponent $Paginator
 */
class TodohistoriesController extends AppController {

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
		$this->Todohistory->recursive = 0;
		$this->set('todohistories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Todohistory->exists($id)) {
			throw new NotFoundException(__('Invalid todohistory'));
		}
		$options = array('conditions' => array('Todohistory.' . $this->Todohistory->primaryKey => $id));
		$this->set('todohistory', $this->Todohistory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Todohistory->create();
			if ($this->Todohistory->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The todohistory has been saved.'). "(#{$this->Todohistory->id})");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The todohistory could not be saved. Please, try again.'));
			}
		}
		$todocategories = $this->Todohistory->Todocategory->find('list');
		$this->set(compact('todocategories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Todohistory->exists($id)) {
			throw new NotFoundException(__('Invalid todohistory'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Todohistory->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The todohistory has been saved.') . "(#$id)");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The todohistory could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Todohistory.' . $this->Todohistory->primaryKey => $id));
			$this->request->data = $this->Todohistory->find('first', $options);
		}
		$todocategories = $this->Todohistory->Todocategory->find('list');
		$this->set(compact('todocategories'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Todohistory->id = $id;
		if (!$this->Todohistory->exists()) {
			throw new NotFoundException(__('Invalid todohistory'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Todohistory->delete()) {
			$this->Session->setFlashInfo(__('The todohistory has been deleted.') . "(#$id)");
		} else {
			$this->Session->setFlashError(__('The todohistory could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
