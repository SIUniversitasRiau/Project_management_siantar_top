<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class mPosisi extends MY_Model {

    
    // constants, column definition
    const ID = 'POSISI_ID';
    const NAME = 'POSISI_NAMA';
    const ACTIVE = 'POSISI_ACTIVE';
    

    public function __construct() {
        parent::__construct();
        $this->tableName = "posisi";
        $this->idField = mPosisi::ID;
    }

}
