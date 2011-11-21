## Task Lock API

- Version: 1.1
- Author: Rowan Lewis <me@rowanlewis.com>
- Build Date: 21 November 2009
- Requirements: Symphony 2.0.6


### Installation

1. Upload the `tasklockapi` folder to your Symphony `/extensions` folder.

2. Enable it by selecting "Task Lock API", and choosing Enable from the
   with-selected menu, then click Apply.

### Example

<?php

	require_once EXTENSIONS . '/tasklockapi/extension.driver.php';

	$lock = new TaskLock('example');

	if ($lock->isActive()) {
		echo 'Locked.';
	}

	else {
		$lock->create();

		// Do complex processing here:

		$lock->remove();

		echo 'Done.';
	}

?>