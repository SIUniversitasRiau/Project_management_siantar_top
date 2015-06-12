<?php
class mKategoriAnalisa extends MY_Model {

	// constants, column definition
	const ID = 'KATEGORI_ANALISA_ID';

	function __construct() {
        parent::__construct();
		$this->tableName = "kategori_analisa";
		$this->idField = mKategoriAnalisa::ID;
    }
}
?>