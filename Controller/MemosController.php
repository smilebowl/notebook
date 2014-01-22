<?php
App::uses('AppController', 'Controller');
/**
 * Memos Controller
 *
 * @property Memo $Memo
 * @property PaginatorComponent $Paginator
 */
class MemosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


	public function ui() {
		$this->Memo->Memocategory->recursive = 0;
		$this->set('memocategories',
			$this->Memo->Memocategory->find('all',array(
//					'order' => 'position'
			))
		);
//		$this->set('memos', $this->Memo->Memocategory->find('all'));
	}

	public function getMemos() {
		Configure::write('debug', 0);
		$this->autoRender = false;
		$this->layout = "ajax";

		$this->Memo->recursive = -1;
		$category = $this->request->data['memocategory_id'];
		$this->set('memos', $this->Memo->find('all', array(
			'conditions' => array('memocategory_id' => $category)
		)));
		$this->set('memocategory_id', $category);
		$this->render('ui_category', 'ajax');
	}

	public function ajax_allpositon() {
		Configure::write('debug', 0);
		$this->autoRender = false;

//		$this->log($this->request->data);

		foreach ($this->request->data['allxyz'] as $item) {
			$this->Memo->save($item);
		}
	}

	// add

	public function ajax_add() {
		Configure::write('debug', 0);
		$this->autoRender = false;
//		$this->layout = "ajax";

		$this->Memo->create();
		$this->Memo->save($this->request->data, false);
		$memo = $this->Memo->read();
		$this->set('memo', $memo);
		$this->render('ui_element', 'ajax');
	}

	// update

	public function ajax_edit() {
		Configure::write('debug', 0);
		$this->autoRender = false;

		$this->Memo->save($this->request->data);
	}


	public function ajax_delete() {
		Configure::write('debug', 0);
		$this->autoRender = false;
		$this->Memo->delete($this->request->data['id']);
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
			if ($this->Memo->Memocategory->exists($id)) {
				$this->Memo->Memocategory->save(array('id'=>$id,'position'=>$curpos++),false,array('position'));
			}
		}
	}



/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Memo->recursive = 0;
		$this->set('memos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Memo->exists($id)) {
			throw new NotFoundException(__('Invalid memo'));
		}
		$options = array('conditions' => array('Memo.' . $this->Memo->primaryKey => $id));
		$this->set('memo', $this->Memo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Memo->create();
			if ($this->Memo->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The memo has been saved.'). "(#{$this->Memo->id})");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The memo could not be saved. Please, try again.'));
			}
		}
		$memocategories = $this->Memo->Memocategory->find('list');
		$this->set(compact('memocategories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Memo->exists($id)) {
			throw new NotFoundException(__('Invalid memo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Memo->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The memo has been saved.') . "(#$id)");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The memo could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Memo.' . $this->Memo->primaryKey => $id));
			$this->request->data = $this->Memo->find('first', $options);
		}
		$memocategories = $this->Memo->Memocategory->find('list');
		$this->set(compact('memocategories'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Memo->id = $id;
		if (!$this->Memo->exists()) {
			throw new NotFoundException(__('Invalid memo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Memo->delete()) {
			$this->Session->setFlashInfo(__('The memo has been deleted.') . "(#$id)");
		} else {
			$this->Session->setFlashError(__('The memo could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
