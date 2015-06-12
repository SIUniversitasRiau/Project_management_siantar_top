<?php if (!defined('BASEPATH'))     exit('No direct script access allowed');

/* controller di setiap modul dapat extends pada controller aplikan. Berfungsi untuk membatasi hak akses*/
class Public_Controller extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->theme_folder='default'; 
        $this->header= 'lay-header/default';
        $this->footer= 'lay-footer/default';
        $this->left_sidebar= 'lay-left-sidebar/user_management';
    }

}

?>
