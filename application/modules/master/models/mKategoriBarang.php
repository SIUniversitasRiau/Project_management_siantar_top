<?php
class mKategoriBarang extends MY_Model {

	const ID = 'KATEGORI_BARANG_ID';
	const NAME = 'KATEGORI_BARANG_NAMA';

    function __construct() {
        parent::__construct();
		$this->tableName = "kategori_barang";
		$this->idField = mKategoriBarang::ID;
    }
}
?>