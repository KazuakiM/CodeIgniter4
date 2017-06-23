<?php namespace CodeIgniter\Debug\Toolbar\Collectors;

class LogsTest extends \CIUnitTestCase
{
	private $logs;

	public function setUp()
	{
		$this->logs = new Logs();
	}

	public function testNew()
	{
		$this->assertInstanceOf(Logs::class, $this->logs);
	}

	public function testDisplay()
	{
		$this->assertSame('<p>Nothing was logged. If you were expecting logged items, ensure that LoggerConfig file has the correct threshold set.</p>', $this->logs->display());
	}
}
