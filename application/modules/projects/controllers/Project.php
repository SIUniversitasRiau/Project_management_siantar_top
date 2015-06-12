<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 
 * @author		Felix - Artcak Media Digital
 * @copyright	Copyright (c) 2014
 * @link		http://artcak.com
 * @since		Version 1.0
 * @description
 * Contoh Tampilan administrator dashbard
 */

class Project extends Plan_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mProject');
        $this->load->model('mPengguna');
        $this->load->model('mEnroll');
        $this->load->model('user-management/mDepartemen');
    }

    public function index() {
        $this->title = "Daftar Project";
        $this->display('acHome', $this->data);
    }

    public function viewAddNew() {
        $this->script_footer = 'lay-scripts/footer-addProject';
        $this->title = "Project Baru";
        $this->data['listDepartement'] = $this->mDepartemen->_select();
        $this->data['listPengguna'] = $this->mPengguna->getAllPegawai()->result_array();
        $this->display('newProject', $this->data);
    }

    public function addNew() {
        $data = array(
//            'PROJECT_ID'=>$this->input->post('PROJECT_ID'),
            'PROJECT_NAMA' => $this->input->post('PROJECT_NAME'),
            'PROJECT_KODE' => $this->input->post('PROJECT_KODE'),
            'PROJECT_DESCRIPTION' => $this->input->post('PROJECT_DESCRIPTION'),
            'PROJECT_ACTIVE' => 1
        );
        $projectID = $this->mProject->insertAndGetLast('project', $data);

        $creator = $this->input->post("CREATOR");
        foreach ($creator as $temp => $row) {
            $data = array(
                'PENGGUNA_ID' => $row,
                'PENUGASAN_ID' => 1, //creator
                'PROJECT_ID' => $projectID
            );
            $this->mProject->insert('enroll', $data);
        }

        $estimator = $this->input->post("ESTIMATOR");
        foreach ($estimator as $temp => $row) {
            $data = array(
                'PENGGUNA_ID' => $row,
                'PENUGASAN_ID' => 2, //estimator
                'PROJECT_ID' => $projectID
            );
            $this->mProject->insert('enroll', $data);
        }

        $pm = $this->input->post("PM");
        foreach ($pm as $temp => $row) {
            $data = array(
                'PENGGUNA_ID' => $row,
                'PENUGASAN_ID' => 3, //pm
                'PROJECT_ID' => $projectID
            );
            $this->mProject->insert('enroll', $data);
        }

        $pp = $this->input->post("PP");
        foreach ($pp as $temp => $row) {
            $data = array(
                'PENGGUNA_ID' => $row,
                'PENUGASAN_ID' => 4, //pp
                'PROJECT_ID' => $projectID
            );
            $this->mProject->insert('enroll', $data);
        }

        $po = $this->input->post("PO");
        foreach ($po as $temp => $row) {
            $data = array(
                'PENGGUNA_ID' => $row,
                'PENUGASAN_ID' => 5, //po
                'PROJECT_ID' => $projectID
            );
            $this->mProject->insert('enroll', $data);
        }
        redirect(base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) . '/viewDetail/' . $projectID);
    }

    public function viewDetail($idProject) {
        $this->title = "Detail Project";
        $this->data['detailProject'] = $this->mProject->_joinSelect('project', array('enroll' => 'enroll.PROJECT_ID = project.PROJECT_ID', 'penugasan' => 'penugasan.PENUGASAN_ID = enroll.PENUGASAN_ID', 'pengguna' => 'pengguna.PENGGUNA_ID = enroll.PENGGUNA_ID', 'departemen' => 'departemen.DEPARTEMEN_ID = pengguna.DEPARTEMEN_ID'), array('project.PROJECT_ID' => $idProject), array('project.*', 'pengguna.*', 'penugasan.*', 'enroll.*'));
        
        $this->display('detailProject', $this->data);
    }

    public function viewEdit($idProject) {
        $this->script_footer = 'lay-scripts/footer-addProject';
        $this->title = "Edit Project";
        $this->data['listDepartement'] = $this->mDepartemen->_select();
        $this->data['listPengguna'] = $this->mPengguna->getAllPegawai()->result_array();
        $this->data['listDetailProject'] = $this->mProject->getViewProject('view_enroll_user', array('PROJECT_ID' => $idProject))->result_array();
        $this->display('editlProject', $this->data);
    }

    public function update() {
        $data = array(
            'PROJECT_NAMA' => $this->input->post('PROJECT_NAME'),
            'PROJECT_KODE' => $this->input->post('PROJECT_KODE'),
            'PROJECT_DESCRIPTION' => $this->input->post('PROJECT_DESCRIPTION'),
            'PROJECT_ACTIVE' => 1
        );
        $projectID = $this->input->post('PROJECT_ID');
        $this->mProject->_update($data, array(mProject::ID => $projectID));

        $listProject = $this->mProject->getViewProject('view_enroll_user', array('PROJECT_ID' => $projectID))->result_array();

        $creator = $this->input->post("CREATOR");
        var_dump($creator);
        if (!empty($creator)) {
            for ($i = 0; $i < sizeof($listProject); $i++) {
                if ($listProject[$i]['PENUGASAN_ID'] == 1) {
                    $this->mEnroll->delete($listProject[$i]['PENGGUNA_ID'], $listProject[$i]['PENUGASAN_ID'], $projectID);
                }
            }
            foreach ($creator as $row) {
                $data = array(
                    'PENGGUNA_ID' => $row,
                    'PENUGASAN_ID' => 1, //creator
                    'PROJECT_ID' => $projectID
                );
                $this->mProject->insert('enroll', $data);
            }
        }

        $estimator = $this->input->post("ESTIMATOR");
        if (!empty($estimator)) {
            for ($i = 0; $i < sizeof($listProject); $i++) {
                if ($listProject[$i]['PENUGASAN_ID'] == 2) {
                    $this->mEnroll->delete($listProject[$i]['PENGGUNA_ID'], $listProject[$i]['PENUGASAN_ID'], $projectID);
                }
            }
            foreach ($estimator as $temp => $row) {
                $data = array(
                    'PENGGUNA_ID' => $row,
                    'PENUGASAN_ID' => 2, //estimator
                    'PROJECT_ID' => $projectID
                );
                $this->mProject->insert('enroll', $data);
            }
        }

        $pm = $this->input->post("PM");
        if (!empty($pm)) {
            for ($i = 0; $i < sizeof($listProject); $i++) {
                if ($listProject[$i]['PENUGASAN_ID'] == 3) {
                    $this->mEnroll->delete($listProject[$i]['PENGGUNA_ID'], $listProject[$i]['PENUGASAN_ID'], $projectID);
                }
            }
            foreach ($pm as $temp => $row) {
                $data = array(
                    'PENGGUNA_ID' => $row,
                    'PENUGASAN_ID' => 3, //pm
                    'PROJECT_ID' => $projectID
                );
                $this->mProject->insert('enroll', $data);
            }
        }

        $pp = $this->input->post("PP");
        if (!empty($pp)) {
            for ($i = 0; $i < sizeof($listProject); $i++) {
                if ($listProject[$i]['PENUGASAN_ID'] == 4) {
                    $this->mEnroll->delete($listProject[$i]['PENGGUNA_ID'], $listProject[$i]['PENUGASAN_ID'], $projectID);
                }
            }
            foreach ($pp as $temp => $row) {
                $data = array(
                    'PENGGUNA_ID' => $row,
                    'PENUGASAN_ID' => 4, //pp
                    'PROJECT_ID' => $projectID
                );
                $this->mProject->insert('enroll', $data);
            }
        }

        $po = $this->input->post("PO");
        if (!empty($po)) {
            for ($i = 0; $i < sizeof($listProject); $i++) {
                if ($listProject[$i]['PENUGASAN_ID'] == 5) {
                    $this->mEnroll->delete($listProject[$i]['PENGGUNA_ID'], $listProject[$i]['PENUGASAN_ID'], $projectID);
                }
            }
            foreach ($po as $temp => $row) {
                $data = array(
                    'PENGGUNA_ID' => $row,
                    'PENUGASAN_ID' => 5, //po
                    'PROJECT_ID' => $projectID
                );
                $this->mProject->insert('enroll', $data);
            }
        }
        redirect(base_url() . $this->uri->segment(1, 0) . '/' . $this->uri->segment(2, 0) . '/viewDetail/' . $projectID);
    }
	
	public function getViewProject(){
		echo $this->mProject->getProject();
	}

}
