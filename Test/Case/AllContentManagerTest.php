<?php
/**
 * All ContentManager plugin tests
 */
class AllContentManagerTest extends CakeTestCase {

/**
 * Suite define the tests for this plugin
 *
 * @return void
 */
	public static function suite() {
		$suite = new CakeTestSuite('All ContentManager test');

		$path = CakePlugin::path('ContentManager') . 'Test' . DS . 'Case' . DS;
		$suite->addTestDirectoryRecursive($path);

		return $suite;
	}

}
