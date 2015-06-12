<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File extends Public_Controller {
    public function __construct() {
            parent::__construct();
            $this->load->helper(array('date','download','file'));
            $this->load->model(array('documents/document_m','documents/logging_m','documents/enroll_m',
                'file_m','documents/mapk_m'));
        }
        
        private function _preDownload($id_document,$nama_file)
        {
            
            if (empty($id_document)){
                echo "Parameter Dokumen hilang!";
                return false;
            }
            if (empty($nama_file))
            {
                echo "Parameter File hilang!";
                return false;  
            }
                        
            $document = $this->document_m->getDocumentbyId($id_document);
            if (count($document)<=0) {
                echo "File tidak didaftar di database!";
                return false;
            }
            return true;
        }
        
        public function downloadFile()
        {
            $id_document=$this->input->get('id_doc',TRUE);            
            $nama_file=$this->input->get('id_file',TRUE);
            
            if (!$this->_preDownload($id_document,$nama_file))
                return;
            
            $file_tujuan="uploads/".$id_document."/".$nama_file;
            
            $data=  @file_get_contents($file_tujuan);
            if ($data===FALSE)
            {
                echo "File tidak ditemukan di-server!";
                return ;
            }
            
            $name=$nama_file;


            force_download($name, $data); 
        }
        
        public function downloadFileReferensi()
        {
            $id_document=$this->input->get('id_doc',TRUE);            
            $nama_file=$this->input->get('id_file',TRUE);
            
            if (!$this->_preDownload($id_document,$nama_file))
                return;
            
            $file_tujuan="uploads/".$id_document."/lampiran/".$nama_file;
            
            $data=  @file_get_contents($file_tujuan);
            if ($data===FALSE)
            {
                echo "File tidak ditemukan di-server!";
                return ;
            }
            
            $name=$nama_file;


            force_download($name, $data); 
        }
        
        public function removeFileReferensi()
        {
            $id_document=$this->input->get('id_doc',TRUE);            
            $nama_file=$this->input->get('nama_file',TRUE);
            $id_file = $this->input->get('id_file',TRUE);
            $link=$this->input->get('link',TRUE);
            
            if (empty($id_document)){
                echo "Parameter Dokumen hilang!";
                return false;
            }
            if (empty($nama_file))
            {
                echo "Parameter File hilang!";
                return false;  
            }
            if (empty($id_file))
            {
                echo "Parameter File hilang!";
                return false;  
            }
            
            $file_tujuan="uploads/".$id_document."/lampiran/".$nama_file;
            
            $res = @unlink($file_tujuan);
            if (!$res)
            {
                echo 'Data tidak dapat dihapus, karena tidak ditemukan Filenya!';
                return;
            }
            
            $this->file_m->deleteFileFromDatabase($id_file);
            if ($link==null || $link=='') 
                redirect(base_url().'documents/form/editFiles/'.$id_document);
            else 
                redirect($link);
        }
        
           
        /*fungsi untuk pre_upload, monggo di custom dewe*/
        private function _preUpload($data)
        {
            $this->load->helper(array('date','download','file'));
            // create an folder if not already exist in uploads dir
            // wouldn't make more sence if this part is done if there are no errors and right before the upload ??
            if (!is_dir('uploads'))
            {
                mkdir('./uploads', 0777, true);
            }
            $dir_exist = true; // flag for checking the directory exist or not
            $dir_name=$data['id_dokumen'];
            if (!is_dir('uploads/' . $dir_name))
            {
                mkdir('./uploads/' . $dir_name, 0777, true);
                mkdir('./uploads/' . $dir_name . '/lampiran/', 0777, true);
                $dir_exist = false; // dir not exist
            }
            
            //make index.html file for security
            $data_tulis = '<html>
                    <head>
                            <title>403 Forbidden</title>
                    </head>
                    <body>

                    <p>Directory access is forbidden.</p>

                    </body>
                    </html>
                    ';
            $write1='uploads'.DIRECTORY_SEPARATOR.$dir_name.
                    DIRECTORY_SEPARATOR.'index.html';
            $write2='uploads'.DIRECTORY_SEPARATOR.$dir_name.
                    DIRECTORY_SEPARATOR.'lampiran'.DIRECTORY_SEPARATOR.'index.html';
            if ( !write_file($write1, $data_tulis) )
            {
                 $message= 'Unable to write the file index awal';
                 return array('result'=>false,'message'=> $message);
            }
            else if (!write_file($write2, $data_tulis) )
            {
                $message= 'Unable to write the file index lampiran';
                return array('result'=>false,'message'=> $message);
            }
            else 
            {
                 $message= 'File written!';
                 return array('result'=>true, 'message'=>$dir_name);
            }
            
        }
        
        
        //bentuk upload secara versioning
        protected function upload($name_file,$field_name,$data)
        {
            $res = $this->_preUpload($data);
            if (!$res['result'])
            {
               return array('result'=>false,'message'=> $res['message']); 
            }
            $dir_name=$res['message'];
            //FALSE untuk lampiran; TRUE untuk file versioning
            $kategori=FALSE;
            
            //Configure
            //set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
            if ($field_name==='doc'){
                $config['upload_path'] = './uploads/'.$dir_name;
                $config['allowed_types'] = 'doc|docx|pdf';
                $kategori=TRUE;
            }
            else if ($field_name==='ref')
            {
                $config['upload_path'] = './uploads/'.$dir_name.'/lampiran/';
                $config['allowed_types'] = '*';
            }
            else return array('result'=>true, 'message'=>'Unknown Field Name');
            
            // set the filter image types
            
            $config['file_name']= $name_file;
            $config['overwrite'] = false;
            //load the upload library
            $this->load->library('upload', $config);
            
            $this->upload->initialize($config);
            
            
            //if not successful, set the error message
            if (!$this->upload->do_upload($field_name)) {
                return array('result'=>false,'message'=> $this->upload->display_errors());
            } else { 
                $datas = $this->upload->data();
                $datas['userActive']=$this->_idUserActive;
                $this->file_m->insertFile($datas,$data['id_dokumen'],$data['tanggal_dokumen'],$kategori);
                
                return array('result'=>true, 'message'=>$data);
             }
        }
        
}