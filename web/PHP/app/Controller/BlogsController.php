<?php
App::uses('AppController', 'Controller');
/**
 * Blogs Controller
 *
 * @property Blog $Blog
 */
class BlogsController extends AppController {


public $helpers = array ('Session','App','Html');

public $components = array('Paginator','Session','Thumb');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->layout="indexLayout";
		$this->paginate = array(
			'order' => array('Blog.id' => 'DESC')
		);
		$blogs = $this->paginate('Blog');
		$this->set(compact('blogs'));
		$this->blogFooter();
	}
	
/**
 * details method
 *
 * @return void
 */
	public function detail($id=null) {
		$this->layout="indexLayout";
		$blog=$this->Blog->find('first',array(
			'conditions'=>array('Blog.id'=>$id)
		));
		$this->set('blog',$blog);
		$this->blogFooter();
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Blog->exists($id)) {
			throw new NotFoundException(__('Invalid blog'));
		}
		$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
		$this->set('blog', $this->Blog->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Blog->create();
			if ($this->Blog->save($this->request->data)) {
				$this->Session->setFlash(__('The blog has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog could not be saved. Please, try again.'));
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
		if (!$this->Blog->exists($id)) {
			throw new NotFoundException(__('Invalid blog'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Blog->save($this->request->data)) {
				$this->Session->setFlash(__('The blog has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
			$this->request->data = $this->Blog->find('first', $options);
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
		$this->Blog->id = $id;
		if (!$this->Blog->exists()) {
			throw new NotFoundException(__('Invalid blog'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Blog->delete()) {
			$this->Session->setFlash(__('Blog deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Blog was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		if( !$this->Session->read('admin_id') ) {
			$this->redirect( array('controller' => 'pages', 'action' => 'login', 'admin' => true) );
		}
		$this->layout="adminLayout";
		
		$this->paginate = array(
			'order' => array('Blog.id' => 'DESC')
		);
		$blogs = $this->paginate('Blog');
		$this->set(compact('blogs'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Blog->exists($id)) {
			throw new NotFoundException(__('Invalid blog'));
		}
		$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
		$this->set('blog', $this->Blog->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if( !$this->Session->read('admin_id') ) {
			$this->redirect( array('controller' => 'pages', 'action' => 'login', 'admin' => true) );
		}
		$this->layout="adminLayout";
		if ($this->request->is('post')) {
			$this->Blog->create();
			if(isset($this->request->data['Blog']['image']['name']) && $this->request->data['Blog']['image']['name']!=''){
				$filename = trim(time().str_replace(' ','_',$this->request->data['Blog']['image']['name']));
				if(move_uploaded_file($this->request->data['Blog']['image']['tmp_name'],WWW_ROOT."blogPic/".$filename)){
					$source = WWW_ROOT."blogPic/".$filename;
					$destination = WWW_ROOT."blogPic/thumb_".$filename;
					$this->Thumb->createthumbs($source,$destination,100,80);
				}
				else{
					$filename='';
				}
			}else{
				$filename='';
			}
			
			$this->request->data['Blog']['image'] = $filename;
			if ($this->Blog->save($this->request->data)) {
				$this->Session->setFlash(__('The blog has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if( !$this->Session->read('admin_id') ) {
			$this->redirect( array('controller' => 'pages', 'action' => 'login', 'admin' => true) );
		}
		$this->layout="adminLayout";
		if (!$this->Blog->exists($id)) {
			throw new NotFoundException(__('Invalid blog'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			$blogDetail = $this->Blog->find('first',array(
				'conditions'=>array('Blog.id'=>$id)
			));
			
			if(isset($this->request->data['Blog']['image']['name']) && $this->request->data['Blog']['image']['name']!=''){
				$filename = trim(time().str_replace(' ','_',$this->request->data['Blog']['image']['name']));
				if(move_uploaded_file($this->request->data['Blog']['image']['tmp_name'],WWW_ROOT."blogPic/".$filename)){
					$source = WWW_ROOT."blogPic/".$filename;
					$destination = WWW_ROOT."blogPic/thumb_".$filename;
					$this->Thumb->createthumbs($source,$destination,100,80);
				}else{
					$filename='';
				}
			}else{
				$filename=$blogDetail['Blog']['image'];
			}
			$this->request->data['Blog']['image'] = $filename;
			
			if ($this->Blog->save($this->request->data)) {
				$this->Session->setFlash(__('The blog has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The blog could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
			$this->request->data = $this->Blog->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Blog->id = $id;
		if (!$this->Blog->exists()) {
			throw new NotFoundException(__('Invalid blog'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Blog->delete()) {
			$this->Session->setFlash(__('Blog deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Blog was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
