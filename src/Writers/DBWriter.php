<?php 

namespace Logger\Writers;

use Logger;

class DBWriter extends Logger\Writer 
{
	protected $connection;
	protected $table;

	public function __construct(array $parameters = array())
	{
		if (!empty($parameters)) {
			$this->setParameters($parameters);
		} else {
			$this->connection = Logger\Connection\Connection::getConnection();
			$this->table = Logger\Config\Config::$components['dbcomponents']['table'];
		}

		$this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
 		$query = "create table if not exists {$this->table}(id int unsigned not null auto_increment, date datetime, level varchar(16), message text, context text, primary key(id))";
 		$this->connection->query($query);
	}

	public function log($level, $message, array $context = array())
	{
		$this->transformMessage($message,$context);
		$queryInsert = $this->connection->prepare("insert into {$this->table} (date, level, message, context) values (:date, :level, :message, :context)");
		$queryInsert->bindValue(':date', $this->getDate());
		$queryInsert->bindValue(':level', $level);
		$queryInsert->bindValue(':message', $message);
		$queryInsert->bindValue(':context', $this->contextToString($context));
		$queryInsert->execute();
	}

	public function __destruct()
	{
		$this->connection = null;
	}
}