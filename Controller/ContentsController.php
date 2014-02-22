<?php
App::uses('ContentManagerAppController', 'ContentManager.Controller');
class ContentsController extends ContentManagerAppController {

	public $components = array('Paginator', 'Session');

    public function beforeFilter() {
        parent::beforeFilter();
        $user = $this->Auth->user();
        $this->set('current_user', $user);
        $this->Auth->allow('show');
    }

	public function view($id = null) {
		if(empty($id)):
			if(empty($this->request->params['contentSlug'])):
				throw new NotFoundException(__('Invalid content'));
			endif;
			$content = $this->Content->findBySlug($this->request->params['contentSlug']);
			if(empty($content)):
				throw new NotFoundException(__('Invalid content'));
			endif;
		else:
			if (!$this->Content->exists($id)) {
				throw new NotFoundException(__('Invalid content'));
			}
			$options = array('conditions' => array('Content.' . $this->Content->primaryKey => $id));
			$content = $this->Content->findById($id);
		endif;
		$this->set('content', $content);
	}

	public function admin_index() {
		$this->Content->recursive = 0;
		$this->set('contents', $this->Paginator->paginate());
	}

	public function admin_view($id = null) {
		if (!$this->Content->exists($id)) {
			throw new NotFoundException(__('Invalid content'));
		}
		$options = array('conditions' => array('Content.' . $this->Content->primaryKey => $id));
		$this->set('content', $this->Content->find('first', $options));
        $this->layout = "admin";
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Content->create();
			if ($this->Content->save($this->request->data)) {
				$this->Session->setFlash(__('The content has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The content could not be saved. Please, try again.'));
			}
		}
        $this->layout = "admin";
	}

	public function admin_edit($id = null) {
		if (!$this->Content->exists($id)) {
			throw new NotFoundException(__('Invalid content'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Content->save($this->request->data)) {
				$this->Session->setFlash(__('The content has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The content could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Content.' . $this->Content->primaryKey => $id));
			$this->request->data = $this->Content->find('first', $options);
		}
        $this->layout = "admin";
	}

	public function admin_delete($id = null) {
		$this->Content->id = $id;
		if (!$this->Content->exists()) {
			throw new NotFoundException(__('Invalid content'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Content->delete()) {
			$this->Session->setFlash(__('The content has been deleted.'));
		} else {
			$this->Session->setFlash(__('The content could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
        $this->layout = "admin";
	}

    public function getContent($id) {
        return $this->Content->getContent($id);
    }
}