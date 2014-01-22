<?php
App::uses('AppController', 'Controller');
/**
 * Records Controller
 *
 * @property Record $Record
 * @property PaginatorComponent $Paginator
 */
class RecordsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	public $helpers = array('Csv');

	public function ui() {
		$this->Record->Recordcategory->recursive = 0;
		$this->set('recordcategories',
			$this->Record->Recordcategory->find('all',array(
//				'order' => 'position'
			))
		);
//		$this->set('records', $this->Record->Recordcategory->find('all'));
	}

	public function download($category_id = null) {
//		Configure::write('debug', 0);
		$this->layout = 'ajax';
		$this->Record->recursive = 0;

//		$category = $this->request->data['recordcategory_id'];
		$records = $this->Record->find('all', array(
			'conditions' => array('recordcategory_id' => $category_id),
			'order' => 'eventdate desc'
		));

		$this->set(compact('records'));
		$this->render('csv', 'ajax');
	}


	public function getRecords() {
		Configure::write('debug', 0);
		$this->autoRender = false;
//		$this->layout = "ajax";

		$this->Record->recursive = -1;
		$category = $this->request->data['recordcategory_id'];
		$this->set('records', $this->Record->find('all', array(
			'conditions' => array('recordcategory_id' => $category),
			'order' => 'eventdate desc'
		)));
		$this->set('recordcategory_id', $category);
		$this->render('ui_category', 'ajax');
	}

	// delete checked items

	public function ajax_deleteitems() {
		Configure::write('debug', 0);
		$this->autoRender = false;
		$items = $this->request->data['items'];
		foreach ($items as $key) {
			$this->Record->delete($key);
		}
	}

	// add

	public function ajax_add() {
		Configure::write('debug', 0);
		$this->autoRender = false;
//		$this->layout = "ajax";

		$this->Record->create();
		$this->Record->save($this->request->data, false);
		$record = $this->Record->read();
		$this->set('record', $record);
		$this->render('ui_element', 'ajax');
	}

	// update

	public function ajax_edit() {
		Configure::write('debug', 0);
		$this->autoRender = false;

		$this->Record->save($this->request->data);
	}

	// update category

	public function ajax_edit_category() {
		Configure::write('debug', 0);
		$this->autoRender = false;

		$this->Record->Recordcategory->save($this->request->data);
	}


	public function ajax_delete() {
		Configure::write('debug', 0);
		$this->autoRender = false;
		$this->layout = "ajax";
		$this->Record->delete($this->request->data['id']);
		echo "1";
	}

	// reorder categories

	public function ajax_reorder() {
		Configure::write('debug', 0);
		$this->autoRender = false;

//		$this->log($this->request->data);

		$pos = $this->request->data['idlist'];
		$curpos = 0;
		foreach ($pos as $seq => $idstring) {

			$id = str_replace('nc-', '', $idstring);
			if ($this->Record->Recordcategory->exists($id)) {
				$this->Record->Recordcategory->save(array('id'=>$id,'position'=>$curpos++),false,array('position'));
			}
		}
	}



/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Record->recursive = 0;
		$this->set('records', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Record->exists($id)) {
			throw new NotFoundException(__('Invalid record'));
		}
		$options = array('conditions' => array('Record.' . $this->Record->primaryKey => $id));
		$this->set('record', $this->Record->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Record->create();
			if ($this->Record->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The record has been saved.'). "(#{$this->Record->id})");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The record could not be saved. Please, try again.'));
			}
		}
		$recordcategories = $this->Record->Recordcategory->find('list');
		$this->set(compact('recordcategories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Record->exists($id)) {
			throw new NotFoundException(__('Invalid record'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Record->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The record has been saved.') . "(#$id)");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The record could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Record.' . $this->Record->primaryKey => $id));
			$this->request->data = $this->Record->find('first', $options);
		}
		$recordcategories = $this->Record->Recordcategory->find('list');
		$this->set(compact('recordcategories'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Record->id = $id;
		if (!$this->Record->exists()) {
			throw new NotFoundException(__('Invalid record'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Record->delete()) {
			$this->Session->setFlashInfo(__('The record has been deleted.') . "(#$id)");
		} else {
			$this->Session->setFlashError(__('The record could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
