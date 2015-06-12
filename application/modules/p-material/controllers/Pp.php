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
class Pp extends Implementation_Controller {

    //1. seluruh fungsi yang tidak public, menggunakan awalan '_' , contoh: _getProperty()
    //2. di atas fungsi diberikan penjelasan proses apa yang dilakukan. dari mana ambil data, 
    //inputnya apa dan outputnya apa. contoh di fungsi index()
    //3. Penamaan fungsi harus PUNUK ONTA dengan awalan huruf kecil $ Menggunakan Bahasa Inggris
    //4. Penamaan nama fungsi maksimal 3 kata

    public function __construct() {
        parent::__construct();
        $this->load->model('projects/mProject');
        $this->load->model('rab/mRab');
        $this->load->model('mPermintaan');
        $this->load->model('mDetailTransaksiPP');
        $this->load->model('master/mGudang');
        $this->title = "Permintaan Pembelian";
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
        $this->data['listPp'] = $this->mPermintaan->getTotalPp();
        //print_r($this->data['listPp']);
        $this->display('acPp', $this->data);
    }

    public function viewNewPp() {
//        $this->script_footer = 'lay-scripts/footer-addProject';
        $array = array();
        $this->data['listProject'] = $this->mProject->_select($array);
        $this->data['listRab'] = $this->mRab->_select($array);
        $this->data['listKategoriPp'] = $this->db->get_where('kategori_pp', $array)->result_array();
        $this->data['listGudang'] = $this->mGudang->_select($array);
        $this->display('acPpAdd', $this->data);
    }

    public function getCurrentRab() {
        $PROJECT_ID = $this->input->post('PROJECT_ID');
        $query = $this->mRab->_select(array('PROJECT_ID' => $PROJECT_ID));
        echo json_encode($query);
    }

    public function getCurrentRAP() {
        $PROJECT_ID = $this->input->post('PROJECT_ID');
        $RAB_ID = $this->input->post('RAB_ID');
        $KATEGORI_PP_ID = $this->input->post('KATEGORI_PP_ID');
        $listRAP = $this->db->get_where('view_rap', array('RAB_ID' => $RAB_ID))->result_array();
        echo json_encode($listRAP);
    }

    public function newPp() {
        $flag= $this->input->post('flag');
        if($flag==1) //dari view 1 adalah Proses Setujui
            $STATUS_PP_ID=2;
        else if ($flag==0) //dari view 0 adalah Draft
            $STATUS_PP_ID=1;
        $pp = array(
            'PERMINTAAN_PEMBELIAN_KODE' => $this->input->post('PERMINTAAN_PEMBELIAN_KODE'),
            'PERMINTAAN_PEMBELIAN_NAMA' => $this->input->post('PERMINTAAN_PEMBELIAN_NAMA'),
            'PROJECT_ID' => $this->input->post('PROJECT_ID'),
            'KATEGORI_PP_ID' => $this->input->post('KATEGORI_PP_ID'),
            'STATUS_PP_ID' => $STATUS_PP_ID,
            'GUDANG_ID' => $this->input->post('GUDANG_ID')
        );
        $PERMINTAAN_PEMBELIAN_ID = $this->mPermintaan->insertAndGetLast($pp);
        $BARANG_ID = $this->input->post('BARANG_ID');
        $VOLUME_PP = $this->input->post('VOLUME');
        for ($i = 0; $i < sizeof($BARANG_ID); $i++) {
            $detail_transaksi = array(
                'PERMINTAAN_PEMBELIAN_ID' => $PERMINTAAN_PEMBELIAN_ID,
                'BARANG_ID' => $BARANG_ID[$i],
                'VOLUME_PP' => $VOLUME_PP[$i]
            );
            $this->mDetailTransaksiPP->insert($detail_transaksi);
        }

        redirect(base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) . '/viewDetail/' . $PERMINTAAN_PEMBELIAN_ID);
    }

    public function viewDetail($PERMINTAAN_PEMBELIAN_ID) {
        $this->data['listPp'] = $this->db->get_where('view_pp', array('PERMINTAAN_PEMBELIAN_ID'=>$PERMINTAAN_PEMBELIAN_ID))->result_array();
        $this->display('acPpDetail', $this->data);
    }
}
