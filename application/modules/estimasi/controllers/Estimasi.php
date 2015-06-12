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
class Estimasi extends Plan_Controller {

    //1. seluruh fungsi yang tidak public, menggunakan awalan '_' , contoh: _getProperty()
    //2. di atas fungsi diberikan penjelasan proses apa yang dilakukan. dari mana ambil data, 
    //inputnya apa dan outputnya apa. contoh di fungsi index()
    //3. Penamaan fungsi harus PUNUK ONTA dengan awalan huruf kecil $ Menggunakan Bahasa Inggris
    //4. Penamaan nama fungsi maksimal 3 kata

    public function __construct() {
        parent::__construct();
        $this->load->model('mRabTransaction');
        $this->load->model('rab/mRab');
        $this->load->model('projects/mProject');
        $this->load->model('projects/mPengguna');
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
        $this->title = "Estimation Dashboard";
        $estimations = $this->mRabTransaction->estimationView();
        $this->data['estimations'] = $estimations;
        $rabTransaction = array(
            mRabTransaction::ID => 0,
            mRabTransaction::BUILDING_LIFETIME => 0,
            mRabTransaction::WORKERS => 0,
            mRabTransaction::WHEATER_FACTOR => 0,
            mRabTransaction::TOTAL_TIME => 0,
            mRabTransaction::STATUS_APPROVAL => 1
        );
        $this->data['rabTransaction'] = $rabTransaction;
        $this->data['acEstimationTab'] = $this->load->view('acEstimationTab', $this->data, TRUE);
        //print_r($estimations);
        $this->display('acEstimation', $this->data);
    }

    public function save() {
        $id = $this->input->post(mRabTransaction::ID);
        $rabTransactions = $this->mRabTransaction->estimationView($id);
        $rab = $rabTransactions[0];
        $total_upah = doubleval($rab['TOTAL_UPAH']);
        $koefisien_upah = doubleval($rab['KOEFISIEN_UPAH']);
        $mandays = ceil($total_upah / $koefisien_upah);
        $nworker = max(array(intval($this->input->post(mRabTransaction::WORKERS)), 1));
        $nwheater = max(array(intval($this->input->post(mRabTransaction::WHEATER_FACTOR)), 1));
        $nbuilding = max(array(intval($this->input->post(mRabTransaction::BUILDING_LIFETIME)), 1));
        $totaldaynperson = ceil($mandays / $nworker);
        $total = intval($totaldaynperson) + $nwheater + $nbuilding;
        $columns = array(
            mRabTransaction::WORKERS => $nworker,
            mRabTransaction::WHEATER_FACTOR => $nwheater,
            mRabTransaction::BUILDING_LIFETIME => $nbuilding,
            mRabTransaction::TOTAL_TIME => $total
        );
        //print_r($columns);
        $this->mRabTransaction->_update($columns, array(mRabTransaction::ID => $id));
        redirect(base_url() . "estimasi/estimasi");
    }

    public function validate() {
        $id = $this->input->post(mRabTransaction::ID);
        $validator = $this->data['iduseractive'];

        $this->mRabTransaction->_update(array(mRabTransaction::VALIDATOR => $validator, mRabTransaction::STATUS_APPROVAL => 2), array(mRabTransaction::ID => $id));
        redirect(base_url() . "estimasi/estimasi");
    }

}
