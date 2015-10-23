<?php
App::uses('AppController', 'Controller');
/**
 * AppGalleries Controller
 *
 * @property AppGallery $AppGallery
 */
class AppGalleriesController extends AppController {
public $components = array('Paginator','Session','Thumb');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		/*$this->AppGallery->recursive = 0;
		$this->set('appGalleries', $this->paginate());*/
		$this->homepageredirect();
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		/*if (!$this->AppGallery->exists($id)) {
			throw new NotFoundException(__('Invalid app gallery'));
		}
		$options = array('conditions' => array('AppGallery.' . $this->AppGallery->primaryKey => $id));
		$this->set('appGallery', $this->AppGallery->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		/*if ($this->request->is('post')) {
			$this->AppGallery->create();
			if ($this->AppGallery->save($this->request->data)) {
				$this->Session->setFlash(__('The app gallery has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The app gallery could not be saved. Please, try again.'));
			}
		}*/
		$this->homepageredirect();
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		/*if (!$this->AppGallery->exists($id)) {
			throw new NotFoundException(__('Invalid app gallery'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AppGallery->save($this->request->data)) {
				$this->Session->setFlash(__('The app gallery has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The app gallery could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AppGallery.' . $this->AppGallery->primaryKey => $id));
			$this->request->data = $this->AppGallery->find('first', $options);
		}*/
		$this->homepageredirect();
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		/*$this->AppGallery->id = $id;
		if (!$this->AppGallery->exists()) {
			throw new NotFoundException(__('Invalid app gallery'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AppGallery->delete()) {
			$this->Session->setFlash(__('App gallery deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('App gallery was not deleted'));
		$this->redirect(array('action' => 'index'));*/
		$this->homepageredirect();
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		$this->AppGallery->recursive = 0;
		$appgalcond = array();
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		if($company_id>0){
			$appgalcond = array('AppGallery.company_id'=>$company_id);
		}
		$this->paginate = array(
			'conditions'=>$appgalcond,
			'offset'=>'0',
			'limit'=>30
		);
		$this->set('appGalleries', $this->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		/*if (!$this->AppGallery->exists($id)) {
			throw new NotFoundException(__('Invalid app gallery'));
		}
		$options = array('conditions' => array('AppGallery.' . $this->AppGallery->primaryKey => $id));
		$this->set('appGallery', $this->AppGallery->find('first', $options));*/
		$this->homepageredirect();
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		if ($this->request->is('post')) {
			$this->AppGallery->create();
			
			// SAVING IOS GALLERY IMAGE
			if(isset($this->request->data['AppGallery']['ios_image']['name']) && $this->request->data['AppGallery']['ios_image']['name']!=''){
				$IOSimage = trim(time().str_replace(' ','_',$this->request->data['AppGallery']['ios_image']['name']));
				if(move_uploaded_file($this->request->data['AppGallery']['ios_image']['tmp_name'],WWW_ROOT."appPic/".$IOSimage)){
					$source = WWW_ROOT."appPic/".$IOSimage;
					$destination = WWW_ROOT."appPic/thumb_".$IOSimage;
					$this->Thumb->createthumbs($source,$destination,100,80);
				}
				else{
					$IOSimage='';
				}
			}else{
				$IOSimage='';
			}
			
			// SAVING ANDROID GALLERY IMAGE
			if(isset($this->request->data['AppGallery']['android_image']['name']) && $this->request->data['AppGallery']['android_image']['name']!=''){
				$android_image = trim(time().str_replace(' ','_',$this->request->data['AppGallery']['android_image']['name']));
				if(move_uploaded_file($this->request->data['AppGallery']['android_image']['tmp_name'],WWW_ROOT."appPic/".$android_image)){
					$source = WWW_ROOT."appPic/".$android_image;
					$destination = WWW_ROOT."appPic/thumb_".$android_image;
					$this->Thumb->createthumbs($source,$destination,100,80);
				}
				else{
					$android_image='';
				}
			}else{
				$android_image='';
			}
			
			// PASSING THE IMAGE NAME TO THE DATABASE
			$this->request->data['AppGallery']['ios_image'] = $IOSimage;
			$this->request->data['AppGallery']['android_image'] = $android_image;
			//add company
			$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
			$this->request->data['AppGallery']['company_id'] = $company_id;
			// SAVING THE DATA
			if ($this->AppGallery->save($this->request->data)) {
				$this->Session->setFlash(__('The app gallery has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The app gallery could not be saved. Please, try again.'));
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
		$this->adminsessionvalidation();
		$this->layout="adminLayout";
		if (!$this->AppGallery->exists($id)) {
			//throw new NotFoundException(__('Invalid app gallery'));
			$this->admininvalidpath();
		}
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		if ($this->request->is('post') || $this->request->is('put')) {
			$appDetail = $this->AppGallery->find('first',array(
				'conditions'=>array('AppGallery.id'=>$id)
			));
			
			// SAVING IOS GALLERY IMAGE
			if(isset($this->request->data['AppGallery']['ios_image']['name']) && $this->request->data['AppGallery']['ios_image']['name']!=''){
				$IOSimage = trim(time().str_replace(' ','_',$this->request->data['AppGallery']['ios_image']['name']));
				if(move_uploaded_file($this->request->data['AppGallery']['ios_image']['tmp_name'],WWW_ROOT."appPic/".$IOSimage)){
					$source = WWW_ROOT."appPic/".$IOSimage;
					$destination = WWW_ROOT."appPic/thumb_".$IOSimage;
					$this->Thumb->createthumbs($source,$destination,100,80);
				}
				else{
					$IOSimage='';
				}
			}else{
				$IOSimage = $appDetail['AppGallery']['ios_image'];
			}
			
			// SAVING ANDROID GALLERY IMAGE
			if(isset($this->request->data['AppGallery']['android_image']['name']) && $this->request->data['AppGallery']['android_image']['name']!=''){
				$android_image = trim(time().str_replace(' ','_',$this->request->data['AppGallery']['android_image']['name']));
				if(move_uploaded_file($this->request->data['AppGallery']['android_image']['tmp_name'],WWW_ROOT."appPic/".$android_image)){
					$source = WWW_ROOT."appPic/".$android_image;
					$destination = WWW_ROOT."appPic/thumb_".$android_image;
					$this->Thumb->createthumbs($source,$destination,100,80);
				}
				else{
					$android_image='';
				}
			}else{
				$android_image = $appDetail['AppGallery']['android_image'];
			}
			
			// PASSING THE IMAGE NAME TO THE DATABASE
			$this->request->data['AppGallery']['ios_image'] = $IOSimage;
			$this->request->data['AppGallery']['android_image'] = $android_image;
			
			if ($this->AppGallery->save($this->request->data)) {
				$this->Session->setFlash(__('The app gallery has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The app gallery could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AppGallery.' . $this->AppGallery->primaryKey => $id));
			if($company_id>0){
				$options['conditions']['AppGallery.company_id']=$company_id;
			}
			$this->request->data = $this->AppGallery->find('first', $options);
		}
	}
	
/**
 * admin_isbackground method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_isbackground($id = null) {
		$this->adminsessionvalidation();
		if (!$this->AppGallery->exists($id)) {
			//throw new NotFoundException(__('Invalid app gallery'));
			$this->admininvalidpath();
		}
		$company_id = ($this->Session->check('siteid') && $this->Session->read('siteid')>0)?$this->Session->read('siteid'):0;
		$galfindcond = array('AppGallery.is_background_image'=>'1');
		$galupdatecondi = array('AppGallery.id'=>$id);
		if($company_id>0){
			$galfindcond['AppGallery.company_id']=$company_id;
			$galupdatecondi['AppGallery.company_id']=$company_id;
		}
		$appDetail = $this->AppGallery->find('all', array(
			'conditions'=>$galfindcond,
			'order'=>array('AppGallery.is_background_image'=>'DESC')
		));
		if($appDetail){
			if($appDetail[0]['AppGallery']['id']==$id){
				$this->AppGallery->updateAll(array('AppGallery.is_background_image'=>'0'),$galupdatecondi);
				$this->Session->setFlash(__('You have successfully removed this gallery from background image.'));
				$this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash(__('You had already assigned a gallery as background image.'));
				$this->redirect(array('action' => 'index'));
			}
		}else{
			$this->AppGallery->updateAll(array('AppGallery.is_background_image'=>'1'),$galupdatecondi);
			$this->Session->setFlash(__('You have successfully assigned this gallery as background image.'));
			$this->redirect(array('action' => 'index'));
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
		$this->adminsessionvalidation();
		$this->AppGallery->id = $id;
		if (!$this->AppGallery->exists()) {
			//throw new NotFoundException(__('Invalid app gallery'));
			$this->admininvalidpath();
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AppGallery->delete()) {
			$this->Session->setFlash(__('App gallery deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('App gallery was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
