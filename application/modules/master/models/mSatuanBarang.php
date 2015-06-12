<?php
class mSatuanBarang extends MY_Model {

	const ID = 'SATUAN_NAMA';
	const NAME = 'SATUAN_NAMA';

    function __construct() {
        parent::__construct();
		$this->tableName = "satuan_barang";
		$this->idField = mSatuanBarang::ID;
    }
}
?>