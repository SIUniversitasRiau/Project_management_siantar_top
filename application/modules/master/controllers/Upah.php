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
class Upah extends Plan_Controller {
    
    //1. seluruh fungsi yang tidak public, menggunakan awalan '_' , contoh: _getProperty()
    //2. di atas fungsi diberikan penjelasan proses apa yang dilakukan. dari mana ambil data, 
    //inputnya apa dan outputnya apa. contoh di fungsi index()
    //3. Penamaan fungsi harus PUNUK ONTA dengan awalan huruf kecil $ Menggunakan Bahasa Inggris
    //4. Penamaan nama fungsi maksimal 3 kata

    public function __construct() {
        parent::__construct();
		$this->left_sidebar= 'lay-left-sidebar/perencanaan';
        $this->load->model('mUpah');
		$this->load->model('mLokasiUpah');
		$this->load->model('mSatuanUpah');
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
        // Dua hal ini wajib di-code agar keluar data title dan memanggil view
        $this->title="Upah";
		$this->data['satuan'] = $this->mSatuanUpah->_select();
		$this->data['lokasi'] = $this->mLokasiUpah->_select();
        $this->display('acUpah',$this->data);
    }
	
	public function delete(){
		$this->mUpah->_delete(array(mUpah::ID => $this->input->post("tobe_deleted_id")), mUpah::ACTIVE);
		redirect(base_url()."master/upah");
	}
	
	public function update(){
		$id = $this->input->post("upah_id");
		$_updated = array(
			'LOKASI_UPAH_ID' => $this->input->post("lokasi_upah_id"),
			'SATUAN_UPAH_ID' => $this->input->post("sat_upah_id"),
			'UPAH_KODE' => $this->input->post("upah_kode"), 
			'UPAH_HARGA' => $this->input->post("upah_harga"), 
			'UPAH_NAMA' => $this->input->post("upah_nama")
		);
		$this->mUpah->_update($_updated, array(mUpah::ID => $id));
		redirect(base_url()."master/upah");
	}
	
	public function insert(){
		$lokasi = $this->mLokasiUpah->_select();
		$_inserted = array(
			'LOKASI_UPAH_ID' => $this->input->post("lokasi_upah_id"),
			'SATUAN_UPAH_ID' => $this->input->post("sat_upah_id"),
			'UPAH_KODE' => $this->input->post("upah_kode"), 
			'UPAH_HARGA' => $this->input->post("upah_harga"), 
			'UPAH_NAMA' => $this->input->post("upah_nama")
		);
		$this->mUpah->_insert($_inserted);
		redirect(base_url()."master/upah");
	}
	
	public function getViewUpah(){
		echo $this->mUpah->getViewUpah();
	}
	
	public function getViewAnalisaUpah(){
		$id = $this->input->get("lokasi_id");
		echo $this->mUpah->getViewAnalisaUpahById($id);
	}
}