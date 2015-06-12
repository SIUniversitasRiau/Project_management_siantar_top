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
class Supplier extends Plan_Controller {

    //1. seluruh fungsi yang tidak public, menggunakan awalan '_' , contoh: _getProperty()
    //2. di atas fungsi diberikan penjelasan proses apa yang dilakukan. dari mana ambil data, 
    //inputnya apa dan outputnya apa. contoh di fungsi index()
    //3. Penamaan fungsi harus PUNUK ONTA dengan awalan huruf kecil $ Menggunakan Bahasa Inggris
    //4. Penamaan nama fungsi maksimal 3 kata

    public function __construct() {
        parent::__construct();
        $this->left_sidebar = 'lay-left-sidebar/pelaksanaan';
        $this->load->model('mSupplier');
        $this->load->model('mKategoriSupplier');
        $this->load->model('mPajakSupplier');
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
        $this->title = "Master Supplier";
        $fields = array('master_supplier.*', 'pajak_supplier.PAJAK_SUPPLIER_NAMA', 'kategori_supplier.KATEGORI_SUPPLIER_NAMA');
        $selectField = implode(', ', $fields);
        $this->db->select($selectField)->from(mSupplier::TABLE);
        $this->db->join(mPajakSupplier::TABLE, mPajakSupplier::TABLE . '.' . mPajakSupplier::ID . ' = ' . mSupplier::TABLE . '.' . mSupplier::TAX, 'left');
        $this->db->join(mKategoriSupplier::TABLE, mKategoriSupplier::TABLE . '.' . mKategoriSupplier::ID . ' = ' . mSupplier::TABLE . '.' . mSupplier::CATEGORY, 'left');
        $query = $this->db->where(array(mSupplier::TABLE . '.' . mSupplier::ACTIVE => 1))->get();
        $result = array();
        if (!$query) {
            $errNo = $this->db->_error_number();
            $errMess = $this->db->_error_message();
            return null;
        } else if ($query->num_rows() > 0) {
            $it = 0;
            foreach ($query->result_array() as $row) {
                $result[$it++] = $row;
            }
        }
        $this->data['listSupplier'] = $result;
        $this->data['listKategoriSupplier'] = $this->mKategoriSupplier->_select(array(mKategoriSupplier::ACTIVE => 1));
        $this->data['listPajakSupplier'] = $this->mPajakSupplier->_select(array(mPajakSupplier::ACTIVE => 1));
        $this->display('acSupplier', $this->data);
    }

    public function delete() {
        $this->mSupplier->_delete(array(mSupplier::ID => $this->input->post("tobe_deleted_id")), mSupplier::ACTIVE);
        redirect(base_url() . "master/supplier");
    }

    public function update() {
        $id = $this->input->post("SUPPLIER_ID");
        $input = $this->input->post();
        $this->mSupplier->_update($input, array(mSupplier::ID => $id));
        redirect(base_url() . "master/supplier");
    }

    public function insert() {
        $input = $this->input->post();
        $this->mSupplier->_insert($input);
        redirect(base_url() . "master/supplier");
    }

}
