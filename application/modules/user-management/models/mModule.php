<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class mModule extends MY_Model {

    // constants, column definition
    const ID = 'MODULES_ID';
    const NAME = 'MODULES_NAMA';
    const TABLE = 'modules';

    public function __construct() {
        parent::__construct();
        $this->tableName = mModule::TABLE;
        $this->idField = mModule::ID;
    }
    
    public function getModulebyCode($code)
    {
        $sql=('SELECT * FROM modules where  '.mModule::NAME.'=? order by '.mModule::ID.' ASC');
        $query=$this->db->query($sql,array($code));
        $res = $query->row();
        if (count($res) <= 0){
            echo 'hahahaha';
            return;
        }
        else {
            return $query->row()->MODULES_ID;
        }
    }
    
    public function getPermission($idUser,$idModules){
        //disini men-query dulu
        // 1.  Apakah role dari $idUser tersebut
        // 2.  Dari roles tersebut, apa saja modules yang boleh diakses (baik read/write)
        // 3.  Pengecekan apakah ada $idmodules di dalam array tadi
        // 4.  Bila ada, maka OK silahkan masuk
        // 5. Nanti pengaturan read/write diatur kemudian.
        
    }

}
