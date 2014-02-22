<?php
App::uses('Page', 'ContentManager.Model');

/**
 * Page Test Case
 *
 */
class PageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.content_manager.page'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Page = ClassRegistry::init('ContentManager.Page');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Page);

		parent::tearDown();
	}

}
