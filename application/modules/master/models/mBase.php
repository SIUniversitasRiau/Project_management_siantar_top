<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class mBase extends CI_Model {

    // describe table name of each mapped table, override this property at subclasses
    protected $tableName;
    protected $idField;

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @param type array
     * @name $column
     * 
     * columns and values specified as formatted array 'column' => 'value'
     * @example 
     * $column = array('user_id' => 2, 'user_name' => 'FOO');
     * save($column)
     * @return boolean : true if success, false otherwise
     */
    public function save($columns) {
        $id = $columns[$this->idField];
        $row = $this->findById($id);
        if (!$row) {
            $this->db->insert($this->tableName, $columns);
        } else {
            $this->db->where($this->idField, $id);
            $this->db->update($this->tableName, $columns);
        }
    }

    /**
     * 
     * @param type number/string depends on id datatype of table
     * @name $id
     * 
     * Id describe the specified primary key of table row which is about to delete
     * ActiveColumn describe the column name that represents flag for functional delete
     * @example 
     * delete(2) : physically deletes the row with primary key 2
     * delete(2, user_active) : functionally delete, or simply put disable the row with primary key 2
     * @return boolean : true if success, false otherwise
     */
    public function delete($id = 0, $activeColumn = 'undefined') {
        $row = $this->findById($id);
        if (!$row) {
            return false;
        }
        if ($activeColumn == 'undefined') {
            $this->db->where($this->idField, $id);
            $this->db->delete($this->tableName);
        } else {
            $row[$activeColumn] = 0;
            $this->save($row);
        }
    }

    /**
     * 
     * @param type integer/string depends on table's primary key data type
     * @return column-formatted array if found, false othewise
     */
    public function findById($id = 0) {
        $result = array();
        if ($id != 0) {
            $query = $this->db->get_where($this->tableName, array($this->idField => $id));
            if ($query->num_rows() > 0) {
                $result = $query->first_row('array');
                return $result;
            }
        }

        return false;
    }

    public function findAll() {
        $result = array();
        $query = $this->db->get($this->tableName);
        if ($query->num_rows() > 0) {
            $it = 0;
            foreach ($query->result_array() as $row) {
                $result[$it++] = $row;
            }
        }
        return $result;
    }

    public function select($columnFilter = array(), $start = 0, $limit = 10) {
        $result = array();
        $query = $this->db->get_where($this->tableName, $columnFilter, $limit, $start);
        if ($query->num_rows() > 0) {
            $it = 0;
            foreach ($query->result_array() as $row) {
                $result[$it++] = $row;
            }
        }
        return $result;
    }

//
    public function find($filters = array()) {
        $result = array();

        $query = $this->db->get_where($this->tableName, $filters);
        if ($query->num_rows() > 0) {
            $resultSet = $query->result_array();
            $it = 0;
            foreach ($resultSet as $row) {
                $result[$it++] = $row;
            }
        }

        return $result;
    }

    public function size() {
        $query = $this->db->get($this->tableName);
        return $query->num_rows();
    }

}
