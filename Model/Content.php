<?php
App::uses('ContentManagerAppModel', 'ContentManager.Model');
class Content extends ContentManagerAppModel {

	public $useTable = 'pages';

	public $displayField = 'title';

    public function getContent($id) {
        return $this->find('first', array('conditions' => array('id' => $id)));
    }
}