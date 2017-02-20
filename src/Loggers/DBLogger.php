<?php 

namespace Logger\Loggers;

use Logger;

class DBLogger extends Logger\Logger 
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
 		try{
			$this->connection->query($query);
		} catch (\PDOException $e) {
			print_r($e->getMessage());
		}


	}

	public function log($level, $message, array $context = array())
	{
		$this->transformMessage($message,$context);
		try {
			$queryInsert = $this->connection->prepare("insert into {$this->table} (date, level, message, context) values (:date, :level, :message, :context)");
			$queryInsert->bindValue(':date', $this->getDate());
			$queryInsert->bindValue(':level', $level);
			$queryInsert->bindValue(':message', $message);
			$queryInsert->bindValue(':context', $this->contextToString($context));
			$queryInsert->execute();
		} catch (\PDOException $e) {
			print_r($e->getMessage());
		} 
	}

	public function __destruct()
	{
		$this->connection = null;
	}
}