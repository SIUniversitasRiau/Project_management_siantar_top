<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class mDetailPo extends MY_Model {

    // constants, column definition
    const ID = 'PURCHASE_ORDER_ID';

    public function __construct() {
        parent::__construct();
        $this->tableName = 'detail_po';
        $this->idField = mDetailPo::ID;
    }

    function insert($data) {
        $this->db->insert($this->tableName, $data);
    }

    function insertAndGetLast($data) {
        $this->db->insert($this->tableName, $data);
        return $this->db->insert_id();
    }

}
