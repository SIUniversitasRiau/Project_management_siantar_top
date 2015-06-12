<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
define("PERMITTED", 1);
define("NPERMITTED", 0);
define("NLOGIN", -1);
define("BYPASS", 100);

require_once APPPATH.'/libraries/UrlFactory.php';
require_once APPPATH.'/libraries/SSP.php';


/*
* @package		Controller - CIMasterArtcak
* @author		Felix - Artcak Media Digital
* @copyright	Copyright (c) 2014
* @link		http://artcak.com
* @since		Version 1.0
 * @description
 * Abstrack kelas MY_Controller dibuat untuk kustomisasi dari MX_Controller dalam hal
 * 1. Pemanggilan templating dengan fungsi Display
 * 2. Pergantian theme layout, partial theme dan script
 * 3. Setter Getter in PHP
 */
        
        
abstract class MY_Controller extends MX_Controller {

    /*What string should be used to separate title segments sent via $this->template->title('Foo', 'Bar'); */
    
    private $_folderHeader='lay-header/';
    private $_folderFooter='lay-footer/';
    private $_folderLeft='lay-left-sidebar/';
    private $_folderRight='lay-right-sidebar/';
    private $_folderScript='lay-scripts/';
    
    protected $_activeUser;
    protected $_idUsersPermit;
    protected $_idUserActive;
    
    
    private $data = array(
        
        'theme_folder' => '',
        'theme_layout' => 'template',
        'header' => 'lay-header/default',
        'footer' => 'lay-footer/default',
        'left_sidebar' => 'lay-left-sidebar/default',
        'right_sidebar' => 'lay-right-sidebar/default',
        'script_header' =>'lay-scripts/header-default',
        'script_footer' =>'lay-scripts/footer-default'
        
    );
    
    /*
     * Setter dan Getter
     */
    
    
    
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
    
    public function get($name)
    {
        if (array_key_exists($name, $this->data)) {
           return $this->data[$name];
        }
        else
        {
            echo 'error unset data '.$name;
        }
    }
    public function __isset($name) {
        return isset($this->data[$name]);
    }
    
    public function __unset($name) {
        unset($this->data[$name]);
    }
    
    /**
    * Construct dari My Controller
    * @package Controller
    * @todo finish Modules dan Permission
    */
   
   
    public function __construct() {
            parent::__construct();  
            
            //bug untuk form_validation
            $this->form_validation->CI =& $this; 
            
            
//            $this->_idUsersPermit = $this->module_m->getAkunsDelegation($this->idApp);
//            $statusPermit = $this->_getPermit();
//            if ($statusPermit==BYPASS && $this->data['idModule']==10) //controller manage
//                redirect(base_url().'documents');
//            if ($statusPermit==NPERMITTED && $this->data['idModule']==2) //controller document
//                redirect(base_url().'documents/manage');
//            if ($statusPermit== NLOGIN) 
//            {
//                //echo 'test';
//                redirect(UrlFactory::Instance()->getProtocol().UrlFactory::Instance()->getHostName().'/integrarsud');
//            }
//            else if ($statusPermit==NPERMITTED)
//            {
//                $message_403 = "Maaf, Anda tidak memiliki akses ke bagian ini.";
//                $heading="Akses ditolak!";
//                show_error($message_403 , 403,$heading); 
//
//            }
        }
        
        
        public function display($view_page,$content=array())
	{
            $content['nama']="Testing Admin";
            
            //nice to be able to set title right in the controller in one shot. 
            //Before using template, I had to keep passing the title value here and 
            //there till it reached the header where finally it could get echoed.
            $this->template->title($this->data['title'],"Project Management - Siantar Top");

            //'default_theme' is a folder name.
            $this->template->set_theme($this->data['theme_folder']);

            //This layout file can use $template['variables'] to put your contents
            $this->template->set_layout($this->data['theme_layout']);

            //setting partials view. see the image above for header.php and footer.php locations.
            //these will be available in layout file as $template['partials']['header'] and 
            //$template['partials']['footer']
            $this->template->set_partial('header',$this->data['header'],$content);
            $this->template->set_partial('footer',$this->data['footer'],$content);
            $this->template->set_partial('left-sidebar',$this->data['left_sidebar'],$content);
            $this->template->set_partial('right-sidebar',$this->data['right_sidebar'],$content);
            $this->template->set_partial('script-header',$this->data['script_header'],$content);
            $this->template->set_partial('script-footer',$this->data['script_footer'],$content);
            
            
            //the main content view that contains about page's content. 
            //this will be available in layout file as $template['body']
            
            $res= $this->template->build($view_page,$content);
            return $res;    
            
	}
        
        
         /*
        * @package		MY_CONTROLLER SESSION
        * @author		Felix - Artcak Media Digital
        * @copyright	Copyright (c) 2014
        * @link		http://artcak.com
        * @since		Version 1.0
         */
        protected function _getSession()
        {
            if($this->session->userdata('logged_in'))
            {
                $user_session = $this->session->userdata('logged_in');
            
                $this->_activeUser= $user_session['PENGGUNA_NAMA'];
                $this->_idUserActive= $user_session['PENGGUNA_ID'];   

                $this->data['username']=$this->_activeUser;
                $this->data['iduseractive']=$this->_idUserActive;
                return true;
            }
            else
            {
                return false;
            }
        }
        
        abstract  protected function _getPermit();
        
     
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */