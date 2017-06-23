<?php namespace CodeIgniter\Debug\Toolbar\Collectors;

class FilesTest extends \CIUnitTestCase
{
	private $files;

	public function setUp()
	{
		$this->files = new Files();
	}

	public function testNew()
	{
		$this->assertInstanceOf(Files::class, $this->files);
	}

	public function testDisplay()
	{
		$this->assertInternalType('string', $this->files->display());
	}

	public function testGetTitleDetails()
	{
		$this->assertRegExp('/\A\(\s\d+\s\)\z/u', $this->files->getTitleDetails());
	}
}
