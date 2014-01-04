<?php
App::uses('AppController', 'Controller');
/**
 * Calendars Controller
 *
 * @property Calendar $Calendar
 * @property PaginatorComponent $Paginator
 */
class CalendarsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


	public function ui() {
		$this->Calendar->Calendarcategory->recursive = 0;
		$this->set('calendarcategories',
			$this->Calendar->Calendarcategory->find('all',array(
					'order' => 'position'
			))
		);
//		$this->set('calendars', $this->Calendar->Calendarcategory->find('all'));
	}

	// fullcalendar loading query(json)
	public function ajaxloadevent() {

		Configure::write('debug', 0);
		$this->autoRender = false;
		$this->layout = 'ajax';

		$start = date("Y-m-d",$this->request->query['start']);
		$end = date("Y-m-d",$this->request->query['end']);
		$cond = array('and'=>array('start >='=>$start, 'start <='=>$end));

		if (!empty($this->request->query['calendar_id'])) {
			$cond['and']['calendar_id'] =$this->request->query['calendar_id'];
		}

		$this->Calendar->recursive = 0;
		$events = $this->Calendar->find('all', array(
			'conditions'=>$cond,
		));

		// return json

		$json = array();
		foreach ($events as $evt) {
			settype($evt['Calendar']['id'], 'integer');
			$json[] = $evt['Calendar'];
		}
		echo json_encode($json);
	}

	// new event

	public function ajaxnewevent() {
		Configure::write('debug', 0);
		$this->autoRender = false;
		$this->layout = 'ajax';

		$this->Calendar->save($this->request->data);
		echo $this->Calendar->id;
	}

	// update event

	public function ajaxupdate() {
		Configure::write('debug', 0);
		$this->autoRender = false;

		$this->Calendar->save($this->request->data);
	}

	// get json

	public function ajaxgetrecord() {
		Configure::write('debug', 0);
		$this->autoRender = false;
		$this->layout = 'ajax';

		$this->Calendar->id = $this->request->data['id'];
		$data = $this->Calendar->read();
		echo json_encode($data['Calendar']);
	}

	// get detail field

	public function ajaxgetdetail() {
		Configure::write('debug', 0);
		$this->autoRender = false;

		$this->Calendar->id = $this->request->data['id'];
		echo $this->Calendar->field('detail');
	}

	// get calendar_id field

	public function ajaxgetcid() {
		Configure::write('debug', 0);
		$this->autoRender = false;

		$this->Calendar->id = $this->request->data['id'];
		echo $this->Calendar->field('calendar_id');
	}

	// remove event

	public function ajaxdelete($id = null) {
		Configure::write('debug', 0);
		$this->autoRender = false;

		$this->Calendar->delete($id);
	}

	// event ui

	public function eventui($calendarid=null) {
		$calendars = $this->Calendar->Calendar->find('list',array('order'=>'position'));
		$this->set(compact('calendars'));
	}





/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Calendar->recursive = 0;
		$this->set('calendars', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Calendar->exists($id)) {
			throw new NotFoundException(__('Invalid calendar'));
		}
		$options = array('conditions' => array('Calendar.' . $this->Calendar->primaryKey => $id));
		$this->set('calendar', $this->Calendar->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Calendar->create();
			if ($this->Calendar->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The calendar has been saved.'). "(#{$this->Calendar->id})");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The calendar could not be saved. Please, try again.'));
			}
		}
		$calendarcategories = $this->Calendar->Calendarcategory->find('list');
		$this->set(compact('calendarcategories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Calendar->exists($id)) {
			throw new NotFoundException(__('Invalid calendar'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Calendar->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The calendar has been saved.') . "(#$id)");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The calendar could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Calendar.' . $this->Calendar->primaryKey => $id));
			$this->request->data = $this->Calendar->find('first', $options);
		}
		$calendarcategories = $this->Calendar->Calendarcategory->find('list');
		$this->set(compact('calendarcategories'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Calendar->id = $id;
		if (!$this->Calendar->exists()) {
			throw new NotFoundException(__('Invalid calendar'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Calendar->delete()) {
			$this->Session->setFlashInfo(__('The calendar has been deleted.') . "(#$id)");
		} else {
			$this->Session->setFlashError(__('The calendar could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
