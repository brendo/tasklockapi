<?php
	
	class TaskLock {
		protected $name = null;
		protected $time = null;
		
		/**
		* Create a new lock
		* 
		* @param	$name	string		Unique lock name
		* @param	$time	integer		Lock timeout in seconds
		*/
		public function __construct($name, $time = 300) {
			$this->name = md5($name);
			$this->time = $time;
		}
		
		/**
		* Test to see if the lock is in use
		* 
		* @return boolean
		*/
		public function isActive() {
			$db = ASDCLoader::instance();
			$res = $db->query(sprintf(
				'
					SELECT
						*
					FROM
						`tbl_task_locks`
					WHERE
						`name` = "%s"
					LIMIT 1
				',
				$this->name
			));
			
			// Lock does not exist:
			if (!$res->valid()) return false;
			
			$lock = $res->current();
			
			return time() - $lock->time < $this->time;
		}
		
		/**
		* Create a new or update an existing lock
		*/
		public function create() {
			$db = ASDCLoader::instance();
			$db->query(sprintf(
				'
					INSERT INTO
						`tbl_task_locks`
					VALUES (
						null,
						"%s",
						%d
					)
					ON DUPLICATE KEY UPDATE
						`time` = %1$d
				',
				$this->name, time()
			));
		}
		
		/**
		* Remove a lock
		*/
		public function remove() {
			$db = ASDCLoader::instance();
			$db->query(sprintf(
				'
					DELETE FROM
						`tbl_task_locks`
					WHERE
						`name` = "%s"
				',
				$this->name
			));
		}
	}
	
?>