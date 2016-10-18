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

    public function get_book_by_id($id) {
        $query = $this->db->get_where('book', array('id'=>$id));
        return $query->row_array();
    }

    public function get_list() {
        $query = $this->db->get('reading_list');
        return $query->result_array();
    }

    public function get_reading_list_from_class($class_id) {
        $query = $this->db->get_where('reading_list', array('class_id'=>$class_id));
        return $query->result_array();
    }

    public function get_reading_list_from_book($book_id) {
        $query = $this->db->get_where('reading_list', array('book_id'=>$book_id));
        return $query->result_array();
    }

    public function get_schools() {
        $query = $this->db->get('school');
        return $query->result_array();
    }

    public function get_classes($id=NULL) {
        if ($id) {
            $query = $this->db->get_where('class', array('school_id'=>$id));
        } else {
            $query = $this->db->get('class');
        }
        return $query->result_array();
    }

    public function get_books() {
        $query = $this->db->get('book');
        return $query->result_array();
    }

    public function add_school() {
        $this->load->helper('url');

        $data = array(
            'name' => $this->input->post('name'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email')
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

    public function add_book() {
        $this->load->helper('url');

        $data = array(
            'title' => $this->input->post('title'),
            'author' => $this->input->post('author'),
            'year' => $this->input->post('year')
        );

        return $this->db->insert('book', $data);
    }

    public function add_book_to_reading_list($class_id) {
        $this->load->helper('url');

        $data = array(
            'class_id' => $class_id,
            'book_id' => $this->input->post('book_id')
        );

        return $this->db->insert('reading_list', $data);
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

    public function edit_book($id) {
        $this->load->helper('url');

        $changes = array(
            'title' => $this->input->post('title'),
            'author' => $this->input->post('author'),
            'year' => $this->input->post('year')
        );

        $this->db->set($changes);
        $this->db->where('id', $id);

        return $this->db->update('book');
    }

    public function delete_school($id=NULL) {
        $this->load->helper('url');
        if (!$id) {
            $id = $this->input->post('item_id');
        }
        $classes = $this->get_classes($id);
        foreach ($classes as $class) {
            $this->delete_class($class['id']);
        }
        $this->db->where('id', $id);

        return $this->db->delete('school');
    }

    public function delete_class($id=NULL) {
        $this->load->helper('url');
        if (!$id) {
            $id = $this->input->post('item_id');
        }
        $reading_list = $this->get_reading_list_from_class($id);
        foreach ($reading_list as $e) {
            $this->delete_reading_list($e['id']);
        }
        $this->db->where('id', $id);
        return $this->db->delete('class');
    }

    public function delete_reading_list($id=NULL) {
        $this->load->helper('url');
        if (!$id) {
            $id = $this->input->post('item_id');
        }
        $this->db->where('id', $id);
        return $this->db->delete('reading_list');
    }

    public function delete_book($id=NULL) {
        $this->load->helper('url');
        if (!$id) {
            $id = $this->input->post('item_id');
        }
        $reading_list = $this->get_reading_list_from_book($id);
        foreach ($reading_list as $e) {
            $this->delete_reading_list($e['id']);
        }
        $this->db->where('id', $id);
        return $this->db->delete('book');
    }
}