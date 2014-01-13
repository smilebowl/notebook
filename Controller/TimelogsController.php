<?php
App::uses('AppController', 'Controller');
/**
 * Timelogs Controller
 *
 * @property Timelog $Timelog
 * @property PaginatorComponent $Paginator
 */
class TimelogsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


	public function ui() {
//		$this->Timelog->Timelogcategory->recursive = 0;
//		$this->set('timelogcategories',
//			$this->Timelog->Timelogcategory->find('all',array(
//				'order' => 'position'
//			))
//		);
//		$this->set('timelogs', $this->Timelog->Timelogcategory->find('all'));
	}

	public function getTimelogs() {
//		Configure::write('debug', 0);
		$this->autoRender = false;

		$this->Timelog->recursive = -1;
		$workdate = $this->request->data['workdate'];
		$this->set('timelogs', $this->Timelog->find('all', array(
			'conditions' => array('workdate' => $workdate),
		)));
//		$this->set('timelogcategory_id', $category);

		$timelogcategories = $this->Timelog->Timelogcategory->find('list');
		$timelogtasks = $this->Timelog->Timelogtask->find('list');
		$this->set(compact('timelogcategories', 'timelogtasks'));

		$this->render('ui_category', 'ajax');
	}

	// update timelogs

	public function ajax_updateTimelog() {
		Configure::write('debug', 0);
		$this->autoRender = false;

//		$this->log($this->request->data);

		$timelogs = $this->request->data['Timelog'];
		foreach ($timelogs as $timelog) {
			$this->Timelog->save($timelog);
		}
	}

	// new item for js

	public function ajax_getTemplate() {
		Configure::write('debug', 0);
		$this->autoRender = false;

		$timelog = array('Timelog' => array('id'=>null, 'timelogcategory_id'=>null, 'timelogtask_id'=>null,'worktime'=>1.00,'title'=>''));
		$timelogcategories = $this->Timelog->Timelogcategory->find('list');
		$timelogtasks = $this->Timelog->Timelogtask->find('list');
		$this->set(compact('timelog', 'timelogcategories', 'timelogtasks'));
		$this->render('ui_element', 'ajax');
	}








	// delete checked items

	public function ajax_deleteitems() {
		Configure::write('debug', 0);
		$this->autoRender = false;
		$items = $this->request->data['items'];
		foreach ($items as $key) {
			$this->Timelog->delete($key);
		}
	}

	// add

//	public function ajax_add() {
//		Configure::write('debug', 0);
//		$this->autoRender = false;
////		$this->layout = "ajax";
//
//		$this->Timelog->create();
//		$this->Timelog->save($this->request->data, false);
//		$timelog = $this->Timelog->read();
//		$this->set('timelog', $timelog);
//		$this->render('ui_element', 'ajax');
//	}

	// update

	public function ajax_edit() {
		Configure::write('debug', 0);
		$this->autoRender = false;

		$this->Timelog->save($this->request->data);
	}

	// delete item

	public function ajax_delete() {
		Configure::write('debug', 0);
		$this->autoRender = false;
		$this->layout = "ajax";
		$this->Timelog->delete($this->request->data['id']);
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
			if ($this->Timelog->Timelogcategory->exists($id)) {
				$this->Timelog->Timelogcategory->save(array('id'=>$id,'position'=>$curpos++),false,array('position'));
			}
		}
	}





/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Timelog->recursive = 0;
		$this->set('timelogs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Timelog->exists($id)) {
			throw new NotFoundException(__('Invalid timelog'));
		}
		$options = array('conditions' => array('Timelog.' . $this->Timelog->primaryKey => $id));
		$this->set('timelog', $this->Timelog->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Timelog->create();
			if ($this->Timelog->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The timelog has been saved.'). "(#{$this->Timelog->id})");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The timelog could not be saved. Please, try again.'));
			}
		}
		$timelogcategories = $this->Timelog->Timelogcategory->find('list');
		$timelogtasks = $this->Timelog->Timelogtask->find('list');
		$this->set(compact('timelogcategories', 'timelogtasks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Timelog->exists($id)) {
			throw new NotFoundException(__('Invalid timelog'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Timelog->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The timelog has been saved.') . "(#$id)");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The timelog could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Timelog.' . $this->Timelog->primaryKey => $id));
			$this->request->data = $this->Timelog->find('first', $options);
		}
		$timelogcategories = $this->Timelog->Timelogcategory->find('list');
		$timelogtasks = $this->Timelog->Timelogtask->find('list');
		$this->set(compact('timelogcategories', 'timelogtasks'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Timelog->id = $id;
		if (!$this->Timelog->exists()) {
			throw new NotFoundException(__('Invalid timelog'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Timelog->delete()) {
			$this->Session->setFlashInfo(__('The timelog has been deleted.') . "(#$id)");
		} else {
			$this->Session->setFlashError(__('The timelog could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
