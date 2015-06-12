<?php
class mPajakSupplier extends MY_Model {

	// constants, column definition
	const ID = 'PAJAK_SUPPLIER_ID';
	const NAME = 'PAJAK_SUPPLIER_NAMA';
	const ACTIVE = 'PAJAK_SUPPLIER_ACTIVE';
        const TABLE = "pajak_supplier";

        function __construct() {
        parent::__construct();
		$this->tableName = mPajakSupplier::TABLE;
		$this->idField = mPajakSupplier::ID;
    }
}
?>