<?php
App::uses('AppController', 'Controller');
/**
 * Notes Controller
 *
 * @property Note $Note
 * @property PaginatorComponent $Paginator
 */
class NotesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function ui() {
		$this->Note->Notecategory->recursive = 0;
		$this->set('notecategories',
			$this->Note->Notecategory->find('all',array(
					'order' => 'position'
			))
		);
//		$this->set('notes', $this->Note->Notecategory->find('all'));
	}

	public function getNotes() {
		Configure::write('debug', 0);
		$this->autoRender = false;
		$this->layout = "ajax";

		$this->Note->recursive = -1;
		$category = $this->request->data['notecategory_id'];
		$this->set('notes', $this->Note->find('all', array(
			'conditions' => array('notecategory_id' => $category)
		)));
		$this->set('notecategory_id', $category);
		$this->render('ui_category', 'ajax');
	}

	public function ajax_allpositon() {
		Configure::write('debug', 0);
		$this->autoRender = false;

//		$this->log($this->request->data);

		foreach ($this->request->data['allxyz'] as $item) {
			$this->Note->save($item);
		}
	}

	// add

	public function ajax_add() {
		Configure::write('debug', 0);
		$this->autoRender = false;
//		$this->layout = "ajax";

		$this->Note->create();
		$this->Note->save($this->request->data, false);
		$note = $this->Note->read();
		$this->set('note', $note);
		$this->render('ui_element', 'ajax');
	}

	// update

	public function ajax_edit() {
		Configure::write('debug', 0);
		$this->autoRender = false;

		$this->Note->save($this->request->data);
	}


	public function ajax_delete() {
		Configure::write('debug', 0);
		$this->autoRender = false;
		$this->layout = "ajax";
		$this->Note->delete($this->request->data['id']);
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
			if ($this->Note->Notecategory->exists($id)) {
				$this->Note->Notecategory->save(array('id'=>$id,'position'=>$curpos++),false,array('position'));
			}
		}
	}



/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Note->recursive = 0;
		$this->set('notes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Note->exists($id)) {
			throw new NotFoundException(__('Invalid note'));
		}
		$options = array('conditions' => array('Note.' . $this->Note->primaryKey => $id));
		$this->set('note', $this->Note->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Note->create();
			if ($this->Note->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The note has been saved.'). "(#{$this->Note->id})");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The note could not be saved. Please, try again.'));
			}
		}
		$notecategories = $this->Note->Notecategory->find('list');
		$this->set(compact('notecategories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Note->exists($id)) {
			throw new NotFoundException(__('Invalid note'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Note->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The note has been saved.') . "(#$id)");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The note could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Note.' . $this->Note->primaryKey => $id));
			$this->request->data = $this->Note->find('first', $options);
		}
		$notecategories = $this->Note->Notecategory->find('list');
		$this->set(compact('notecategories'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Note->id = $id;
		if (!$this->Note->exists()) {
			throw new NotFoundException(__('Invalid note'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Note->delete()) {
			$this->Session->setFlashInfo(__('The note has been deleted.') . "(#$id)");
		} else {
			$this->Session->setFlashError(__('The note could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
