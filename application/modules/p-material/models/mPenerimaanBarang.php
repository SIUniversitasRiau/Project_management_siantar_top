<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class mPenerimaanBarang extends MY_Model {

    // constants, column definition
    const ID = 'PENERIMAAN_BARANG_ID';

    public function __construct() {
        parent::__construct();
        $this->tableName = 'penerimaan_barang';
        $this->idField = mPurchaseOrder::ID;
    }

    function insert($data) {
        $this->db->insert($this->tableName, $data);
    }

    function insertAndGetLast($data) {
        $this->db->insert($this->tableName, $data);
        return $this->db->insert_id();
    }

    function getTotalPB() {
        $sql = "SELECT *, SUM(`HARGA_MATERI_PO`*`VOLUME_LPB`) AS TOTAL FROM view_lpb
                GROUP BY `PENERIMAAN_BARANG_ID`
                ORDER BY PENERIMAAN_BARANG_ID desc";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
