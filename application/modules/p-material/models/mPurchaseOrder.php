<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class mPurchaseOrder extends MY_Model {

    // constants, column definition
    const ID = 'PURCHASE_ORDER_ID';

    public function __construct() {
        parent::__construct();
        $this->tableName = 'purchase_order';
        $this->idField = mPurchaseOrder::ID;
    }

    function insert($data) {
        $this->db->insert($this->tableName, $data);
    }

    function insertAndGetLast($data) {
        $this->db->insert($this->tableName, $data);
        return $this->db->insert_id();
    }

    function getTotalPo() {
        $sql = "SELECT *, SUM(`BARANG_HARGA`*`VOLUME_PP`) AS TOTAL FROM view_po
                GROUP BY `PURCHASE_ORDER_ID`
                ORDER BY PURCHASE_ORDER_ID desc";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
