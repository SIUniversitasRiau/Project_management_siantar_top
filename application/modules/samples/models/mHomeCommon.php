<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class mHomeCommon extends CI_model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    
}