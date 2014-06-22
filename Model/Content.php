<?php
App::uses('ContentManagerAppModel', 'ContentManager.Model');
class Content extends ContentManagerAppModel {

	public $displayField = 'title';

/**
 * getContent method
 *
 * @param integer $id Id to look up
 * @return void
 */
	public function getContent($id) {
		return $this->find('first', array('conditions' => array('id' => $id)));
	}
}