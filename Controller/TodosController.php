<?php
App::uses('AppController', 'Controller');
/**
 * Todos Controller
 *
 * @property Todo $Todo
 * @property PaginatorComponent $Paginator
 */
class TodosController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');



	// add

	public function ajaxadd() {
		Configure::write('debug', 0);
		$this->autoRender = false;
		$this->layout = "ajax";

		$min = $this->Todo->find('first',array(
			'conditions' => array('todocategory_id'=>$this->request->data['todocategory_id']),
			'order' => 'todo.position asc'
		));

		$this->Todo->create();
		$this->request->data['position'] = $min['Todo']['position']-1;
		$this->Todo->save($this->request->data, false);
		$todo = $this->Todo->read();
		$this->set('todo', $todo['Todo']);
		$this->render('ui_element', 'ajax');
	}

	// history

	public function ajax2allhistory() {
		Configure::write('debug', 0);
		$this->autoRender = false;

		$items = $this->request->data['items'];
		$cond = implode(",", $items);
		$cond = $cond;
//		$this->log($cond);
//		foreach ($items as $key) {
//			$this->Todo->delete($key);
//		}

		$this->Todo->query("insert into todohistories select * from todos where todos.id in ($cond);");
		$this->Todo->query("delete from todos where todos.id in ($cond) ;");
	}

	// update

	public function ajaxedit() {
		Configure::write('debug', 0);
		$this->autoRender = false;

		$this->Todo->save($this->request->data);
	}


	public function ajaxdelete() {
		Configure::write('debug', 0);
		$this->autoRender = false;
		$this->layout = "ajax";
		$this->Todo->delete($this->request->data['id']);
		echo "1";
	}

	public function ajaxdeleteitems() {
		Configure::write('debug', 0);
		$this->autoRender = false;
		$items = $this->request->data['items'];
		foreach ($items as $key) {
			$this->Todo->delete($key);
		}
	}

	public function ajaxcompleteitems() {
		Configure::write('debug', 0);
		$this->autoRender = false;
		$items = $this->request->data['items'];
		$completed = $this->request->data['completed'];
		foreach ($items as $key) {
			$this->Todo->save(array('id'=>$key,'completed'=>$completed),false,array('completed'));
		}
	}

	public function ajaxreorder() {
		Configure::write('debug', 0);

//		$this->log($this->request->data);

		$this->autoRender = false;
		$pos = $this->request->data['idlist'];
		$curpos = 0;
		foreach ($pos as $seq => $idstring) {

			$id = str_replace('todo-', '', $idstring);
			// 排他
			if ($this->Todo->exists($id)) {
				$this->Todo->save(array('id'=>$id,'position'=>$curpos++),false,array('position'));
			}
		}
	}

	public function ajaxreorder_category() {
		Configure::write('debug', 0);

//		$this->log($this->request->data);

		$this->autoRender = false;
		$pos = $this->request->data['idlist'];
		$curpos = 0;
		foreach ($pos as $seq => $idstring) {

			$id = str_replace('category-', '', $idstring);
			// 排他
			if ($this->Todo->Todocategory->exists($id)) {
				$this->Todo->Todocategory->save(array('id'=>$id,'position'=>$curpos++),false,array('position'));
			}
		}
	}

	public function ui() {
//		$this->Todo->Todocategory->recursive = 0;
//		$this->set('todos', $this->Todo->find('all'));
		$this->set('todos',
			$this->Todo->Todocategory->find('all', array(
				'order' => 'position'
			))
		);
//		$this->set('todos', $this->Todo->Todocategory->find('all', array('order'=>'todo.position')));
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Todo->recursive = 0;
		$this->set('todos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Todo->exists($id)) {
			throw new NotFoundException(__('Invalid todo'));
		}
		$options = array('conditions' => array('Todo.' . $this->Todo->primaryKey => $id));
		$this->set('todo', $this->Todo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Todo->create();
			if ($this->Todo->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The todo has been saved.'). "(#{$this->Todo->id})");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The todo could not be saved. Please, try again.'));
			}
		}
		$todocategories = $this->Todo->Todocategory->find('list');
		$this->set(compact('todocategories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Todo->exists($id)) {
			throw new NotFoundException(__('Invalid todo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Todo->save($this->request->data)) {
				$this->Session->setFlashInfo(__('The todo has been saved.') . "(#$id)");
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlashError(__('The todo could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Todo.' . $this->Todo->primaryKey => $id));
			$this->request->data = $this->Todo->find('first', $options);
		}
		$todocategories = $this->Todo->Todocategory->find('list');
		$this->set(compact('todocategories'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Todo->id = $id;
		if (!$this->Todo->exists()) {
			throw new NotFoundException(__('Invalid todo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Todo->delete()) {
			$this->Session->setFlashInfo(__('The todo has been deleted.') . "(#$id)");
		} else {
			$this->Session->setFlashError(__('The todo could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
