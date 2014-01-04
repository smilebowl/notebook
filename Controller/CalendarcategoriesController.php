<?php
App::uses('AppController', 'Controller');
/**
 * Calendarcategories Controller
 *
 * @property Calendarcategory $Calendarcategory
 * @property PaginatorComponent $Paginator
 */
class CalendarcategoriesController extends AppController {

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
		$this->Calendarcategory->recursive = 0;
		$this->set('calendarcategories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Calendarcategory->exists($id)) {
			throw new NotFoundException(__('Invalid calendarcategory'));
		}
		$options = array('conditions' => array('Calendarcategory.' . $this->Calendarcategory->primaryKey => $id));
		$this->set('calendarcategory', $this->Calendarcategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Calendarcategory->create();
			if ($this->Calendarcategory->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The calendarcategory has been saved.'). "(#{$this->Calendarcategory->id})");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The calendarcategory could not be saved. Please, try again.'));
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
		if (!$this->Calendarcategory->exists($id)) {
			throw new NotFoundException(__('Invalid calendarcategory'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Calendarcategory->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The calendarcategory has been saved.') . "(#$id)");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The calendarcategory could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Calendarcategory.' . $this->Calendarcategory->primaryKey => $id));
			$this->request->data = $this->Calendarcategory->find('first', $options);
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
		$this->Calendarcategory->id = $id;
		if (!$this->Calendarcategory->exists()) {
			throw new NotFoundException(__('Invalid calendarcategory'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Calendarcategory->delete()) {
			$this->Session->setFlashInfo(__('The calendarcategory has been deleted.') . "(#$id)");
		} else {
			$this->Session->setFlashError(__('The calendarcategory could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
