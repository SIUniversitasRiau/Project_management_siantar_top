<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class mPermintaan extends MY_Model {

    // constants, column definition
    const ID = 'PERMINTAAN_PEMBELIAN_ID';
    const PERMINTAAN_PEMBELIAN_KODE = 'PERMINTAAN_PEMBELIAN_KODE';

    public function __construct() {
        parent::__construct();
        $this->tableName = 'permintaan_pembelian';
        $this->idField = mPermintaan::ID;
    }

    function insert($data) {
        $this->db->insert($this->tableName, $data);
    }

    function insertAndGetLast($data) {
        $this->db->insert($this->tableName, $data);
        return $this->db->insert_id();
    }

    function getTotalPp() {
        $sql = "SELECT *, SUM(`BARANG_HARGA`*`VOLUME_PP`) AS TOTAL FROM view_pp
                GROUP BY `PERMINTAAN_PEMBELIAN_ID`
                ORDER BY PERMINTAAN_PEMBELIAN_ID desc";

        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function getListPpProject() {
        $sql = "SELECT * FROM view_pp
                GROUP BY `PROJECT_ID`";

        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    function getListPpByProject($id) {
        $sql = "SELECT * FROM view_pp
                WHERE `PROJECT_ID`=?
                GROUP BY `PERMINTAAN_PEMBELIAN_ID`";

        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }

}
