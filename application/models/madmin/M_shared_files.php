<?php

class M_shared_files extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function upload_file(){
        $post = $this->input->post();
        $admin_id = $this->session->userdata['aid'];
        if ($_FILES['user_file']['name'] != "") {

            $this->load->library('upload');
            $this->upload->initialize($this->set_upload_config());
            $this->upload->do_upload('user_file');
            $file_upload_name = $this->upload->data();

            $name = pathinfo($_FILES['user_file']['name'], PATHINFO_FILENAME);
            $extension = pathinfo($_FILES['user_file']['name'], PATHINFO_EXTENSION);

            if($this->check_upload_resubmission($admin_id, $name)){
                $increment_name = $this->check_upload_resubmission($admin_id, $name);
                $new_name= $increment_name.'.'.$extension;
            }else{
                $new_name = $name.'.'.$extension;
            }


            $field_set = array(
                'user_id'=>$this->session->userdata['aid'],
                'date_time'=>date('Y-m-d H:i:s'),
                'file_name'=> $file_upload_name['file_name'] ,
                'name'=>$new_name,
                'title'=>$post['title']
            );
            $this->db->insert('admin_shared_files', $field_set);
            $insert_id = $this->db->insert_id();
            $this->db->select('*')
                ->from('admin_shared_files')
                ->where('id', $insert_id);
            $return = $this->db->get();
            if($return->num_rows()>0){
                echo json_encode($return->result_array());
            }else{
                echo json_last_error_msg();
            }
        }
    }


    function set_upload_config() {
        $this->load->helper('string');
        $randname = random_string('numeric', '8');
        $config = array();
        $config['upload_path'] = './uploads/admin_shared_files/';
        $config['allowed_types'] = '*';
        $config['overwrite'] = FALSE;
        $config['file_name'] = "shared" . $randname;
        return $config;
    }

    function getUploadedData(){
        if($this->session->userdata['role']=="super_admin"){
            $this->db->select('*')
                ->from('admin_shared_files asf')
                ->join('admin a', 'asf.user_id=a.admin_id', 'left');
            $data = $this->db->get();

            if($data->num_rows() > 0){
                echo json_encode($data->result_array());
            }else{
                echo json_encode(json_last_error_msg());
            }
        }else{
            $this->db->select('*')
                ->from('admin_shared_files asf')
                ->join('admin a', 'asf.user_id=a.admin_id', 'left')
                ->where('user_id', $this->session->userdata['aid']);

            $data = $this->db->get();
            if($data->num_rows() > 0){
                echo json_encode($data->result_array());
            }else{
                echo json_encode(json_last_error_msg());
            }
        }

    }

    function deleteUploadedData(){
        $post = $this->input->post();
        if($this->db->delete('admin_shared_files', array('id'=>$post['id']))){
            if(file_exists(FCPATH.'uploads/admin_shared_files/'.$post['file_name'])){
                unlink(FCPATH.'uploads/admin_shared_files/'.$post['file_name']);
            }
            echo json_encode('success');
        }

        else{
            echo json_last_error_msg();
        }

    }

    function check_upload_resubmission($admin_id, $new_name){

        $result = $this->db->query("SELECT COUNT(*) as count FROM admin_shared_files WHERE user_id='".$admin_id."' and  name REGEXP '".$new_name."' ");

        if ($result->num_rows() > 0) {

            if($result->result()[0]->count > 0){
                $count = $result->result()[0]->count + 1;
                return $new_name.'('.$count.')';
            }else{
                return false;
            }

        }else{
            return false;
        }
    }
}