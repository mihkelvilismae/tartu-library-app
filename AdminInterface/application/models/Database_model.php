<?php

class Database_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_school_name($id) {
        $query = $this->db->get_where('school', array('id'=>$id));
        return $query->row_array()['name'];
    }

    public function get_schools() {
        $query = $this->db->get('school');
        return $query->result_array();
    }

    public function get_classes() {
        $query = $this->db->get('class');
        return $query->result_array();
    }

    public function add_school() {
        $this->load->helper('url');

        $data = array(
            'name' => $this->input->post('name')
        );

        return $this->db->insert('school', $data);
    }

    public function add_class() {
        $this->load->helper('url');

        $data = array(
            'school_id' => $this->input->post('school_id'),
            'name' => $this->input->post('name')
        );

        return $this->db->insert('class', $data);
    }
}