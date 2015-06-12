<?php
class mBarang extends MY_Model {

	// constants, column definition
	const ID = 'BARANG_ID';
	const NAME = 'BARANG_NAMA';
	const ACTIVE = 'BARANG_ACTIVE';

	function __construct() {
        parent::__construct();
		$this->tableName = "master_barang";
		$this->idField = mBarang::ID;
    }
	
	public function getViewBarang(){
		$baseSQL = "SELECT `master_barang`.*, `kategori_barang`.`kategori_barang_nama` AS KATEGORI_BARANG_NAMA FROM (`master_barang`) 
					JOIN `kategori_barang` 
					ON `master_barang`.`kategori_barang_id` = `kategori_barang`.`kategori_barang_id` 
					WHERE `BARANG_ACTIVE` = 1";
		
		$columns = array(
			array( 'db' => 'BARANG_ID', 'dt' => 0 ),
			array( 'db' => 'BARANG_NAMA',  'dt' => 1 ),
			array( 'db' => 'KATEGORI_BARANG_NAMA',   'dt' => 2 ),
			array( 'db' => 'SATUAN_NAMA',     'dt' => 3 ),
			array( 'db' => 'BARANG_KODE', 'dt' => 4 ),
			array( 'db' => 'BARANG_HARGA', 'dt' => 5 ),
			array( 'db' => 'BARANG_KETERANGAN', 'dt' => 6 ),
			array( 'db' => 'KATEGORI_BARANG_ID', 'dt' => 7 )
		);
		
		return json_encode(SSP::simple( $_GET, $this->tableName, $this->idField, $columns, $baseSQL));
	}
	
	public function getViewAnalisaBarang(){
		$baseSQL = "SELECT `master_barang`.*, `kategori_barang`.`kategori_barang_nama` AS KATEGORI_BARANG_NAMA FROM (`master_barang`) 
					JOIN `kategori_barang` 
					ON `master_barang`.`kategori_barang_id` = `kategori_barang`.`kategori_barang_id` 
					WHERE `BARANG_ACTIVE` = 1";
		
		$columns = array(
			array( 'db' => 'BARANG_NAMA', 'dt' => 0 ),
			array( 'db' => 'KATEGORI_BARANG_NAMA', 'dt' => 1 ),
			array( 'db' => 'BARANG_KODE', 'dt' => 2 ),
			array( 'db' => 'SATUAN_NAMA', 'dt' => 3 ),
			array( 'db' => 'BARANG_HARGA', 'dt' => 4 ),
			array( 'db' => 'BARANG_ID', 'dt' => 5 )
		);
		
		return json_encode(SSP::simple( $_GET, $this->tableName, $this->idField, $columns, $baseSQL));
	}
}
?>