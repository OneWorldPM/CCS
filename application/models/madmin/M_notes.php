<?php

class M_notes extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }



    public function create_note(){
        $post = $this->input->post();
        
        $set = array(
            'note_title' => trim($post['note_title']),
            'note_content' => $post['note_content'],
            "date_created" => date("Y-m-d h:i")
        );
        $this->db->insert("notes", $set);
  
        return TRUE;
    }

    function getNotesAll(){
        
   
        $this->db->select('s.*');
        $this->db->from('notes s');
        $this->db->order_by("s.date_created", "asc");
        $sessions = $this->db->get();
        if ($sessions->num_rows() > 0) {
            return $sessions->result_array();
           
        
        } else {
            return '';
        }
    
    }
}