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
class Raps extends Plan_Controller {
    
    //1. seluruh fungsi yang tidak public, menggunakan awalan '_' , contoh: _getProperty()
    //2. di atas fungsi diberikan penjelasan proses apa yang dilakukan. dari mana ambil data, 
    //inputnya apa dan outputnya apa. contoh di fungsi index()
    //3. Penamaan fungsi harus PUNUK ONTA dengan awalan huruf kecil $ Menggunakan Bahasa Inggris
    //4. Penamaan nama fungsi maksimal 3 kata

    public function __construct() {
        parent::__construct();
		$this->load->model('mRap');
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
        $this->title="Administrator Dashboard";
        $this->display('acHome',$this->data);
    }
	
	public function detail()
	{
		$idRAB = $this->input->post('id');
		if($idRAB==null) echo $idRAB;
		else {
			$this->data['detail_barang'] = $this->mRap->getViewRapBarangById($idRAB);
			$this->data['detail_upah'] = $this->mRap->getViewRapUpahById($idRAB);
			$this->data['subcon'] = $this->mRap->getViewRapSubconById($idRAB);
			echo json_encode($this->data);
		}
	}
	
	public function viewDetail()
	{
		$this->title="Detail RAP";
		$idRAB = $this->input->get('id');
		if($idRAB==null) redirect(base_url().'projects/project');
		else {
			$this->data['detail_barang'] = $this->mRap->getViewRapBarangById($idRAB);
			$this->data['detail_upah'] = $this->mRap->getViewRapUpahById($idRAB);
			$this->data['subcon'] = $this->mRap->getViewRapSubconById($idRAB);
			$this->data['detail'] = json_encode($this->data);
			$this->display('acRapView', $this->data);
		}
	}

}