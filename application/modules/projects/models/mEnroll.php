<?php
class mEnroll extends MY_Model {

	// constants, column definition
	const PENGGUNA_ID = 'PENGGUNA_ID';
	const PENUGASAN_ID = 'PENUGASAN_ID';
	const PROJECT_ID = 'PROJECT_ID';

    function __construct() {
    parent::__construct();
        $this->tableName = "enroll";
        $this->idField = mEnroll::PENGGUNA_ID;
    }
    
    public function delete($pengguna, $penugasan, $project){
        $this->db->delete($this->tableName, 
                array(
                    mEnroll::PENGGUNA_ID => $pengguna,
                    mEnroll::PENUGASAN_ID => $penugasan,
                    mEnroll::PROJECT_ID => $project,
                )
        );
    }
    
//    public function update($pengguna, $penugasan, $project){
//        $data= array(
//                    mEnroll::PENGGUNA_ID => $pengguna,
//                    mEnroll::PENUGASAN_ID => $penugasan,
//                    mEnroll::PROJECT_ID => $project,
//                );
//        $this->db->where($columnId, $idValue);
//        $this->db->update($this->tableName, $data);
//    }
    
}
?>