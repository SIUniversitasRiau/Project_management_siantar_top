<?php
class mUpah extends MY_Model {

	// constants, column definition
	const ID = 'UPAH_ID';
	const NAME = 'UPAH_NAMA';
	const ACTIVE = 'UPAH_ACTIVE';

    function __construct() {
        parent::__construct();
		$this->tableName = "master_upah";
		$this->idField = mUpah::ID;
    }
	
	public function getViewUpah(){
		$baseSQL = "SELECT `master_upah`.*, `satuan_upah`.`satuan_upah_nama` as SATUAN_UPAH_NAMA, `lokasi_upah`.`lokasi_upah_nama` as LOKASI_UPAH_NAMA FROM (`master_upah`) JOIN `satuan_upah` ON `master_upah`.`satuan_upah_id` = `satuan_upah`.`satuan_upah_id` JOIN `lokasi_upah` ON `master_upah`.`lokasi_upah_id` = `lokasi_upah`.`lokasi_upah_id` WHERE `master_upah`.`upah_active` = 1";
		
		$columns = array(
			array( 'db' => 'UPAH_ID', 'dt' => 0 ),
			array( 'db' => 'UPAH_NAMA',  'dt' => 1 ),
			array( 'db' => 'UPAH_KODE', 'dt' => 2 ),
			array( 'db' => 'SATUAN_UPAH_NAMA',  'dt' => 3 ),
			array( 'db' => 'LOKASI_UPAH_NAMA', 'dt' => 4 ),
			array( 'db' => 'UPAH_HARGA', 'dt' => 5 ),
			array( 'db' => 'SATUAN_UPAH_ID', 'dt' => 6 ),
			array( 'db' => 'LOKASI_UPAH_ID', 'dt' => 7 )
		);
		
		return json_encode(SSP::simple( $_GET, $this->tableName, $this->idField, $columns, $baseSQL));
	}
	
	public function getViewAnalisaUpahById($id){
		$baseSQL = "SELECT `master_upah`.*, `satuan_upah`.`satuan_upah_nama` as SATUAN_UPAH_NAMA, `lokasi_upah`.`lokasi_upah_nama` as LOKASI_UPAH_NAMA FROM (`master_upah`) JOIN `satuan_upah` ON `master_upah`.`satuan_upah_id` = `satuan_upah`.`satuan_upah_id` JOIN `lokasi_upah` ON `master_upah`.`lokasi_upah_id` = `lokasi_upah`.`lokasi_upah_id` WHERE `master_upah`.`upah_active` = 1 AND `lokasi_upah`.lokasi_upah_id = $id";
		
		$columns = array(
			array( 'db' => 'UPAH_NAMA',  'dt' => 0 ),
			array( 'db' => 'UPAH_KODE', 'dt' => 1 ),
			array( 'db' => 'SATUAN_UPAH_NAMA',  'dt' => 2 ),
			array( 'db' => 'LOKASI_UPAH_NAMA', 'dt' => 3 ),
			array( 'db' => 'UPAH_HARGA', 'dt' => 4 ),
			array( 'db' => 'UPAH_ID', 'dt' => 5 )
		);
		
		return json_encode(SSP::simple( $_GET, $this->tableName, $this->idField, $columns, $baseSQL));
	}
}
?>