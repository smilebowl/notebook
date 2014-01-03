<?php
App::uses('AppController', 'Controller');
/**
 * Memocategories Controller
 *
 * @property Memocategory $Memocategory
 * @property PaginatorComponent $Paginator
 */
class MemocategoriesController extends AppController {

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
		$this->Memocategory->recursive = 0;
		$this->set('memocategories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Memocategory->exists($id)) {
			throw new NotFoundException(__('Invalid memocategory'));
		}
		$options = array('conditions' => array('Memocategory.' . $this->Memocategory->primaryKey => $id));
		$this->set('memocategory', $this->Memocategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Memocategory->create();
			if ($this->Memocategory->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The memocategory has been saved.'). "(#{$this->Memocategory->id})");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The memocategory could not be saved. Please, try again.'));
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
		if (!$this->Memocategory->exists($id)) {
			throw new NotFoundException(__('Invalid memocategory'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Memocategory->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The memocategory has been saved.') . "(#$id)");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The memocategory could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Memocategory.' . $this->Memocategory->primaryKey => $id));
			$this->request->data = $this->Memocategory->find('first', $options);
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
		$this->Memocategory->id = $id;
		if (!$this->Memocategory->exists()) {
			throw new NotFoundException(__('Invalid memocategory'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Memocategory->delete()) {
			$this->Session->setFlashInfo(__('The memocategory has been deleted.') . "(#$id)");
		} else {
			$this->Session->setFlashError(__('The memocategory could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
