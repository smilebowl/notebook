<?php
App::uses('AppController', 'Controller');
/**
 * Notecategories Controller
 *
 * @property Notecategory $Notecategory
 * @property PaginatorComponent $Paginator
 */
class NotecategoriesController extends AppController {

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
		$this->Notecategory->recursive = 0;
		$this->set('notecategories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Notecategory->exists($id)) {
			throw new NotFoundException(__('Invalid notecategory'));
		}
		$options = array('conditions' => array('Notecategory.' . $this->Notecategory->primaryKey => $id));
		$this->set('notecategory', $this->Notecategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Notecategory->create();
			if ($this->Notecategory->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The notecategory has been saved.'). "(#{$this->Notecategory->id})");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The notecategory could not be saved. Please, try again.'));
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
		if (!$this->Notecategory->exists($id)) {
			throw new NotFoundException(__('Invalid notecategory'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Notecategory->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The notecategory has been saved.') . "(#$id)");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The notecategory could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Notecategory.' . $this->Notecategory->primaryKey => $id));
			$this->request->data = $this->Notecategory->find('first', $options);
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
		$this->Notecategory->id = $id;
		if (!$this->Notecategory->exists()) {
			throw new NotFoundException(__('Invalid notecategory'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Notecategory->delete()) {
			$this->Session->setFlashInfo(__('The notecategory has been deleted.') . "(#$id)");
		} else {
			$this->Session->setFlashError(__('The notecategory could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
