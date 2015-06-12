<?php
class mRab extends MY_Model {

	// constants, column definition
	const ID = 'RAB_ID';
	const NAME = 'RAB_NAMA';
	const ACTIVE = 'RAB_ACTIVE';

	function __construct() {
        parent::__construct();
		$this->tableName = "rab_transaction";
		$this->idField = mRab::ID;
    }
  
	public function getViewRabById($id){
		$baseSQL = "SELECT `rab_transaction`.*, `rab_status_approval`.`rab_status_approval_nama` as RAB_STATUS_APPROVAL_NAMA, `lokasi_upah`.`lokasi_upah_nama` as LOKASI_UPAH_NAMA FROM (`rab_transaction`) JOIN `rab_status_approval` ON `rab_transaction`.`rab_status_approval_id` = `rab_status_approval`.`rab_status_approval_id` JOIN `lokasi_upah` ON `rab_transaction`.`lokasi_upah_id` = `lokasi_upah`.`lokasi_upah_id` WHERE `rab_transaction`.`rab_active` = 1 AND `rab_transaction`.`project_id` = $id";
		
		$columns = array(
			array( 'db' => 'RAB_KODE', 'dt' => 0 ),
			array( 'db' => 'RAB_NAMA',  'dt' => 1 ),
			array( 'db' => 'RAB_TOTAL',  'dt' => 2 ),
			array( 'db' => 'LOKASI_UPAH_NAMA', 'dt' => 3 ),
			array( 'db' => 'RAB_STATUS_APPROVAL_NAMA', 'dt' => 4 ),
			array( 'db' => 'RAB_ID', 'dt' => 5 )
		);
		
		return json_encode(SSP::simple( $_GET, $this->tableName, $this->idField, $columns, $baseSQL));
	}
}
?>