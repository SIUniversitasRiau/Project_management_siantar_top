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
class Role extends User_Controller {

    //1. seluruh fungsi yang tidak public, menggunakan awalan '_' , contoh: _getProperty()
    //2. di atas fungsi diberikan penjelasan proses apa yang dilakukan. dari mana ambil data, 
    //inputnya apa dan outputnya apa. contoh di fungsi index()
    //3. Penamaan fungsi harus PUNUK ONTA dengan awalan huruf kecil $ Menggunakan Bahasa Inggris
    //4. Penamaan nama fungsi maksimal 3 kata

    public function __construct() {
        parent::__construct();
        $this->load->model('mRole');
        $this->load->model('mModule');
        $this->load->model('mRoleMap');
        $this->load->model('mUser');
        $this->load->model('mUserRole');
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
        $this->title = "Role Management";
        $this->data['roleList'] = $this->mRole->_select(array(mRole::ACTIVE => 1));
        $this->display('acRole', $this->data);
    }

    public function save() {
        $id = $this->input->post(mRole::ID);
        if (intval($id) == 0) { // about to insert a new record
            $column = array(mRole::NAME => $this->input->post(mRole::NAME), mRole::ACTIVE => 1);
            $modules = $this->mModule->_select();
            $this->mRole->_insert($column);
            $last_id = intval($this->mRole->_getRecentID());
            foreach ($modules as $module) {
                $data = array(mRoleMap::ROLE => $last_id, mRoleMap::TYPE => -1, mRoleMap::MODULE => $module[mModule::ID]);
                $this->mRoleMap->_insert($data);
            }
        } else {
            $column = array(mRole::ID => $id, mRole::NAME => $this->input->post(mRole::NAME));
            $this->mRole->_insertOrUpdate($column);
        }
        //print_r($column);


        redirect(base_url() . 'user-management/role');
    }

    public function delete() {
        $id = $this->input->post(mRole::ID);
        //print_r($id);
        $this->mRole->_delete(array(mRole::ID => $id), mRole::ACTIVE);

        redirect(base_url() . 'user-management/role');
    }

    public function manage() {
        $this->title = "Role Management";
        $id = $this->input->post(mRole::ID);
        if (!isset($id) || !$id) {
            redirect(base_url() . 'user-management/role');
            //$id = 1;
        }

        $detail = $this->mRole->_findById($id);
        $modules = $this->mModule->_select();
        $selection = $this->mRoleMap->_find(array(mRoleMap::ROLE => $id));
        //print_r($selection);
        $read = array();
        $read_write = array();
        foreach ($modules as $module) {
            $read[$module[mRoleMap::MODULE]] = '';
            $read_write[$module[mRoleMap::MODULE]] = '';
        }

        foreach ($selection as $item) {
            $read[$item[mRoleMap::MODULE]] = ($item[mRoleMap::TYPE] == mRoleMap::VIEW) ? ' checked="true" ' : '';
            $read_write[$item[mRoleMap::MODULE]] = ($item[mRoleMap::TYPE] == mRoleMap::EDIT) ? ' checked="true" ' : '';
        }
        //var_dump($id);
        //var_dump($detail);
        $this->data['roleDetail'] = $detail;
        $this->data['moduleList'] = $modules;
        $this->data['selectedRole'] = $selection;
        $this->data['roleViews'] = $read;
        $this->data['roleEdits'] = $read_write;
        //var_dump($read);
        //var_dump($read_write);
        $this->display('acRoleManager', $this->data);
    }

    public function mapModulePermission() {
        $role_id = $this->input->post(mRole::ID);
        // Reset all permission 
        $modules = $this->mModule->_select();
        foreach ($modules as $module) {
            $column = array(mRoleMap::TYPE => mRoleMap::NONE);
            $where = array(mRoleMap::ROLE => $role_id, mRoleMap::MODULE => $module[mModule::ID]);
            $this->mRoleMap->_update($column, $where);
        }

        // map current permissions
        if ($this->input->post('view')) {

            $read_permission = $this->input->post('view');
            //var_dump($read_permission);
            foreach ($read_permission as $read) {
                $column = array(
                    mRoleMap::TYPE => mRoleMap::VIEW,
                );
                $where = array(mRoleMap::MODULE => intval($read), mRoleMap::ROLE => $role_id);
                $this->mRoleMap->_update($column, $where);
            }
        }

        if ($this->input->post('edit')) {
            $rw_permission = $this->input->post('edit');
            foreach ($rw_permission as $rw) {
                $column = array(
                    mRoleMap::TYPE => mRoleMap::EDIT,
                );
                $where = array(mRoleMap::MODULE => intval($rw), mRoleMap::ROLE => $role_id);
                $this->mRoleMap->_update($column, $where);
            }
        }
        redirect(base_url() . 'user-management/role');
    }

    public function detail() {
        $this->title = "Role Pengguna";
        $id = $this->input->post(mUser::ID);
        if (!isset($id) || !$id) {
            $id = $this->input->get(mUser::ID);
        }
        if (!isset($id) || !$id) {
            redirect(base_url() . 'user-management/pengguna');
        }
        $roles = $this->mRole->_select();
        $roleKeyPair = array();
        $mappedRoles = $this->mUserRole->_select(array(mUserRole::USER => $id));
        $mappedRolesId = array();
        $it = 0;
        foreach ($mappedRoles as $mr) {
            $mappedRolesId[$it++] = $mr[mUserRole::ROLE];
        }
        $unMappedRoles = $this->mRole->getUnmappedRoles($mappedRolesId);
        foreach ($roles as $role) {
            $roleKeyPair[$role[mRole::ID]] = $role[mRole::NAME];
        }
        
        $this->data['mappedRoles'] = $mappedRoles;
        $this->data['unmappedRoles'] = $unMappedRoles;
        $this->data['roles'] = $roles;
        $this->data['rolesDictionary'] = $roleKeyPair;
        $this->data['userDetail'] = $this->mUser->_findById($id);
        $this->display('acUserRole', $this->data);
    }

    public function addRole() {
        $id = $this->input->post(mUserRole::USER);
        $role = $this->input->post(mUserRole::ROLE);
        if (!isset($id) || !$id) {
            redirect(base_url() . 'user-management/pengguna');
        }
        $columns = array(mUserRole::USER => $id, mUserRole::ROLE => $role);
        //var_dump($columns);
        $this->mUserRole->_insert($columns);
        redirect(base_url() . 'user-management/role/detail?' . mUserRole::USER . '=' . $id);
    }

    public function deleteRole() {
        $id = $this->input->post(mUserRole::USER);
        $role = $this->input->post(mUserRole::ROLE);
        if (!isset($id) || !$id) {
            redirect(base_url() . 'user-management/pengguna');
        }
        $condition = array(mUserRole::ROLE => $role, mUserRole::USER => $id);
        $this->mUserRole->_delete($condition);
        //print_r($condition);
        redirect(base_url() . 'user-management/role/detail?' . mUserRole::USER . '=' . $id);
    }

}
