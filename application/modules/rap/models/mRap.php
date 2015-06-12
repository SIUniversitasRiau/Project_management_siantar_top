<?php
class mRap extends MY_Model {

	// constants, column definition
	function __construct() {
        parent::__construct();
		$this->tableName = "rab_transaction";
		$this->idField = "";
    }
  
	public function getViewRapBarangById($id){
		$sql = "SELECT master_barang.*, SUM(detail_pekerjaan.DETAIL_PEKERJAAN_VOLUME*detail_analisa.DETAIL_ANALISA_KOEFISIEN) AS BARANG_VOLUME FROM detail_pekerjaan 
		JOIN master_analisa ON detail_pekerjaan.ANALISA_ID = master_analisa.ANALISA_ID  
		JOIN kategori_paket_pekerjaan ON detail_pekerjaan.KATEGORI_PEKERJAAN_ID = kategori_paket_pekerjaan.KATEGORI_PEKERJAAN_ID 
		JOIN detail_analisa ON master_analisa.ANALISA_ID = detail_analisa.ANALISA_ID 
		JOIN master_barang ON detail_analisa.BARANG_ID = master_barang.BARANG_ID
		WHERE detail_pekerjaan.RAB_ID = $id 
		GROUP BY master_barang.BARANG_ID";
		
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
	
	public function getViewRapUpahById($id){
		$sql = "SELECT master_upah.*, satuan_upah.satuan_upah_nama AS SATUAN_UPAH_NAMA, SUM(detail_pekerjaan.DETAIL_PEKERJAAN_VOLUME*detail_analisa.DETAIL_ANALISA_KOEFISIEN) AS UPAH_VOLUME FROM detail_pekerjaan 
		JOIN master_analisa ON detail_pekerjaan.ANALISA_ID = master_analisa.ANALISA_ID  
		JOIN kategori_paket_pekerjaan ON detail_pekerjaan.KATEGORI_PEKERJAAN_ID = kategori_paket_pekerjaan.KATEGORI_PEKERJAAN_ID 
		JOIN detail_analisa ON master_analisa.ANALISA_ID = detail_analisa.ANALISA_ID 
		JOIN master_upah ON detail_analisa.UPAH_ID = master_upah.UPAH_ID
		JOIN satuan_upah ON satuan_upah.SATUAN_UPAH_ID = master_upah.SATUAN_UPAH_ID
		WHERE detail_pekerjaan.RAB_ID = $id
		GROUP BY master_upah.UPAH_ID";
		
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
	
	public function getViewRapSubconById($id){
		$sql = "SELECT * FROM detail_pekerjaan 
		JOIN subcon ON subcon.SUBCON_ID = detail_pekerjaan.SUBCON_ID  
		JOIN kategori_paket_pekerjaan ON detail_pekerjaan.KATEGORI_PEKERJAAN_ID = kategori_paket_pekerjaan.KATEGORI_PEKERJAAN_ID 
		WHERE detail_pekerjaan.RAB_ID = $id";
		
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