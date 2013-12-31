<?php
App::uses('AppController', 'Controller');
/**
 * Todocategories Controller
 *
 * @property Todocategory $Todocategory
 * @property PaginatorComponent $Paginator
 */
class TodocategoriesController extends AppController {

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
		$this->Todocategory->recursive = 0;
		$this->set('todocategories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Todocategory->exists($id)) {
			throw new NotFoundException(__('Invalid todocategory'));
		}
		$options = array('conditions' => array('Todocategory.' . $this->Todocategory->primaryKey => $id));
		$this->set('todocategory', $this->Todocategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Todocategory->create();
			if ($this->Todocategory->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The todocategory has been saved.'). "(#{$this->Todocategory->id})");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The todocategory could not be saved. Please, try again.'));
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
		if (!$this->Todocategory->exists($id)) {
			throw new NotFoundException(__('Invalid todocategory'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Todocategory->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The todocategory has been saved.') . "(#$id)");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The todocategory could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Todocategory.' . $this->Todocategory->primaryKey => $id));
			$this->request->data = $this->Todocategory->find('first', $options);
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
		$this->Todocategory->id = $id;
		if (!$this->Todocategory->exists()) {
			throw new NotFoundException(__('Invalid todocategory'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Todocategory->delete()) {
			$this->Session->setFlashInfo(__('The todocategory has been deleted.') . "(#$id)");
		} else {
			$this->Session->setFlashError(__('The todocategory could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
