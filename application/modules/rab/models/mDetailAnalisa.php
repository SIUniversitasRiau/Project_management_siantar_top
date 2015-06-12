<?php
class mDetailAnalisa extends MY_Model {

	// constants, column definition
	const ID = 'DETAIL_ANALISA_ID';
	//const ACTIVE = 'BARANG_ACTIVE';

	function __construct() {
        parent::__construct();
		$this->tableName = "detail_analisa";
		$this->idField = mDetailAnalisa::ID;
    }
	
	public function getDetailBarang($idAnalisa){
		return $this->_joinSelect('detail_analisa', array('master_barang' => 'master_barang.barang_id = detail_analisa.barang_id'), array("detail_analisa.analisa_id" => $idAnalisa), array('detail_analisa.*','master_barang.*'));
	}
	
	public function getDetailUpah($idAnalisa){
		return $this->_joinSelect('detail_analisa', array('master_upah' => 'master_upah.upah_id = detail_analisa.upah_id','satuan_upah' => 'satuan_upah.satuan_upah_id = master_upah.satuan_upah_id','lokasi_upah'=>'master_upah.lokasi_upah_id = lokasi_upah.lokasi_upah_id'), array("detail_analisa.analisa_id" => $idAnalisa), array('detail_analisa.*','master_upah.*','satuan_upah.satuan_upah_nama as SATUAN_UPAH_NAMA','lokasi_upah.lokasi_upah_nama as LOKASI_UPAH_NAMA'));
	}
}
?>