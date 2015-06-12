<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class mDepartemen extends MY_Model {

    
    // constants, column definition
    const ID = 'DEPARTEMEN_ID';
    const NAME = 'DEPARTEMEN_NAMA';
    const ACTIVE = 'DEPARTEMEN_ACTIVE';
    

    public function __construct() {
        parent::__construct();
        $this->tableName = "departemen";
        $this->idField = mDepartemen::ID;
    }

}
