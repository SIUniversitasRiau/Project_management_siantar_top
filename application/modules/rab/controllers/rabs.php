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
class Rabs extends Plan_Controller {

    //1. seluruh fungsi yang tidak public, menggunakan awalan '_' , contoh: _getProperty()
    //2. di atas fungsi diberikan penjelasan proses apa yang dilakukan. dari mana ambil data, 
    //inputnya apa dan outputnya apa. contoh di fungsi index()
    //3. Penamaan fungsi harus PUNUK ONTA dengan awalan huruf kecil $ Menggunakan Bahasa Inggris
    //4. Penamaan nama fungsi maksimal 3 kata

    public function __construct() {
        parent::__construct();
        $this->load->model('mAnalisa');
        $this->load->model('master/mSatuanBarang');
		$this->load->model('master/mLokasiUpah');
        $this->load->model(array('mRab','mDetailRab','mKategoriPekerjaan','mSubcon'));
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
        $this->title = "Dashboard Perencanaan";
        $array = array();
        $this->data['listAnalisa'] = $this->mAnalisa->_select($array, 0, 2);
        $this->display('acHome', $this->data);
    }

    public function add() {
		if($this->input->post('project_id')==null) redirect(base_url()."projects/project");
		
		$this->data['project_id'] = $this->input->post('project_id');
		$this->data['estimator_id'] = $this->input->post('estimator_id');
        $this->title = "Dashboard Perencanaan";
        $this->data['satuan'] = $this->mSatuanBarang->_select();
        $this->data['analisa'] = $this->mAnalisa->_select();
		$this->data['lokasi'] = $this->mLokasiUpah->_select();
        $this->display('acRabAdd', $this->data);
    }
	
	public function edit()
    {
        $this->title="RAB";
		$idRAB = $this->input->post('id_to_edit');
		if($idRAB==null) redirect(base_url()."projects/project");
		else {
			$this->data['detail_pekerjaan'] = $this->mDetailRab->getDetailPekerjaan($idRAB);
			$this->data['rab'] = $this->mRab->_select(array(mRab::ID => $idRAB));
			$this->data['satuan'] = $this->mSatuanBarang->_select();
			$this->data['analisa'] = $this->mAnalisa->_select();
			$this->data['lokasi'] = $this->mLokasiUpah->_select();
			$this->display('acRabEdit', $this->data);
		}
    }
	
	public function simpanRAB()
	{
        //$estimator = $this->_idUserActive;
		$estimatorId=$this->input->post('estimatorID');
        $projectId=$this->input->post('projectID');
		$namaRAB = $this->input->post('nama');
		$kodeRAB = $this->input->post('kode');
		$satuanRAB = $this->input->post('satuan');
		$totalRAB = $this->input->post('total');
		$lokasiRAB = $this->input->post('lokasi');
        
        $rabActive=1;
        $rabStatus=1;
        $_insertedRAB = array(
			'RAB_NAMA' => $namaRAB, 
			'RAB_KODE' => $kodeRAB, 
			'ESTIMATOR_ID' => $estimatorId,
			'PROJECT_ID' => $projectId,
			'RAB_TOTAL' => $totalRAB,
            'RAB_ACTIVE' => $rabActive,
            'RAB_STATUS_APPROVAL_ID' => $rabStatus,
			'LOKASI_UPAH_ID' => $lokasiRAB
		);
                
        //insert into database RAB_Transaction;
        $this->mRab->_insert($_insertedRAB);
        $idNewRAB = $this->mRab->_getRecentID();
                
                
        //insert Items of RAB
		$items = json_decode($this->input->post('items'));
        $this->_insertItems($items,$idNewRAB);       
		echo "success";
	}
	
	public function updateRAB()
	{
        //$estimator = $this->_idUserActive;
        $projectId=$this->input->post('projectID');
		$idRAB = $this->input->post('id');
		$namaRAB = $this->input->post('nama');
		$kodeRAB = $this->input->post('kode');
		$satuanRAB = $this->input->post('satuan');
		$totalRAB = $this->input->post('total');
		$lokasiRAB = $this->input->post('lokasi');
        
        $rabActive=1;
        $rabStatus=1;
        $_updatedRAB = array(
			'RAB_NAMA' => $namaRAB, 
			'RAB_KODE' => $kodeRAB, 
			'PROJECT_ID' => $projectId,
			'RAB_TOTAL' => $totalRAB,
            'RAB_ACTIVE' => $rabActive,
            'RAB_STATUS_APPROVAL_ID' => $rabStatus,
			'LOKASI_UPAH_ID' => $lokasiRAB
		);
                
        //insert into database RAB_Transaction;
        $this->mRab->_update($_updatedRAB, array(mRab::ID => $idRAB));
		$this->mDetailRab->_delete(array('RAB_ID' => $idRAB));
                
                
        //insert Items of RAB
		$items = json_decode($this->input->post('items'));
        $this->_insertItems($items,$idRAB);       
		echo "success";
	}
	
	
    private function _insertItems($items,$idRAB){
		foreach($items as $item){
			$_insertedKategori= array(
				'KATEGORI_PEKERJAAN_NAMA' => $item->nama_kategori,
				'KATEGORI_PEKERJAAN_URUTAN' => $item->urutan
			);
			$this->mKategoriPekerjaan->_insert($_insertedKategori);
			$idNewKategori = $this->mKategoriPekerjaan->_getRecentID();
			
			foreach ($item->items as $it)
			{
				if ($it->id==="LS"){
					$_insertedNewSubcon = array(
					  'SUBCON_NAMA'  => $it->nama,
						'SUBCON_HARGA' => $it->harga,
						'SATUAN_NAMA' =>$it->satuan,
						
					);
					$this->mSubcon->_insert($_insertedNewSubcon);
					$idNewSubcon = $this->mSubcon->_getRecentID();
					
					$_insertedDetailPekerjaan = array(
						'KATEGORI_PEKERJAAN_ID' => $idNewKategori, 
						'SUBCON_ID' => $idNewSubcon,
						'RAB_ID' => $idRAB,
						'DETAIL_PEKERJAAN_VOLUME' => $it->volume,
						'DETAIL_PEKERJAAN_TOTAL' => $it->total,
						'DETAIL_PEKERJAAN_URUTAN' => $it->urutan
					);
					$this->mDetailRab->_insert($_insertedDetailPekerjaan);
				}
				else {
					$_insertedDetailPekerjaan = array(
						'KATEGORI_PEKERJAAN_ID' => $idNewKategori, 
						'ANALISA_ID' => $it->id,
						'RAB_ID' => $idRAB,
						'DETAIL_PEKERJAAN_VOLUME' => $it->volume,
						'DETAIL_PEKERJAAN_TOTAL' => $it->total,
						'DETAIL_PEKERJAAN_URUTAN' => $it->urutan
					);  
					$this->mDetailRab->_insert($_insertedDetailPekerjaan);
				}
			}
		}
	}
	
	public function getViewRabById(){
		$id = $this->input->get("project_id");
		echo $this->mRab->getViewRabById($id);
	}
	
	public function detail(){
		$idRAB = $this->input->post('id');
		if($idRAB==null) echo $idRAB;
		else {
			$this->data['detail_pekerjaan'] = $this->mDetailRab->getDetailPekerjaan($idRAB);
			echo json_encode($this->data);
		}
	}
}
