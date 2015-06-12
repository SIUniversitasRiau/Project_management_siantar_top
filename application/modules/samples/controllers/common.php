<?php if (!defined('BASEPATH'))     exit('No direct script access allowed');

//dapat diganti extend dengan *contoh Admin_controller / Aplikan_controller di folder core. 
class Common extends Public_Controller {
    
    //1. seluruh fungsi yang tidak public, menggunakan awalan '_' , contoh: _getProperty()
    //2. di atas fungsi diberikan penjelasan proses apa yang dilakukan. dari mana ambil data, 
    //inputnya apa dan outputnya apa. contoh di fungsi index()
    //3. Penamaan fungsi harus PUNUK ONTA dengan awalan huruf kecil $ Menggunakan Bahasa Inggris
    //4. Penamaan nama fungsi maksimal 3 kata

    public function __construct() {
        parent::__construct();
        
    }

    //penjelasan fungsi index, diletakkan disini... 
    public function index() {
        //file-file yang dipanggil parsial
        $menu = "acTopMenu";
        $header = "acHeader";
        $footer = "acFooter";
        //Set Title
        $this->template->title("Master HMVC-Template - Atcak");
        //Set Layout
        $this->template->set_layout('acMainLayout');
        //set header
        $this->template->set_partial("header", $header);
        //set menu
        $this->template->set_partial("menu", $menu);
        //set footer
        $this->template->set_partial("footer", $footer);
        $this->template->build("acHome.php");
    }
    
    //penjelasan fungsi getBuildingProperty(), diletakkan disini... 
    public function getBuildingProperty() {
        
    }
    
    //penjelasan fungsi getBuildingProperty(), diletakkan disini...
    //contoh private function, diawali _
    private function _getUser()
    {
        
    }

}