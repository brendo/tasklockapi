<?php
	
	require_once EXTENSIONS . '/tasklockapi/lib/class.tasklock.php';
	
	class Extension_TaskLockAPI extends Extension {
		public function about() {
			return array(
				'name'			=> 'Task Lock API',
				'version'		=> '1.0.1',
				'release-date'	=> '2010-02-09',
				'author'		=> array(
					'name'			=> 'Rowan Lewis',
					'website'		=> 'http://rowanlewis.com/',
					'email'			=> 'me@rowanlewis.com'
				),
				'description'	=> 'Provides a locking mechanism for use in Symphony extensions.'
			);
		}
		
		public function install() {
			Symphony::Database()->query("
				CREATE TABLE IF NOT EXISTS `tbl_task_locks` (
					`id` INT(11) NOT NULL AUTO_INCREMENT,
					`name` VARCHAR(32) DEFAULT NULL,
					`time` INT(11) DEFAULT NULL,
					PRIMARY KEY (`id`),
					UNIQUE KEY `name` (`name`),
					KEY `time` (`time`)
				)
			");
			
			return true;
		}
		
		public function uninstall() {
			$this->_Parent->Database->query("DROP TABLE `tbl_task_locks`");
			
			return true;
		}
	}
		
?>