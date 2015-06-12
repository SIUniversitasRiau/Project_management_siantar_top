<?php
class mAnalisa extends MY_Model {

	// constants, column definition
	const ID = 'ANALISA_ID';
	const NAME = 'ANALISA_NAMA';
	const ACTIVE = 'ANALISA_ACTIVE';

	function __construct() {
        parent::__construct();
		$this->tableName = "master_analisa";
		$this->idField = mAnalisa::ID;
    }
	
	public function getViewAnalisa(){
		$baseSQL = "SELECT `master_analisa`.*, `lokasi_upah`.lokasi_upah_nama AS LOKASI_UPAH_NAMA FROM (`master_analisa`) JOIN `lokasi_upah` ON `master_analisa`.`lokasi_upah_id` = `lokasi_upah`.`lokasi_upah_id` WHERE `master_analisa`.`analisa_active` = 1";
		
		$columns = array(
			array( 'db' => 'ANALISA_KODE', 'dt' => 0 ),
			array( 'db' => 'ANALISA_NAMA',  'dt' => 1 ),
			array( 'db' => 'ANALISA_TOTAL',  'dt' => 2 ),
			array( 'db' => 'LOKASI_UPAH_NAMA',  'dt' => 3 ),
			array( 'db' => 'ANALISA_ID', 'dt' => 4 )
		);
		
		return json_encode(SSP::simple( $_GET, $this->tableName, $this->idField, $columns, $baseSQL));
	}
	
	public function getViewAnalisaById($id){
		$baseSQL = "SELECT `master_analisa`.*, `lokasi_upah`.lokasi_upah_nama AS LOKASI_UPAH_NAMA FROM (`master_analisa`) JOIN `lokasi_upah` ON `master_analisa`.`lokasi_upah_id` = `lokasi_upah`.`lokasi_upah_id` WHERE `master_analisa`.`analisa_active` = 1 AND `master_analisa`.lokasi_upah_id = $id";
		
		$columns = array(
			array( 'db' => 'ANALISA_KODE', 'dt' => 0 ),
			array( 'db' => 'ANALISA_NAMA',  'dt' => 1 ),
			array( 'db' => 'SATUAN_NAMA',  'dt' => 2 ),
			array( 'db' => 'LOKASI_UPAH_NAMA',  'dt' => 3 ),
			array( 'db' => 'ANALISA_TOTAL',  'dt' => 4 ),
			array( 'db' => 'ANALISA_ID', 'dt' => 5 )
		);
		
		return json_encode(SSP::simple( $_GET, $this->tableName, $this->idField, $columns, $baseSQL));
	}
}
?>