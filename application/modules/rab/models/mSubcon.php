<?php
class mSubcon extends MY_Model {

	// constants, column definition
	const ID = 'SUBCON_ID';
	const NAME = 'SUBCON_NAMA';
	

	function __construct() {
        parent::__construct();
		$this->tableName = "subcon";
		$this->idField = mSubcon::ID;
    }
    public function _getRecentID() {
		$query = $this->db->select('MAX('.$this->idField.') as RECENT_ID')->get($this->tableName);
        if ($query->num_rows() > 0) {
            $resultSet = $query->result_array();
            foreach ($resultSet as $row) {
                return $row['RECENT_ID'];
            }
        }
		return null;
    }
  
}
?>