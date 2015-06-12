<?php
class mOverhead extends MY_Model {

	// constants, column definition
	const ID = 'OVERHEAD_ID';
	const NAME = 'OVERHEAD_NAMA';
	const ACTIVE = 'OVERHEAD_ACTIVE';

	function __construct() {
        parent::__construct();
		$this->tableName = "overhead";
		$this->idField = mOverhead::ID;
    }
}
?>