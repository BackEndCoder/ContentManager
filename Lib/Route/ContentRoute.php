<?php
class ContentRoute extends CakeRoute {

/**
 * parse method
 *
 * @param string $url
 * @return void
 */
	public function parse($url) {
		$params = parent::parse($url);
		if (empty($params)) {
			return false;
		}
		if (($count = Cache::read('content_slug-' . $params['contentSlug'])) === false) {
			App::uses('Content', 'ContentManager.Model');
			$Content = new Content();
			$count = $Content->find('count', array(
				'conditions' => array('Content.slug LIKE ?' => $params['contentSlug'] . '%'),
				'recursive' => -1
			));
			Cache::write('content_slug-' . $params['contentSlug'], $count);
		}
		if ($count) {
			return $params;
		}
		return false;
	}
}