<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class mDetailLPB extends MY_Model {

    // constants, column definition
    const ID = 'PENERIMAAN_BARANG_ID';

    public function __construct() {
        parent::__construct();
        $this->tableName = 'detail_lpb';
        $this->idField = mDetailLPB::ID;
    }

    function insert($data) {
        $this->db->insert($this->tableName, $data);
    }

    function insertAndGetLast($data) {
        $this->db->insert($this->tableName, $data);
        return $this->db->insert_id();
    }

}
