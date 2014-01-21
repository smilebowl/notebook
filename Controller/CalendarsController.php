<?php
App::uses('AppController', 'Controller');
/**
 * Calendars Controller
 *
 * @property Calendar $Calendar
 * @property PaginatorComponent $Paginator
 */
class CalendarsController extends AppController {

	public $components = array('Paginator', 'Search.Prg');
	public $presetVars = true;
	public $uses = array('Calendar', 'Holiday');


	public function ui() {
		$this->Calendar->Calendarcategory->recursive = 0;
		$this->set('calendarcategories',
			$this->Calendar->Calendarcategory->find('all',array(
					'order' => 'position'
			))
		);
	}

	// fullcalendar loading query(json)
	public function ajax_loadevent() {

		Configure::write('debug', 0);
		$this->autoRender = false;
		$this->layout = 'ajax';

		$start = date("Y-m-d",$this->request->query['start']);
		$end = date("Y-m-d",$this->request->query['end']);
		$cond = array('and'=>array('start >='=>$start, 'start <='=>$end));

		if (!empty($this->request->query['calendarcategory_id'])) {
			$cond['and']['calendarcategory_id'] =$this->request->query['calendarcategory_id'];
		}

		$this->Calendar->recursive = 0;
		$events = $this->Calendar->find('all', array(
			'conditions' => $cond,
			'order' => 'start'
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

	public function ajax_newevent() {
		Configure::write('debug', 0);
		$this->autoRender = false;
		$this->layout = 'ajax';

		$this->Calendar->save($this->request->data);
		echo $this->Calendar->id;
	}

	// update event

	public function ajax_update() {
		Configure::write('debug', 0);
		$this->autoRender = false;

		$this->Calendar->save($this->request->data);
	}

	// get json

	public function ajax_getrecord() {
		Configure::write('debug', 0);
		$this->autoRender = false;
		$this->layout = 'ajax';

		$this->Calendar->id = $this->request->data['id'];
		$data = $this->Calendar->read();
		echo json_encode($data['Calendar']);
	}

	// remove event

	public function ajax_delete($id = null) {
		Configure::write('debug', 0);
		$this->autoRender = false;

		$this->Calendar->delete($id);
	}

	// event ui

//	public function eventui($calendarid=null) {
//		$calendars = $this->Calendar->Calendar->find('list',array('order'=>'position'));
//		$this->set(compact('calendars'));
//	}

	public function ajax_reorder() {
		Configure::write('debug', 0);
		$this->autoRender = false;

//		$this->log($this->request->data['idlist']);
		$pos = $this->request->data['idlist'];
		$curpos = 0;
		foreach ($pos as $seq => $idstring) {

			$id = str_replace('cal-', '', $idstring);
			if ($this->Calendar->Calendarcategory->exists($id)) {
				$this->Calendar->Calendarcategory->save(array('id'=>$id,'position'=>$curpos++),false,array('position'));
			}
		}
	}


	/////////////////////////// holiday

	public function ajax_holidays() {

		Configure::write('debug', 0);
		$this->autoRender = false;
		$this->layout = 'ajax';

		$start = date("Y-m-d",$this->request->query['start']);
		$end = date("Y-m-d",$this->request->query['end']);
		$cond = array('and'=>array('day >='=>$start, 'day <='=>$end));

		$this->Holiday->recursive = 0;
		$holidays = $this->Holiday->find('all', array(
			'conditions' => $cond,
			'order' => 'day'
		));

		// return json

		$json = array();
		foreach ($holidays as $holiday) {
			settype($holiday['Holiday']['id'], 'integer');
			$json[] = array(
				'id' => $holiday['Holiday']['id'],
				'title' => $holiday['Holiday']['name'],
				'start' => $holiday['Holiday']['day'],
			);
		}
		echo json_encode($json);
	}




/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Prg->commonProcess();
		$this->Paginator->settings['conditions'] = $this->Calendar->parseCriteria($this->Prg->parsedParams());

		$this->Calendar->recursive = 0;
		$this->set('calendars', $this->Paginator->paginate());

		$calendarcategories = $this->Calendar->Calendarcategory->find('list');
		$this->set(compact('calendarcategories'));
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
