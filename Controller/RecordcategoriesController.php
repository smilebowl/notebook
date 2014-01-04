<?php
App::uses('AppController', 'Controller');
/**
 * Recordcategories Controller
 *
 * @property Recordcategory $Recordcategory
 * @property PaginatorComponent $Paginator
 */
class RecordcategoriesController extends AppController {

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
		$this->Recordcategory->recursive = 0;
		$this->set('recordcategories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Recordcategory->exists($id)) {
			throw new NotFoundException(__('Invalid recordcategory'));
		}
		$options = array('conditions' => array('Recordcategory.' . $this->Recordcategory->primaryKey => $id));
		$this->set('recordcategory', $this->Recordcategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Recordcategory->create();
			if ($this->Recordcategory->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The recordcategory has been saved.'). "(#{$this->Recordcategory->id})");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The recordcategory could not be saved. Please, try again.'));
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
		if (!$this->Recordcategory->exists($id)) {
			throw new NotFoundException(__('Invalid recordcategory'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Recordcategory->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The recordcategory has been saved.') . "(#$id)");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The recordcategory could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Recordcategory.' . $this->Recordcategory->primaryKey => $id));
			$this->request->data = $this->Recordcategory->find('first', $options);
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
		$this->Recordcategory->id = $id;
		if (!$this->Recordcategory->exists()) {
			throw new NotFoundException(__('Invalid recordcategory'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Recordcategory->delete()) {
			$this->Session->setFlashInfo(__('The recordcategory has been deleted.') . "(#$id)");
		} else {
			$this->Session->setFlashError(__('The recordcategory could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
