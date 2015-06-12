<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class mRole extends MY_Model {

    // constants, column definition
    const ID = 'ROLE_ID';
    const NAME = 'ROLE_NAMA';
    const ACTIVE = 'ROLE_ACTIVE';
    const TABLE = "roles";

    public function __construct() {
        parent::__construct();
        $this->tableName = mRole::TABLE;
        $this->idField = mRole::ID;
    }

    public function getUnmappedRoles($mappedRoles = array()) {
        //print_r($mappedRoles);
        if (count($mappedRoles) > 0) {
            $this->db->from(mRole::TABLE);
            $this->db->where_not_in(mRole::ID, $mappedRoles);
            $query = $this->db->get();
            //var_dump($query);
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
        return $this->_select();
    }

}
