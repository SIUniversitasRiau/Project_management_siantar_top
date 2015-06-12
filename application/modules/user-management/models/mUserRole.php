<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class mUserRole extends MY_Model {

    // constants, column definition
    const USER = 'PENGGUNA_ID';
    const ROLE = 'ROLE_ID';
    const TABLE = 'penggunaxroles';
    const ROLE_UNAUTHORIZED = -1;
    const ROLE_VIEW = 0;
    const ROLE_EDIT = 1;

    public function __construct() {
        parent::__construct();
        $this->tableName = mUserRole::TABLE;
        $this->idField = mUserRole::USER;
    }

    public function getModules($user_id) {
        $sql = "SELECT m.MODULES_NAMA as module," .
                " case h.TIPE_ID " .
                "WHEN 0 THEN 'view' " .
                "WHEN 1 THEN 'edit' " .
                "END AS previlege " .
                "FROM pengguna p " .
                "JOIN penggunaxroles r ON p.PENGGUNA_ID = r.PENGGUNA_IDJOIN roles rl ON rl.ROLE_ID = r.ROLE_ID " .
                "JOIN modules m " .
                "JOIN hak_akses h ON h.MODULES_ID = m.MODULES_ID AND h.ROLE_ID = r.ROLE_ID and p.PENGGUNA_ID = " . $user_id . " and h.TIPE_ID >= 0;";

        $query = $this->db->query($sql);
        $result = array();
        if (!$query) {
            $errNo = $this->db->_error_number();
            $errMess = $this->db->_error_message();
            return null;
        } else if ($query->num_rows() > 0) {
            $it = 0;
            foreach ($query->result_array() as $row) {
                $result[$it++] = $row;
            }
        }
        return $result;
    }

    public function getPermission($user_id, $module_id) {
        $sql = "SELECT h.TIPE_ID " . 
                "FROM penggunaxroles pr " . 
                "JOIN roles r ON pr.ROLE_ID = r.ROLE_ID ". 
                "JOIN modules m " .
                "JOIN hak_akses h ON h.MODULES_ID = m.MODULES_ID AND h.ROLE_ID = r.ROLE_ID ".
                "WHERE pr.PENGGUNA_ID = " . $user_id . " and m.MODULES_ID = " . $module_id;
        //print_r("Sql " . $sql);
        $query = $this->db->query($sql);
        //print_r($query->result_array());
        $result = 0;
        if (!$query) {
            $errNo = $this->db->_error_number();
            $errMess = $this->db->_error_message();
            return null;
        } else if ($query->num_rows() > 0) {
            $it = 0;
            foreach ($query->result_array() as $row) {
                $result = $row['TIPE_ID'];
            }
        }
        return $result;
    }

}
