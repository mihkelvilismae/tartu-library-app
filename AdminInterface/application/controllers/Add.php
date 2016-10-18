<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('database_model');
        $this->load->library('table');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function add_school()
    {
        $data['title'] = 'Kooli lisamine';
        $data['form_action'] = base_url('Lisa/Kool');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('email', 'E-Mail', 'required');

        $table_rows = array();

        array_push($table_rows, array('<label for="name">Nimi</label>', '<input type="input" name="name" />'));
        array_push($table_rows, array('<label for="phone">Telefon</label>', '<input type="input" name="phone" />'));
        array_push($table_rows, array('<label for="email">E-Mail</label>', '<input type="input" name="email" />'));
        array_push($table_rows, array('', '<input type="submit" name="submit" value="Lisa" /> <input type="button" value="Katkesta" onclick="javascript:location.href = \''.base_url("Koolid").'\';">'));

        $template = array(
            'table_open' => '<table border="1" cellpadding="4">'
        );

        $this->table->set_template($template);

        $data['table'] = $this->table->generate($table_rows);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('view/view_form');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_school();
            redirect(base_url("Koolid"));
            /*
            $data['title'] = 'Kooli lisamine õnnestus';

            $this->load->view('templates/header', $data);
            $this->load->view('success');
            $this->load->view('templates/footer');*/
        }
    }

    public function add_class()
    {

        $data['title'] = 'Klassi lisamine';
        $data['form_action'] = base_url('Lisa/Klass');

        $schools = $this->database_model->get_schools();

        $dropdown_rows = array();

        for ($i = 0; $i < count($schools); $i++) {
            $school = $schools[$i];
            $dropdown_rows[$school['id']] = $school['name'];
        }

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('school_id', 'Kooli nimi', 'required');

        $table_rows = array();

        array_push($table_rows, array('<label for="phone">Kool</label>', form_dropdown('school_id', $dropdown_rows)));
        array_push($table_rows, array('<label for="name">Klassi nimi</label>', '<input type="input" name="name" />'));
        array_push($table_rows, array('', '<input type="submit" name="submit" value="Lisa" />
            <input type="button" value="Katkesta" onclick="javascript:location.href = \''.base_url("Klassid").'\';">'));

        $template = array(
            'table_open' => '<table border="1" cellpadding="4">'
        );

        $this->table->set_template($template);

        $data['table'] = $this->table->generate($table_rows);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('view/view_form');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_class();
            redirect(base_url("Klassid"));
            /*
            $data['title'] = 'Klassi lisamine õnnestus';

            $this->load->view('templates/header', $data);
            $this->load->view('success');
            $this->load->view('templates/footer');*/
        }
    }

    public function add_book()
    {

        $data['title'] = 'Raamatu lisamine';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_rules('year', 'Year', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('add/add_book', $data);
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_book();

            $data['message'] = 'Raamatu lisamine õnnestus';

            $this->load->view('templates/header', $data);
            $this->load->view('success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function add_book_to_list($class_id)
    {
        $data['title'] = 'Raamatu lisamine';
        $data['books'] = $this->database_model->get_books();
        $data['id'] = $class_id;

        $books = array();
        foreach ($data['books'] as $book) {
            $books[$book['id']] = $book['title'];
        }
        $data['books'] = $books;

        $this->form_validation->set_rules('book_id', 'Title', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('add/reading_list', $data);
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_book_to_reading_list($class_id);

            $data['message'] = 'Raamatu lisamine nimekirja õnnestus';

            $this->load->view('templates/header', $data);
            $this->load->view('success', $data);
            $this->load->view('templates/footer');
        }
    }
}