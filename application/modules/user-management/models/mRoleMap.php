<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class mRoleMap extends MY_Model {

    // constants, column definition
    const TYPE = 'TIPE_ID';
    const MODULE = 'MODULES_ID';
    const ROLE = 'ROLE_ID';
    const TABLE = 'hak_akses';
    
    const ROLE_EDIT = 'ROLE_EDIT';
    const ROLE_VIEW = 'ROLE_VIEW';
    const ROLE_NONE = 'ROLE_NONE';
    
    const EDIT = 1;
    const VIEW = 0;
    const NONE = -1;

    
    
        

    public function __construct() {
        parent::__construct();
        $this->tableName = mRoleMap::TABLE;
        $this->idField = mRoleMap::TYPE;
    }
    
    public function getAllModules($role_id){
        $result = $this->_find(array(mRoleMap::ROLE => $role_id));
        
        
    }

}
