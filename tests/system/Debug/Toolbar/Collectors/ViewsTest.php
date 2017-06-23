<?php namespace CodeIgniter\Debug\Toolbar\Collectors;

class ViewsTest extends \CIUnitTestCase
{
	private $views;

	public function setUp()
	{
		$this->views = new Views();
	}

	public function testNew()
	{
		$this->assertInstanceOf(Views::class, $this->views);
	}

	public function testGetVarData()
	{
		$this->assertArrayHasKey('View Data', $this->views->getVarData());
	}
}
