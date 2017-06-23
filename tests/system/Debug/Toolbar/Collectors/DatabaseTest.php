<?php namespace CodeIgniter\Debug\Toolbar\Collectors;

use CodeIgniter\Database\MockConnection;
use CodeIgniter\Database\Query;

class DatabaseTest extends \CIUnitTestCase
{
	private $connection;
	private $database;

	public function setUp()
	{
		$this->connection = new MockConnection([]);
		$this->database = new Database();
	}

	public function tearDown()
	{
	}

	public function testNew()
	{
		$this->assertInstanceOf(Database::class, $this->database);
	}

	public function testDisplay()
	{
		$query = new Query($this->connection);
		$query->setQuery('SELECT test_display.* FROM users AS test_display WHERE test_display.id = :id', [
			'id' => 13,
		]);
		$this->database->collect($query);
		$expect = <<<HTML
test_display.* <strong>FROM</strong> users <strong>AS</strong> test_display <strong>WHERE</strong> test_display.id = 13</td>
        </tr>
    
    </tbody>
</table>

HTML;
		$this->assertSame($expect, strstr($this->database->display(), 'test_display'));
	}

	public function testGetTitleDetails()
	{
		$query = new Query($this->connection);
		$query->setQuery('SELECT test_display.* FROM users AS test_display WHERE test_display.id = :id', [
			'id' => 13,
		]);
		$this->database->collect($query);
		$this->assertRegExp('/\A\(\d+ Queries across \d+ Connections?\)\z/u', $this->database->getTitleDetails());
	}
}
