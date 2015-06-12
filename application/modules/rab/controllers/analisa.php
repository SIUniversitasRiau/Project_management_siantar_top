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
class Analisa extends Plan_Controller {
    
    //1. seluruh fungsi yang tidak public, menggunakan awalan '_' , contoh: _getProperty()
    //2. di atas fungsi diberikan penjelasan proses apa yang dilakukan. dari mana ambil data, 
    //inputnya apa dan outputnya apa. contoh di fungsi index()
    //3. Penamaan fungsi harus PUNUK ONTA dengan awalan huruf kecil $ Menggunakan Bahasa Inggris
    //4. Penamaan nama fungsi maksimal 3 kata

    public function __construct() {
        parent::__construct();
        
        $this->left_sidebar= 'lay-left-sidebar/perencanaan';
        $this->load->model('mAnalisa');
		$this->load->model('mDetailAnalisa');
		$this->load->model('mKategoriAnalisa');
		$this->load->model('master/mSatuanBarang');
		$this->load->model('master/mUpah');
		$this->load->model('master/mLokasiUpah');
		$this->load->model('master/mBarang');
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
        $this->title="Master Analisa";
        $this->status=  mUserRole::ROLE_VIEW;
		$this->data['analisa'] = $this->mAnalisa->_select();
        $this->display('acAnalisaView', $this->data);
    }
	
	public function add()
    {
        $this->title="Master Analisa";
        
		$this->data['satuan'] = $this->mSatuanBarang->_select();
		$this->data['lokasi'] = $this->mLokasiUpah->_select();
		$this->data['kategori'] = $this->mKategoriAnalisa->_select();
        $this->display('acAnalisaAdd', $this->data);
    }
	
	public function detail()
	{
		$this->title = "Detail Analisa";
		$idAnalisa = $this->input->post('id');
		if($idAnalisa==null) echo $idAnalisa;
		else {
			$this->data['detail_barang'] = $this->mDetailAnalisa->getDetailBarang($idAnalisa);
			$this->data['detail_upah'] = $this->mDetailAnalisa->getDetailUpah($idAnalisa);
			echo json_encode($this->data);
		}
	}
	
	public function edit()
    {
        $this->title="Master Analisa";
		$idAnalisa = $this->input->post('id_to_edit');
		if($idAnalisa==null) redirect(base_url()."rab/analisa");
		else {
			$this->data['detail_barang'] = $this->mDetailAnalisa->getDetailBarang($idAnalisa);
			$this->data['detail_upah'] = $this->mDetailAnalisa->getDetailUpah($idAnalisa);
			$this->data['satuan'] = $this->mSatuanBarang->_select();
			$this->data['lokasi'] = $this->mLokasiUpah->_select();
			$this->data['kategori'] = $this->mKategoriAnalisa->_select();
			$this->data['analisa'] = $this->mAnalisa->_select(array(mAnalisa::ID => $idAnalisa));
			$this->display('acAnalisaEdit', $this->data);
		}
    }
	
	public function delete(){
		$idAnalisa = $this->input->post("tobe_deleted_id");
		$this->mAnalisa->_delete(array(mAnalisa::ID => $idAnalisa),mAnalisa::ACTIVE);
		redirect(base_url()."rab/analisa");
	}
	
	public function simpanAnalisa()
	{
		$namaAnalisa = $this->input->post('nama');
		$kodeAnalisa = $this->input->post('kode');
		$satuanAnalisa = $this->input->post('satuan');
		$lokasiAnalisa = $this->input->post('lokasi');
		$kategoriAnalisa = $this->input->post('kategori');
		$totalAnalisa = $this->input->post('total');
		$barangAnalisa = json_decode($this->input->post('barang'));
		$upahAnalisa = json_decode($this->input->post('upah'));
		
		$_insertedAnalisa = array(
			'SATUAN_NAMA' => $satuanAnalisa, 
			'KATEGORI_ANALISA_ID' => $kategoriAnalisa, 
			'LOKASI_UPAH_ID' => $lokasiAnalisa, 
			'ANALISA_KODE' => $kodeAnalisa, 
			'ANALISA_NAMA' => $namaAnalisa,
			'ANALISA_TOTAL' => $totalAnalisa,
			'ANALISA_ACTIVE' => 1
		);
		$this->mAnalisa->_insert($_insertedAnalisa);
		$idAnalisa = $this->mAnalisa->_getRecentID();
		foreach($barangAnalisa as $item){
			$_insertedDetailAnalisa = array(
				'BARANG_ID' => $item->id, 
				'ANALISA_ID' => $idAnalisa,
				'DETAIL_ANALISA_KOEFISIEN' => $item->koef,
				'DETAIL_ANALISA_HARGA' => $item->harga,
				'DETAIL_ANALISA_TOTAL' => $item->total
			);
			$this->mDetailAnalisa->_insert($_insertedDetailAnalisa);
		}
		foreach($upahAnalisa as $item){
			$_insertedDetailAnalisa = array(
				'UPAH_ID' => $item->id, 
				'ANALISA_ID' => $idAnalisa,
				'DETAIL_ANALISA_KOEFISIEN' => $item->koef,
				'DETAIL_ANALISA_HARGA' => $item->harga,
				'DETAIL_ANALISA_TOTAL' => $item->total
			);
			$this->mDetailAnalisa->_insert($_insertedDetailAnalisa);
		}
		echo "success";
	}
	
	public function updateAnalisa()
	{
		$idAnalisa = $this->input->post('id');
		$namaAnalisa = $this->input->post('nama');
		$kodeAnalisa = $this->input->post('kode');
		$satuanAnalisa = $this->input->post('satuan');
		$lokasiAnalisa = $this->input->post('lokasi');
		$kategoriAnalisa = $this->input->post('kategori');
		$totalAnalisa = $this->input->post('total');
		$barangAnalisa = json_decode($this->input->post('barang'));
		$upahAnalisa = json_decode($this->input->post('upah'));
		$_updatedAnalisa = array(
			'SATUAN_NAMA' => $satuanAnalisa, 
			'KATEGORI_ANALISA_ID' => $kategoriAnalisa, 
			'LOKASI_UPAH_ID' => $lokasiAnalisa, 
			'ANALISA_KODE' => $kodeAnalisa, 
			'ANALISA_NAMA' => $namaAnalisa,
			'ANALISA_TOTAL' => $totalAnalisa,
			'ANALISA_ACTIVE' => 1
		);
		$this->mAnalisa->_update($_updatedAnalisa, array(mAnalisa::ID => $idAnalisa));
		$this->mDetailAnalisa->_delete(array('ANALISA_ID' => $idAnalisa));
		foreach($barangAnalisa as $item){
			$_insertedDetailAnalisa = array(
				'BARANG_ID' => $item->id, 
				'ANALISA_ID' => $idAnalisa,
				'DETAIL_ANALISA_KOEFISIEN' => $item->koef,
				'DETAIL_ANALISA_HARGA' => $item->harga,
				'DETAIL_ANALISA_TOTAL' => $item->total
			);
			$this->mDetailAnalisa->_insert($_insertedDetailAnalisa);
		}
		foreach($upahAnalisa as $item){
			$_insertedDetailAnalisa = array(
				'UPAH_ID' => $item->id, 
				'ANALISA_ID' => $idAnalisa,
				'DETAIL_ANALISA_KOEFISIEN' => $item->koef,
				'DETAIL_ANALISA_HARGA' => $item->harga,
				'DETAIL_ANALISA_TOTAL' => $item->total
			);
			$this->mDetailAnalisa->_insert($_insertedDetailAnalisa);
		}
		echo "success";
	}
	
	public function getViewAnalisa(){
		echo $this->mAnalisa->getViewAnalisa();
	}
	
	public function getViewAnalisaById(){
		$id = $this->input->get("lokasi_id");
		echo $this->mAnalisa->getViewAnalisaById($id);
	}
}
