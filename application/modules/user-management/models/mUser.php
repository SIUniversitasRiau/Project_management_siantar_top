<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class mUser extends MY_Model {

    
    // constants, column definition
    const ID = 'PENGGUNA_ID';
    const NAME = 'PENGGUNA_NAMA';
    const USERNAME = 'PENGGUNA_USERNAME';
    const PASSWORD = 'PENGGUNA_PASSWORD';
    const PASSWORD_VALIDATION = 'PENGGUNA_PASSWORD_VAL';
    const EMAIL = 'PENGGUNA_EMAIL';
    const HP = 'PENGGUNA_HP';
    const ACTIVE = 'PENGGUNA_ACTIVE';
    const DATE_CREATED = 'PENGGUNA_DAFTAR';
    const DEPARTEMEN = 'DEPARTEMEN_ID';
    const TABLE = "PENGGUNA";
    const MUTASI = "MUTASI";
    const EDIT_LOGON_INFO = "EDIT_LOGON";

        public function __construct() {
        parent::__construct();
        $this->tableName = 'pengguna';
        $this->idField = mUser::ID;
    }

   

   


}
