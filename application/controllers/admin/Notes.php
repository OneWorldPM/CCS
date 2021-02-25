<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notes extends CI_Controller {
    public function __construct() {
        parent::__construct();
         $this->common->set_timezone();
        $login_type = $this->session->userdata('aname');
        $role = $this->session->userdata('role');
        if ($login_type != 'admin' || $role != 'super_admin') {
            redirect('admin/alogin');
        }
        $this->load->model('madmin/m_notes', 'mnotes');
    }


    public function index(){
        $data['notes'] = $this->mnotes->getNotesAll();
	
        $this->load->view("admin/header");
      $this->load->view("admin/notes",$data);
      $this->load->view("admin/footer");
    }

    public function add_notes(){
        $this->load->view("admin/header");
        $this->load->view("admin/add_notes");
        $this->load->view("admin/footer");
    }

    public function create_notes(){
      
       $result=$this->mnotes->create_note();
       if ($result != "") {
        header('location:' . base_url() . 'admin/sessions');
    } else {
        header('location:' . base_url() . 'admin/sessions');
    }
    }
}
