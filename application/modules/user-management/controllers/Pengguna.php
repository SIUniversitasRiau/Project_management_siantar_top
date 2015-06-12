<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * @package		Controller - CIMasterArtcak
 * @author		Felix - Artcak Media Digital
 * @copyright	Copyright (c) 2014
 * @link		http://artcak.com
 * @since		Version 1.0
 * @description
 * Contoh Tampilan administrator dashbard
 */

//dapat diganti extend dengan *contoh Admin_controller / Aplikan_controller di folder core. 
// Nama kelas harus sama dengan nama file php
class Pengguna extends User_Controller {

    //1. seluruh fungsi yang tidak public, menggunakan awalan '_' , contoh: _getProperty()
    //2. di atas fungsi diberikan penjelasan proses apa yang dilakukan. dari mana ambil data, 
    //inputnya apa dan outputnya apa. contoh di fungsi index()
    //3. Penamaan fungsi harus PUNUK ONTA dengan awalan huruf kecil $ Menggunakan Bahasa Inggris
    //4. Penamaan nama fungsi maksimal 3 kata

    public function __construct() {
        parent::__construct();
        $this->header = 'lay-header/default';
        $this->footer = 'lay-footer/default';
        $this->left_sidebar = 'lay-left-sidebar/user_management';
        $this->load->model('mBase');
        $this->load->model('mDepartemen');
        $this->load->model('mUser');
    }

    /*
     * Digunakan untuk menampilkan dashboard di awal. Setiap tampilan view, harap menggunakan fungsi
     * index(). Pembentukan view terdiri atas:
     * 1. Title
     * 2. Set Partial Header
     * 3. Set Partial Right Top Menu
     * 4. Set Partial Left Menu
     * 5. Body
     * 6. Data-data tambahan yang diperlukan
     * Jika tidak di-set, maka otomatis sesuai dengan default
     */

    public function index() {
        // Dua hal ini wajib di-code agar keluar data title dan memanggil view
        $this->title = "Master Pengguna";
        $this->data['departementList'] = $this->mDepartemen->_select(array(mDepartemen::ACTIVE => 1));
        $this->data['userList'] = $this->mUser->_select(array(mUser::ACTIVE => 1));
        $userDepartemenMap = array();
        foreach ($this->data['departementList'] as $dept) {
            $userDepartemenMap[$dept[mDepartemen::ID]] = $dept[mDepartemen::NAME];
        }
        $this->data['userDepartementMap'] = $userDepartemenMap;
        $this->display('acPengguna', $this->data);
    }

    public function save() {

        $id = $this->input->post(mUser::ID);
        $data = array();
        if ($id == 0) { // about to insert
            $data = array(
                mUser::NAME => $this->input->post(mUser::NAME),
                mUser::DEPARTEMEN => $this->input->post(mUser::DEPARTEMEN),
                mUser::USERNAME => $this->input->post(mUser::USERNAME),
                mUser::PASSWORD => md5($this->input->post(mUser::PASSWORD)),
                mUser::EMAIL => $this->input->post(mUser::EMAIL),
                mUser::HP => $this->input->post(mUser::HP),
                mUser::ACTIVE => 1
            );
            $this->mUser->_insert($data);
        } else {
            $data = array(
                mUser::NAME => $this->input->post(mUser::NAME),
                mUser::EMAIL => $this->input->post(mUser::EMAIL),
                mUser::HP => $this->input->post(mUser::HP),
                mUser::ACTIVE => 1
            );

            if ($this->input->post(mUser::MUTASI) == "checked") { // update user departement
                $data[mUser::DEPARTEMEN] = $this->input->post(mUser::DEPARTEMEN);
            }

            if ($this->input->post(mUser::EDIT_LOGON_INFO) == "checked") { // update login information
                $data[mUser::USERNAME] = $this->input->post(mUser::USERNAME);
                $data[mUser::PASSWORD] = md5($this->input->post(mUser::PASSWORD));
            }
            $this->mUser->_update($data, array(mUser::ID => $id));
            //print_r($data);
        }

        redirect(base_url() . "user-management/pengguna");
    }

    public function delete() {
        $id = $this->input->post(mUser::ID);
        $this->mUser->_delete($id, mUser::ACTIVE);

        redirect(base_url() . 'user-management/pengguna');
    }

}
