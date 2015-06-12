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
class Barang extends Plan_Controller {
    
    //1. seluruh fungsi yang tidak public, menggunakan awalan '_' , contoh: _getProperty()
    //2. di atas fungsi diberikan penjelasan proses apa yang dilakukan. dari mana ambil data, 
    //inputnya apa dan outputnya apa. contoh di fungsi index()
    //3. Penamaan fungsi harus PUNUK ONTA dengan awalan huruf kecil $ Menggunakan Bahasa Inggris
    //4. Penamaan nama fungsi maksimal 3 kata

    public function __construct() {
        parent::__construct();
		$this->left_sidebar= 'lay-left-sidebar/perencanaan';
     	$this->load->model('mBarang');
		$this->load->model('mSatuanBarang');
		$this->load->model('mKategoriBarang');
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
        $this->title="Barang";
		$this->data['satuan'] = $this->mSatuanBarang->_select();
		$this->data['kategori'] = $this->mKategoriBarang->_select();
        $this->display('acBarang',$this->data);
    }

	public function delete(){
		$this->mBarang->_delete(array(mBarang::ID => $this->input->post("tobe_deleted_id")),mBarang::ACTIVE);
		redirect(base_url()."master/barang");
	}
	
	public function update(){
		$id = $this->input->post("bar_id");
		$_updated = array(
			'SATUAN_NAMA' => $this->input->post("sat_nama"),
			'KATEGORI_BARANG_ID' => $this->input->post("kat_bar_id"),
			'BARANG_KODE' => $this->input->post("bar_kode"), 
			'BARANG_NAMA' => $this->input->post("bar_nama"),
			'BARANG_KETERANGAN' => $this->input->post("bar_ket"),
			'BARANG_HARGA' => $this->input->post("bar_harga")
		);
		$this->mBarang->_update($_updated, array(mBarang::ID => $id));
		redirect(base_url()."master/barang");
	}
	
	public function insert(){
		$_inserted = array(
			'SATUAN_NAMA' => $this->input->post("sat_nama"),
			'KATEGORI_BARANG_ID' => $this->input->post("kat_bar_id"),
			'BARANG_KODE' => $this->input->post("bar_kode"), 
			'BARANG_NAMA' => $this->input->post("bar_nama"),
			'BARANG_KETERANGAN' => $this->input->post("bar_ket"),
			'BARANG_HARGA' => $this->input->post("bar_harga")
		);
		$this->mBarang->_insert($_inserted);
		redirect(base_url()."master/barang");
	}
	
	public function getViewBarang(){
		echo $this->mBarang->getViewBarang();
	}
	
	public function getViewAnalisaBarang(){
		echo $this->mBarang->getViewAnalisaBarang();
	}
}