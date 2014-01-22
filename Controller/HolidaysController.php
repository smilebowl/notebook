<?php
App::uses('AppController', 'Controller');
/**
 * Holidays Controller
 *
 * @property Holiday $Holiday
 * @property PaginatorComponent $Paginator
 */
class HolidaysController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


	// 2年分の祝日を更新
	public function update() {
		$year = date('Y') - 1;
		$holidays = $this->getHolidayes($year++);
		$holidays2 = $this->getHolidayes($year++);
		$holidays = array_merge($holidays, $holidays2);
		$holidays2 = $this->getHolidayes($year++);
		$holidays = array_merge($holidays, $holidays2);
		$holidays2 = $this->getHolidayes($year++);
		$holidays = array_merge($holidays, $holidays2);
		$holidays2 = $this->getHolidayes($year++);
		$holidays = array_merge($holidays, $holidays2);
//		debug($holidays);
		$this->Holiday->query('truncate table holidays');
		foreach ($holidays as $date => $name) {
			$this->Holiday->create();
			$this->Holiday->save(array('name'=>$name, 'day'=>$date));
		}
		$this->Session->setFlashInfo(__('The holiday has been saved.'));
		return $this->redirect(array('action' => 'index'));
	}

	private function getHolidayes($year) {
		$start_day = "$year-01-01";
		$end_day = "$year-12-31";
//		$end_day = date('Y-12-31', strtotime('1 year'));	// 翌年末

		$holidays_url = sprintf(
			'http://www.google.com/calendar/feeds/%s/public/full-noattendees?start-min=%s&start-max=%s&max-results=%d&alt=json' ,
			'outid3el0qkcrsuf89fltf7a4qbacgt9@import.calendar.google.com' , // 'japanese@holiday.calendar.google.com' ,
			$start_day,
			$end_day,
			50			// 最大取得数
		);

		$holidays = array();
		if ( $results = file_get_contents($holidays_url) ) {
			$results = json_decode($results, true);
//			debug($results);
			foreach ($results['feed']['entry'] as $val ) {
				$date  = $val['gd$when'][0]['startTime'];
				$title = $val['title']['$t'];
				$title = explode("/", $val['title']['$t']);
				$holidays[$date] = trim($title[0]);
			}
			ksort($holidays);
		}
		return $holidays;
	}


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Holiday->recursive = 0;
		$this->set('holidays', $this->Paginator->paginate());
	}




/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Holiday->exists($id)) {
			throw new NotFoundException(__('Invalid holiday'));
		}
		$options = array('conditions' => array('Holiday.' . $this->Holiday->primaryKey => $id));
		$this->set('holiday', $this->Holiday->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Holiday->create();
			if ($this->Holiday->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The holiday has been saved.'). "(#{$this->Holiday->id})");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The holiday could not be saved. Please, try again.'));
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
		if (!$this->Holiday->exists($id)) {
			throw new NotFoundException(__('Invalid holiday'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Holiday->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The holiday has been saved.') . "(#$id)");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The holiday could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Holiday.' . $this->Holiday->primaryKey => $id));
			$this->request->data = $this->Holiday->find('first', $options);
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
		$this->Holiday->id = $id;
		if (!$this->Holiday->exists()) {
			throw new NotFoundException(__('Invalid holiday'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Holiday->delete()) {
			$this->Session->setFlashInfo(__('The holiday has been deleted.') . "(#$id)");
		} else {
			$this->Session->setFlashError(__('The holiday could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
