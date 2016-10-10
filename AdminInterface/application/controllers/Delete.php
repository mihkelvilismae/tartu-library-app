<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('database_model');
        $this->load->helper('url_helper');
    }

    public function delete_school()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Kooli kustutamine';
        $data['form_action'] = 'Kustuta/Kool';
        $data['item_type'] = 'Kool';

        $schools = array();
        foreach ($this->database_model->get_schools() as $school) {
            $schools[$school['id']] = $school['name'];
        }
        $data['items'] = $schools;
        $data['button_text'] = "Kustuta kool";

        $this->form_validation->set_rules('item_id', 'Item id', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('delete/delete_item', $data);
            $this->load->view('templates/footer');
        } else {
            $this->database_model->delete_school();

            $data['message'] = 'Kooli kustutamine õnnestus';

            $this->load->view('templates/header', $data);
            $this->load->view('success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function delete_class($school_id)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Klassi kustutamine';
        $data['form_action'] = 'Kustuta/Klass/'.$school_id;
        $data['item_type'] = 'Klass';

        $classes = array();
        foreach ($this->database_model->get_classes($school_id) as $class) {
            $classes[$class['id']] = $class['name'];
        }
        $data['items'] = $classes;
        $data['button_text'] = "Kustuta klass";

        $this->form_validation->set_rules('item_id', 'Item id', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('delete/delete_item', $data);
            $this->load->view('templates/footer');
        } else {
            $this->database_model->delete_class();

            $data['message'] = 'Kooli kustutamine õnnestus';

            $this->load->view('templates/header', $data);
            $this->load->view('success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function delete_book()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Raamatu kustutamine';
        $data['form_action'] = 'Kustuta/Raamat';
        $data['item_type'] = 'Raamat';

        $books = array();
        foreach ($this->database_model->get_books() as $book) {
            $books[$book['id']] = $book['title'];
        }
        $data['items'] = $books;
        $data['button_text'] = "Kustuta raamat";

        $this->form_validation->set_rules('item_id', 'Item id', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('delete/delete_item', $data);
            $this->load->view('templates/footer');
        } else {
            $this->database_model->delete_book();

            $data['message'] = 'Raamatu kustutamine õnnestus';

            $this->load->view('templates/header', $data);
            $this->load->view('success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function delete_book_from_list($class_id)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Raamatu kustutamine nimekirjast';
        $data['form_action'] = 'Kustuta/Nimekiri/'.$class_id;
        $data['item_type'] = 'Raamat';

        $books = array();
        foreach ($this->database_model->get_reading_list_from_class($class_id) as $book) {
            $books[$book['id']] = $this->database_model->get_book_by_id($book['book_id'])['title'];
        }
        $data['items'] = $books;
        $data['button_text'] = "Kustuta raamat nimekirjast";

        $this->form_validation->set_rules('item_id', 'Item id', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('delete/delete_item', $data);
            $this->load->view('templates/footer');
        } else {
            $this->database_model->delete_reading_list();

            $data['message'] = 'Raamatu kustutamine nimekirjast õnnestus';

            $this->load->view('templates/header', $data);
            $this->load->view('success', $data);
            $this->load->view('templates/footer');
        }
    }
}