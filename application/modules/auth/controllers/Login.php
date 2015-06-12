<?php if (!defined('BASEPATH'))     exit('No direct script access allowed');

/*
* 
* @author		Felix - Artcak Media Digital
* @copyright	Copyright (c) 2014
* @link		http://artcak.com
* @since		Version 1.0
 * @description
 * Contoh Tampilan administrator dashbard
 */


class Login extends Auth_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('user-management/mUser'));
    }
    
    
    public function index()
    {
        $this->title="Login";
        
        
        
        $this->display('main');
    }
    function verifylogin()
        {
        
            
            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->title="Login";
                $this->display('main');
            }
            else
            {
                
                //Go to private area
                redirect('rab/rabs/add', 'refresh');
            }
        }
        
        function check_database($password)
        {
            
            $username = $this->input->post('username');
            
            $result = $this->mUser->_find(array(mUser::USERNAME=> $username, 
                                                mUser::PASSWORD=>md5($password),
                                                mUser::ACTIVE=>1 ));
                     
            if($result)
            {
                
                    $sess_array = array(
                            mUser::ID => $result[0][mUser::ID],
                            mUser::NAME=>$result[0][mUser::NAME]
                    );
                    $this->session->set_userdata('logged_in', $sess_array);
                    
                return TRUE;
            }
            else
            {
                $this->form_validation->set_message('check_database', 'Username dan Password salah');
                return false;
            }
        }

}