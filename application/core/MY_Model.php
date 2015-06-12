<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
ob_start();
require_once APPPATH.'/libraries/UrlFactory.php';

class MY_Model extends CI_Model {

    protected $tableName;
    protected $idField;

    public function __construct() {
        parent::__construct();
        
    }

    private $data = array(

    );

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
    
    public function get($name) {
        if (array_key_exists($name, $this->data)) {
           return $this->data[$name];
        }
        else
        {
            echo 'error unset data '.$name;
        }
    }
    
    public function __isset($name) {
        return isset($this->data[$name]);
    }
    
    public function __unset($name) {
        unset($this->data[$name]);
    }

    /**
     *
     * @param type array
     * @name $column
     *
     * column and values specified as formatted array 'column' => 'value'
     * @example
     * _insert(array('ID' => 1, 'NAME' => 'FOO'))
     * @return boolean : true if success, false otherwise
     */
    public function _insert($column){
        $result = $this->db->insert($this->tableName,$column);
        if( !$result ){
           $errNo   = $this->db->_error_number();
           $errMess = $this->db->_error_message();
           echo $errMess;
           return false;
        }

        return true;
    }

    /**
     *
     * @param type array
     * @name $column
     *
     * column and values specified as formatted array 'column' => 'value'
     * @example
     * _insertOrUpdate(array('ID' => 1, 'NAME' => 'FOO'))
     * @return boolean : true if success, false otherwise
     */
    public function _insertOrUpdate($column) {
        $id = $column[$this->idField];
        
        $row = $this->_findById($id);
        
        $result = null;
        if(!$row) {
            $result = $this->_insert($column);
        } else {
            
            $result = $this->_update($column, array($this->idField => $id));
        }

        if( !$result ){
            $errNo   = $this->db->_error_number();
            $errMess = $this->db->_error_message();
            echo $errMess;
            return false;
        }

        return true;
    }

    /**
     *
     * @param type array
     * @name $column, $where
     *
     * column and values specified as formatted array 'column' => 'value' which column to be updated
     * where and values specified as formatted array 'where' => 'value' which column to be conditional parameter
     * @example
     * _update(array('NAME' => 'FOO'), array('ID' => 1))
     * @return boolean : true if success, false otherwise
     */
    public function _update($column=array(),$where=array()) {
        $result = $this->db->update($this->tableName,$column,$where);

        if( !$result ){
            $errNo   = $this->db->_error_number();
            $errMess = $this->db->_error_message();
            echo $errMess;
            return false;
        }

        return true;
    }

    /**
     *
     * @param type number/string depends on id data type of table
     * @name $id
     *
     * Id describe the specified primary key of table row which is about to delete
     * ActiveColumn describe the column name that represents flag for functional delete
     * @example
     * _delete(array('ID' => 2)) : physically deletes the row with primary key as ID = 2
     * _delete(array('ID' => 2), 'user_active') : functionally delete, or simply put disable the row with primary key as ID = 2
     * @return boolean : true if success, false otherwise
     */
    public function _delete($where = array(), $activeColumn = 'undefined') {
        //print_r($activeColumn);
        if ($activeColumn == 'undefined') {
            $this->db->where($where);
            $this->db->delete($this->tableName);
        } else {
			$this->_update(array( $activeColumn => 0), $where);
        }
        return true;
    }

    /**
     *
     * @param type array and integer depends on parameter data type
     * @name $columnFilter, $start, $limit
     *
     * columnFilter describe the where clause
     * start describe the row where query is started
     * limit describe how many record will be queried
     * @example
     * _select() : select all data in table
     * _select(array('user_active' => 1)) : select all data where user_active = 1
     *  _select(array('user_active' => 1), 2, 10) : select data where user_active = 1 from row 2 as many as 10 records or simply until row 12
     * @return array : values if success, null otherwise
     */
    public function _select($columnFilter=array(), $start=0, $limit=-1) {
        if($limit == -1) {
            $limit = $this->_size();
        }

        $query = $this->db->get_where($this->tableName, $columnFilter, $limit, $start);
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

    /**
     *
     * @param type integer
     * @name $id
     *
     * id describe specified row id as where clause
     * @example
     * _findById(2) : select data where id = 2
     * @return array : values if success, null otherwise
     */
    public function _findById($id = 0) {
        $result = array();
        if ($id != 0) {
            $query = $this->db->get_where($this->tableName, array($this->idField => $id));
            if ($query->num_rows() > 0) {
                $result = $query->first_row('array');
                return $result;
            }
        }

        return null;
    }

    public function _find($filters = array()) {
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

	public function _getRecentID() {
		$query = $this->db->select('MAX('.$this->idField.') as RECENT_ID')->get($this->tableName);
        if ($query->num_rows() > 0) {
            $resultSet = $query->result_array();
            foreach ($resultSet as $row) {
                return $row['RECENT_ID'];
            }
        }
		return null;
    }
	
    public function _size() {
        $query = $this->db->get($this->tableName);
        return $query->num_rows();
    }
    
    
	
	public function _joinSelect($from, $joinTable = array(), $filters = array(), $fields = array(), $start=0, $limit=-1){
		$selectField = implode(', ', $fields);
		$this->db->select($selectField)->from($from);
		foreach($joinTable as $key => $value)
		{
		  $this->db->join($key, $value);
		}
		$query = null;
		if($limit == -1) {
			$query = $this->db->where($filters)->get();
        } else {
			$query = $this->db->where($filters)->limit($limit, $start)->get();
		}
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