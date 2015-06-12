<?php

class mProject extends MY_Model {

    // constants, column definition
    const ID = 'PROJECT_ID';
    const NAME = 'PROJECT_NAMA';
    const URL_FOLDER = 'PROJECT_URL_FOLDER';
    const ACTIVE = 'PROJECT_ACTIVE';
    const DATE_CREATED = 'PROJECT_CREATE';
    const DESCRIPTION = 'PROJECT_DESCRIPTION';
    const STATUS_ACTIVE = 0;
    const STATUS_COMPLETE = 1;
    const STATUS_ABORTED = -1;

    function __construct() {
        parent::__construct();
        $this->tableName = "project";
        $this->idField = mProject::ID;
    }

    function insert($table, $data) {
        $this->db->insert($table, $data);
    }

    function insertAndGetLast($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function getViewProject($table, $data) {
        $query = $this->db->get_where($table, $data);
        return $query;
    }
	
	public function getProject(){
		$baseSQL = "SELECT * FROM `project`";
		
		$columns = array(
			array( 'db' => 'PROJECT_ID', 'dt' => 0 ),
			array( 'db' => 'PROJECT_KODE',  'dt' => 1 ),
			array( 'db' => 'PROJECT_NAMA',   'dt' => 2 ),
			array( 'db' => 'PROJECT_CREATE',   'dt' => 3 ),
			array( 'db' => 'PROJECT_ACTIVE',   'dt' => 4 ),
			array( 'db' => 'PROJECT_ACTIVE',   'dt' => 5 )
		);
		
		return json_encode(SSP::simple( $_GET, $this->tableName, $this->idField, $columns, $baseSQL));
	}

}

?>