<?php namespace CodeIgniter\Debug;

class ExceptionsTest extends \CIUnitTestCase
{
	private $exceptions;

	public function setUp()
	{
		$this->exceptions = new Exceptions(new \Config\App());
		$this->exceptions->initialize();
	}

	public function testNew()
	{
		$this->assertInstanceOf(Exceptions::class, $this->exceptions);
	}

	/**
	 * @expectedException        \ErrorException
	 * @expectedExceptionCode    0
	 * @expectedExceptionMessage errorHandler: test.
	 */
	public function testErrorHandler()
	{
		$this->exceptions->errorHandler(0, 'errorHandler: test.');
	}

	public function testCleanPath()
	{
		$this->assertSame('APPPATH/apppath', $this->exceptions->cleanPath(APPPATH.'apppath'));
		$this->assertSame('BASEPATH/basepath', $this->exceptions->cleanPath(BASEPATH.'basepath'));
		$this->assertSame('FCPATH/fcpath', $this->exceptions->cleanPath(FCPATH.'fcpath'));
		$this->assertSame('dummy', $this->exceptions->cleanPath('dummy'));
	}

	public function testDescribeMemory()
	{
		$this->assertSame('5B', $this->exceptions->describeMemory(5));
		$this->assertSame('5KB', $this->exceptions->describeMemory(5120));
		$this->assertSame('5MB', $this->exceptions->describeMemory(5242880));
	}

	public function testHighlightFile()
	{
		$this->assertFalse($this->exceptions->highlightFile('dummy.txt', 5));

		$expect = <<<HTML
<pre><code><span class="line"><span class="number"> 1</span> Developer's&nbsp;Certificate&nbsp;of&nbsp;Origin&nbsp;1.1
<span class="line"><span class="number"> 2</span> 
<span class="line"><span class="number"> 3</span> By&nbsp;making&nbsp;a&nbsp;contribution&nbsp;to&nbsp;this&nbsp;project,&nbsp;I&nbsp;certify&nbsp;that:
<span class="line"><span class="number"> 4</span> 
<span class='line highlight'><span class='number'> 5</span> (1)&nbsp;&nbsp;&nbsp;&nbsp;The&nbsp;contribution&nbsp;was&nbsp;created&nbsp;in&nbsp;whole&nbsp;or&nbsp;in&nbsp;part&nbsp;by&nbsp;me&nbsp;and&nbsp;I
</span><span class="line"><span class="number"> 6</span> &nbsp;&nbsp;&nbsp;&nbsp;have&nbsp;the&nbsp;right&nbsp;to&nbsp;submit&nbsp;it&nbsp;under&nbsp;the&nbsp;open&nbsp;source&nbsp;license
<span class="line"><span class="number"> 7</span> &nbsp;&nbsp;&nbsp;&nbsp;indicated&nbsp;in&nbsp;the&nbsp;file;&nbsp;or
<span class="line"><span class="number"> 8</span> 
<span class="line"><span class="number"> 9</span> (2)&nbsp;&nbsp;&nbsp;&nbsp;The&nbsp;contribution&nbsp;is&nbsp;based&nbsp;upon&nbsp;previous&nbsp;work&nbsp;that,&nbsp;to&nbsp;the&nbsp;best
<span class="line"><span class="number">10</span> &nbsp;&nbsp;&nbsp;&nbsp;of&nbsp;my&nbsp;knowledge,&nbsp;is&nbsp;covered&nbsp;under&nbsp;an&nbsp;appropriate&nbsp;open&nbsp;source
<span class="line"><span class="number">11</span> &nbsp;&nbsp;&nbsp;&nbsp;license&nbsp;and&nbsp;I&nbsp;have&nbsp;the&nbsp;right&nbsp;under&nbsp;that&nbsp;license&nbsp;to&nbsp;submit&nbsp;that
<span class="line"><span class="number">12</span> &nbsp;&nbsp;&nbsp;&nbsp;work&nbsp;with&nbsp;modifications,&nbsp;whether&nbsp;created&nbsp;in&nbsp;whole&nbsp;or&nbsp;in&nbsp;part
<span class="line"><span class="number">13</span> &nbsp;&nbsp;&nbsp;&nbsp;by&nbsp;me,&nbsp;under&nbsp;the&nbsp;same&nbsp;open&nbsp;source&nbsp;license&nbsp;(unless&nbsp;I&nbsp;am
<span class="line"><span class="number">14</span> &nbsp;&nbsp;&nbsp;&nbsp;permitted&nbsp;to&nbsp;submit&nbsp;under&nbsp;a&nbsp;different&nbsp;license),&nbsp;as&nbsp;indicated
<span class="line"><span class="number">15</span> &nbsp;&nbsp;&nbsp;&nbsp;in&nbsp;the&nbsp;file;&nbsp;or
</span></code></pre>
HTML;
		$this->assertSame($expect, $this->exceptions->highlightFile('DCO.txt', 5));

		if (function_exists('ini_set'))
		{
			ini_set('highlight.comment', '#FF8000');
			ini_set('highlight.default', '#0000BB');
			ini_set('highlight.html', '#000000');
			ini_set('highlight.keyword', '#007700');
			ini_set('highlight.string', '#DD0000');
		}
	}
}
