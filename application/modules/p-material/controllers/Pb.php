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
class Pb extends Implementation_Controller {
    
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
        $this->load->model('mPenerimaanBarang');
        $this->load->model('mDetailLPB');
        $this->load->model('mDetailPo');
        $this->load->model('master/mSupplier');
        $this->title = "Penerimaan Barang";
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
        $this->data['listPb'] = $this->mPenerimaanBarang->getTotalPb();
        $this->display('acPb', $this->data);
    }
    
    public function viewNewPb(){
        $array = array();
        $this->db->group_by('PURCHASE_ORDER_ID');
        $this->data['listPo'] = $this->db->get('view_po')->result_array();
        $this->display('acPbAdd', $this->data);
    }
    
    public function getCurrentPO(){
        $PURCHASE_ORDER_ID= $this->input->post('PURCHASE_ORDER_ID');
        $query = $this->db->get_where('view_po', array('PURCHASE_ORDER_ID'=>$PURCHASE_ORDER_ID))->result_array();
        echo json_encode($query);
    }
    
    public function newPB(){
        $flag= $this->input->post('flag');
         if($flag==1) //dari view 1 adalah Proses Setujui
            $STATUS_LPB_ID=2;
        else if ($flag==0) //dari view 0 adalah Draft
            $STATUS_LPB_ID=1;
        $pb = array(
            'PENERIMAAN_BARANG_KODE' => $this->input->post('PENERIMAAN_BARANG_KODE'),
            'PENERIMAAN_BARANG_NAMA' => $this->input->post('PENERIMAAN_BARANG_NAMA'),
            'LPB_SURAT_JALAN'=> $this->input->post('LPB_SURAT_JALAN'),
            'LPB_KENDARAAN'=> $this->input->post('LPB_KENDARAAN'),
            'PURCHASE_ORDER_ID'=> $this->input->post('PURCHASE_ORDER_ID'),
            'SUPPLIER_ID'=> $this->input->post('SUPPLIER_ID'),
            'STATUS_LPB_ID'=>$STATUS_LPB_ID
        );
//        var_dump($pb);
        $PENERIMAAN_BARANG_ID = $this->mPenerimaanBarang->insertAndGetLast($pb);
        $BARANG_ID = $this->input->post('BARANG_ID');
        $VOLUME = $this->input->post('VOLUME');
        for ($i = 0; $i < sizeof($BARANG_ID); $i++) {
            $detail_pb = array(
                'PENERIMAAN_BARANG_ID' => $PENERIMAAN_BARANG_ID,
                'BARANG_ID' => $BARANG_ID[$i],
                'VOLUME_LPB' => $VOLUME[$i]
            );
//            var_dump($detail_pb);
            $this->mDetailLPB->insert($detail_pb);
        }
        redirect(base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) . '/viewDetail/' . $PENERIMAAN_BARANG_ID);
    }
    
    public function viewDetail($PENERIMAAN_BARANG_ID){
        $this->data['listPb'] = $this->db->get_where('view_lpb', array('PENERIMAAN_BARANG_ID'=>$PENERIMAAN_BARANG_ID))->result_array();
        $this->display('acPbDetail', $this->data);
    }

}