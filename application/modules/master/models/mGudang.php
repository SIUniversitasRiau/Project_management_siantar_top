<?php
class mGudang extends MY_Model {

	// constants, column definition
	const ID = 'GUDANG_ID';
	const NAME = 'GUDANG_NAMA';
	const ACTIVE = 'GUDANG_ACTIVE';
        const TABLE = "master_gudang";

	function __construct() {
        parent::__construct();
		$this->tableName = mGudang::TABLE;
		$this->idField = mGudang::ID;
    }
}
?>