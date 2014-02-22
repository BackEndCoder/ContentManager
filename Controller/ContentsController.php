<?php
App::uses('ContentManagerAppController', 'ContentManager.Controller');
class ContentsController extends ContentManagerAppController {
    public $name = 'Contents';
    public $helpers = array('Html');

    public function beforeFilter() {
        parent::beforeFilter();
        $user = $this->Auth->user();
        $this->set('current_user', $user);
        $this->Auth->allow('display');
        $this->Auth->allow('show');
        $this->layout = "admin";
    }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->Content->save($this->data)) {
                $this->redirect(array('action' => 'index'));
                $this->Session->setFlash("The content has been saved");
            } else {
                $this->Session->setFlash('The content could not be saved. Please, try again.');
            }
        }
    }

    public function edit($id = null) {
        $this->Content->id = $id;
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Content->save($this->request->data)) {
                $this->Session->setFlash('The product has been saved');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The product could not be saved. Please, try again.');
            }
        } else {
            $this->request->data = $this->Content->read();
        }
    }

    public function view($id = null) {
        $this->Content->id = $id;

        if (!$this->Content->exists()) {
            throw new NotFoundException('Invalid Content');
        }

        if (!$id) {
            $this->Session->setFlash('Invalid Content');
            $this->redirect(array('action' => 'index'));
        }
        $this->set('content', $this->Content->read());
    }

    public function show($id = null) {
        $this->Content->id = $id;

        if (!$this->Content->exists()) {
            throw new NotFoundException('Invalid Content');
        }

        if (!$id) {
            $this->Session->setFlash('Invalid Content');
            $this->redirect(array('action' => 'index'));
        }
        $this->set('content', $this->Content->read());
        $this->layout = "default";
    }
	
    public function getContent($id) {
        return $this->Content->getContent($id);
    }
}