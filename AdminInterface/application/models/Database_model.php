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

    public function get_class_by_id($id) {
        $query = $this->db->get_where('class', array('id'=>$id));
        return $query->row_array();
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

    public function edit_school($id) {
        $this->load->helper('url');

        $this->db->set('name', $this->input->post('name'));
        $this->db->where('id', $id);

        return $this->db->update('school');
    }

    public function edit_class($id) {
        $this->load->helper('url');

        $changes = array(
            'name' => $this->input->post('name'),
            'school_id' => $this->input->post('school_id')
        );

        $this->db->set($changes);
        $this->db->where('id', $id);

        return $this->db->update('class');
    }
}