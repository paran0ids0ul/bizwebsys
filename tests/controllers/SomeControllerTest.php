<?php

/**
 * @group Controller
 */

include_once('../../application/third_party/CIUnit/bootstrap_phpunit.php');

class SomeControllerTest extends CIUnit_TestCase
{
	public function setUp()
	{
		// Set the tested controller
		$this->CI = set_controller('welcome');
	}
	
	public function testWelcomeController()
	{
		// Call the controllers method
		$this->CI->index();
		
		// Fetch the buffered output
		$out = output();
		
		// Check if the content is OK
		$this->assertSame(0, preg_match('/(error|notice)/i', $out));

		throw new Exception('SomeControllerTest Dummy Fail');
	}
}
