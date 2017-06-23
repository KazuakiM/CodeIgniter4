<?php namespace CodeIgniter\Debug\Toolbar\Collectors;

class BaseCollectorTest extends \CIUnitTestCase
{
	private $baseCollector;

	public function setUp()
	{
		$this->baseCollector = new BaseCollector();
	}

	public function testNew()
	{
		$this->assertInstanceOf(BaseCollector::class, $this->baseCollector);
	}

	public function testGetTitle()
	{
		$this->assertSame('', $this->baseCollector->getTitle(true));
		$this->assertSame('', $this->baseCollector->getTitle());
	}

	public function testGetTitleDetails()
	{
		$this->assertSame('', $this->baseCollector->getTitleDetails());
	}

	public function testHasTabContent()
	{
		$this->assertFalse($this->baseCollector->hasTabContent());
	}

	public function testHasTimelineData()
	{
		$this->assertFalse($this->baseCollector->hasTimelineData());
	}

	public function testTimelineData()
	{
		$this->assertSame([], $this->baseCollector->timelineData());
	}

	public function testHasVarData()
	{
		$this->assertFalse($this->baseCollector->hasVarData());
	}

	public function testGetVarData()
	{
		$this->assertNull($this->baseCollector->GetVarData());
	}

	public function testDisplay()
	{
		$this->assertSame('', $this->baseCollector->display());
	}

	public function testCleanPath()
	{
		$this->assertSame('APPPATH/apppath', $this->baseCollector->cleanPath(APPPATH.'apppath'));
		$this->assertSame('BASEPATH/basepath', $this->baseCollector->cleanPath(BASEPATH.'basepath'));
		$this->assertSame('FCPATH/fcpath', $this->baseCollector->cleanPath(FCPATH.'fcpath'));
		$this->assertSame('dummy', $this->baseCollector->cleanPath('dummy'));
	}
}
