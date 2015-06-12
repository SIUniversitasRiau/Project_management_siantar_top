<?php
class mPengguna extends MY_Model {

    // constants, column definition
    const ID = 'PENGGUNA_ID';
    const NAME = 'PENGGUNA_NAMA';
    const ACTIVE = 'PENGGUNA_ACTIVE';

    function __construct() {
        parent::__construct();
        $this->tableName = "pengguna";
        $this->idField = mPengguna::ID;
    }
    
    public function getAllPegawai(){
        $sql = 'select `pengguna`.* ,`departemen`.`DEPARTEMEN_NAMA`
                from `pengguna`
                left join `departemen` on `departemen`.`DEPARTEMEN_ID`=pengguna.`DEPARTEMEN_ID`
                WHERE `PENGGUNA_ACTIVE`=1';
        $query = $this->db->query($sql);
        return $query;
    }
}
?>