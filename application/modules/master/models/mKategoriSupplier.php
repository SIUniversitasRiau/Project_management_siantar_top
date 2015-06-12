<?php
class mKategoriSupplier extends MY_Model {

	// constants, column definition
	const ID = 'KATEGORI_SUPPLIER_ID';
	const NAME = 'KATEGORI_SUPPLIER_NAMA';
	const ACTIVE = 'KATEGORI_SUPPLIER_ACTIVE';
        const TABLE = "kategori_supplier";

	function __construct() {
        parent::__construct();
		$this->tableName = mKategoriSupplier::TABLE;
		$this->idField = mKategoriSupplier::ID;
    }
}
?>