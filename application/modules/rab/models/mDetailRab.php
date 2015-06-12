<?php
class mDetailRab extends MY_Model {

	// constants, column definition
	const ID = 'DETAIL_PEKERJAAN_ID';
	//const ACTIVE = 'BARANG_ACTIVE';

	function __construct() {
        parent::__construct();
		$this->tableName = "detail_pekerjaan";
		$this->idField = mDetailRab::ID;
    }
	
	public function getDetailPekerjaan($id){
        $sql = "SELECT *, master_analisa.satuan_nama AS SATUAN_ANALISA_NAMA, subcon.satuan_nama AS SATUAN_SUBCON_NAMA FROM detail_pekerjaan LEFT JOIN master_analisa ON detail_pekerjaan.ANALISA_ID = master_analisa.ANALISA_ID LEFT JOIN subcon ON subcon.SUBCON_ID = detail_pekerjaan.SUBCON_ID JOIN kategori_paket_pekerjaan ON detail_pekerjaan.KATEGORI_PEKERJAAN_ID = kategori_paket_pekerjaan.KATEGORI_PEKERJAAN_ID WHERE detail_pekerjaan.RAB_ID = $id";
        $query = $this->db->query($sql);
		$result = array();
        if(!$query) {
            $errNo   = $this->db->_error_number();
            $errMess = $this->db->_error_message();
            return null;
        }
        else if ($query->num_rows() > 0) {
            $it = 0;
            foreach ($query->result_array() as $row) {
                $result[$it++] = $row;
            }
        }
        return $result;
    }
}
?>