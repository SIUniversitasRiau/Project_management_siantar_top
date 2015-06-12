<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* controller di setiap modul dapat extends pada controller admin. Berfungsi untuk membatasi hak akses */

class Admin_Controller extends MY_Controller {

    protected $data = array(
    );
    
    protected $nmModule;
    protected $idModule;
    protected $status=NULL;
    
    function __construct() {

        parent::__construct();
        $this->load->model(array('user-management/mUserRole'));

        $this->theme_folder = 'default';
        $this->_set_idModule();

        //tambahkan pemanggilan _getPermit di sini.....
        $statusPermit = $this->_getPermit();
        if ($statusPermit == NLOGIN) {
            redirect('auth/Login');
        } else if ($statusPermit == NPERMITTED) {
            $message_403 = "Maaf, Anda tidak memiliki akses ke bagian ini.";
            $heading = "Akses ditolak!";
            show_error($message_403, 403, $heading);
        }

        $this->data['username'] = $this->_activeUser;
        $this->data['iduseractive'] = $this->_idUserActive;
            //print_r($this->db->hostname);
        // [$index]['columnName'] 
        // available column: mUserRole::MODULE_NAME, mUserRole::ROLE_NAME
        // available value : mUserRole::ROLE_VIEW, mUserRole::ROLE_EDIT
       // $this->data['modules'] = $this->mUserRole->getModules($this->_idUserActive);
        //print_r($this->data['modules']);
    }

    private function _set_idModule() {

        $this->nmModule = $this->router->fetch_class();
        $this->idModule = $this->mModule->getModulebyCode($this->nmModule);
        //print_r('hai'.$this->idModule);
    }

    protected function _getPermit() {
        
    
        if (!$this->_getSession())
            return NLOGIN; //belum login
            
// 
        // Di sini mengecek apakah orang tersebut boleh mengakses data dengan ID Module ini.
        // Jika ada 1 data saja, berarti dianggap boleh.
        // $this->idModule bisa digunakan :D untuk melihat id dari IdModule yang diakses tersebut.
        // Nanti parameternya cukup 2 saja. yaitu
        // 1. ID User sekarang
        // 2. ID Modulenya sekarang
        // 
        // Unutk urusan read dan wreitenya nanti dulu saja. Buat itu dulu
        // $datas= $this->mModule->getPermission($this->_idUsersPermit,
        //         $this->_idUserActive, $this->idModule);
        //if (count($datas)>0) return PERMITTED; //permitted 
        //return NPERMITTED;//belum ada akses
        //if($this->_authorize())
       // $previlege = $this->_authorize();
       // return ($previlege) ? PERMITTED : NPERMITTED;
        return PERMITTED;
    }
    
    /**
     * 
     * mUserRole::ROLE_UNAUTHORIZED = -1
     * mUserRole::ROLE_VIEW = 0
     * mUserRole::ROLE_EDIT = 1
     * 
     * 
     */
    private function _authorize(){
        $previlege = $this->mUserRole->getPermission($this->_idUserActive, $this->idModule);
        
        return $previlege >= $this->status;
    }
    
    

}

?>
