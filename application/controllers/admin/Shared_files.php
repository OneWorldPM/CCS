<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shared_files extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->common->set_timezone();
        $login_type = $this->session->userdata('aname');
        if ($login_type != 'admin') {
            redirect('admin/alogin');
        }
        $this->load->model('madmin/m_shared_files', 'mshared');

    }

    public function index(){
        $this->load->view('admin/header');
        $this->load->view('admin/shared_files');
        $this->load->view('admin/footer');
    }

    public function upload_file(){

        $this->mshared->upload_file();
    }

    public function getUploadedData(){
        $this->mshared->getUploadedData();
    }

    public function deleteUploadedData(){
        $this->mshared->deleteUploadedData();
    }
}
