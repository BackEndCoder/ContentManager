<?php
App::uses('ContentManagerAppModel', 'ContentManager.Model');
class Content extends ContentManagerAppModel {

	public $displayField = 'title';

/**
 * getContent method
 *
 * @param string $id
 * @return void
 */
	public function getContent($id) {
		return $this->find('first', array('conditions' => array('id' => $id)));
	}
}