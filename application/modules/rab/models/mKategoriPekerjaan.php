<?php
class mKategoriPekerjaan extends MY_Model {

	// constants, column definition
	const ID = 'KATEGORI_PEKERJAAN_ID';
	//const ACTIVE = 'BARANG_ACTIVE';

	function __construct() {
        parent::__construct();
		$this->tableName = "kategori_paket_pekerjaan";
		$this->idField = mKategoriPekerjaan::ID;
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