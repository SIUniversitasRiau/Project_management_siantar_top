<?php if (!defined('BASEPATH'))     exit('No direct script access allowed');

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
class Po extends Implementation_Controller {
    
    //1. seluruh fungsi yang tidak public, menggunakan awalan '_' , contoh: _getProperty()
    //2. di atas fungsi diberikan penjelasan proses apa yang dilakukan. dari mana ambil data, 
    //inputnya apa dan outputnya apa. contoh di fungsi index()
    //3. Penamaan fungsi harus PUNUK ONTA dengan awalan huruf kecil $ Menggunakan Bahasa Inggris
    //4. Penamaan nama fungsi maksimal 3 kata

    public function __construct() {
        parent::__construct();
        $this->load->model('projects/mProject');
        $this->load->model('rab/mRab');
        $this->load->model('mPurchaseOrder');
        $this->load->model('mPermintaan');
        $this->load->model('mDetailTransaksiPP');
        $this->load->model('mDetailPo');
        $this->load->model('master/mSupplier');
        $this->title = "Purchase Order";
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
    public function index()
    {
        $this->data['listPo'] = $this->mPurchaseOrder->getTotalPo();
        $this->display('acPo', $this->data);
    }
    
    public function viewNewPo(){
        $array = array();
        $this->data['listProject'] = $this->mPermintaan->getListPpProject();
        $this->data['listPengguna'] = $this->mSupplier->_select();
        $this->display('acPoAdd', $this->data);
    }
    
    public function getPpbyProject(){
        $PROJECT_ID= $this->input->post('PROJECT_ID');
        $query = $this->mPermintaan->getListPpByProject($PROJECT_ID);
        echo json_encode($query);
    }
    
    public function getCurrentPP(){
        $PROJECT_ID= $this->input->post('PROJECT_ID');
        $PERMINTAAN_PEMBELIAN_ID= $this->input->post('PERMINTAAN_PEMBELIAN_ID');
        $query = $this->db->get_where('view_pp', array('PROJECT_ID'=>$PROJECT_ID, 'PERMINTAAN_PEMBELIAN_ID'=>$PERMINTAAN_PEMBELIAN_ID))->result_array();
        echo json_encode($query);
    }
    
    public function newPO(){
        $flag= $this->input->post('flag');
         if($flag==1) //dari view 1 adalah Proses Setujui
            $STATUS_PO_ID=2;
        else if ($flag==0) //dari view 0 adalah Draft
            $STATUS_PO_ID=1;
        $pp = array(
            'PERMINTAAN_PEMBELIAN_ID' => $this->input->post('PERMINTAAN_PEMBELIAN_ID'),
            'SUPPLIER_ID' => $this->input->post('SUPPLIER_ID'),
            'PURCHASE_ORDER_NAMA'=> $this->input->post('PURCHASE_ORDER_NAMA'),
            'PURCHASE_ORDER_KODE'=> $this->input->post('PURCHASE_ORDER_KODE'),
            'STATUS_PO_ID'=>$STATUS_PO_ID
        );
        $PURCHASE_ORDER_ID = $this->mPurchaseOrder->insertAndGetLast($pp);
        $BARANG_ID = $this->input->post('BARANG_ID');
        $VOLUME = $this->input->post('VOLUME');
        $HARGA_MATERI_PO = $this->input->post('HARGA_MATERI_PO');
        for ($i = 0; $i < sizeof($BARANG_ID); $i++) {
            $detail_po = array(
                'PURCHASE_ORDER_ID' => $PURCHASE_ORDER_ID,
                'BARANG_ID' => $BARANG_ID[$i],
                'VOLUME_PO' => $VOLUME[$i],
                'HARGA_MATERI_PO' => $HARGA_MATERI_PO[$i]
            );
            $this->mDetailPo->insert($detail_po);
        }
        redirect(base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) . '/viewDetail/' . $PURCHASE_ORDER_ID);
    }
    
    public function viewDetail($PURCHASE_ORDER_ID){
        $this->data['listPo'] = $this->db->get_where('view_po', array('PURCHASE_ORDER_ID'=>$PURCHASE_ORDER_ID))->result_array();
        $this->display('acPoDetail', $this->data);
    }

}