<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('database_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('table');

        if (!isset($_SESSION['logged_in'])) {
            $_SESSION['REFERER'] = base_url($_SERVER['REQUEST_URI']);
            redirect(base_url());
        }
    }

    public function add_school()
    {
        $data['active'] = 'Koolid';
        $data['title'] = 'Kooli lisamine';
        $data['form_action'] = base_url('Lisa/Kool');

        $this->form_validation->set_rules('name', 'Name', 'is_unique[school.name]|required');
        $this->form_validation->set_rules('phone', 'Phone', 'numeric|required');
        $this->form_validation->set_rules('email', 'E-Mail', 'valid_email|required');

        $table_rows = array();

        array_push($table_rows, array('', ''));
        array_push($table_rows, array(form_label('Nimi', 'name'), form_input('name', $this->input->post('name'))));
        array_push($table_rows, array(form_label('Telefon', 'phone'), form_input('phone', $this->input->post('phone'))));
        array_push($table_rows, array(form_label('E-Mail', 'email'), form_input('email', $this->input->post('email'))));
        array_push($table_rows, array('', form_submit('submit', 'Lisa').' '.form_button('katkesta', 'Katkesta', 'onclick="javascript:location.href = \''.base_url('Koolid').'\';"')));

        $template = array(
            'table_open' => '<table border="1" cellpadding="4" class="responstable">'
        );

        $this->table->set_template($template);

        $data['table'] = $this->table->generate($table_rows);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('view/view_form');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_school();
            redirect(base_url("Koolid"));
        }
    }

    public function add_class()
    {
        $data['active'] = 'Klassid';
        $data['title'] = 'Klassi lisamine';
        $data['form_action'] = base_url('Lisa/Klass');

        $schools = $this->database_model->get_schools();

        $dropdown_rows = array();

        for ($i = 0; $i < count($schools); $i++) {
            $school = $schools[$i];
            $dropdown_rows[$school['id']] = $school['name'];
        }

        $this->form_validation->set_message('class_name_check', 'The school already has a class named that.');
        $this->form_validation->set_rules('name', 'Name', 'required|callback_class_name_check['.$this->input->post('school_id').']');
        $this->form_validation->set_rules('school_id', 'Kooli nimi', 'numeric|required');

        $table_rows = array();

        array_push($table_rows, array('', ''));
        array_push($table_rows, array(form_label('Kool', 'school_id'), form_dropdown('school_id', $dropdown_rows)));
        array_push($table_rows, array(form_label('Klassi nimi', 'name'), form_input('name', $this->input->post('name'))));
        array_push($table_rows, array('', form_submit('submit', 'Lisa').' '.form_button('katkesta', 'Katkesta', 'onclick="javascript:location.href = \''.base_url('Klassid').'\';"')));

        $template = array(
            'table_open' => '<table border="1" cellpadding="4" class="responstable">'
        );

        $this->table->set_template($template);

        $data['table'] = $this->table->generate($table_rows);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('view/view_form');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_class();
            redirect(base_url("Klassid"));
        }
    }

    public function add_book()
    {

        $data['active'] = 'Raamatud';
        $data['title'] = 'Raamatu lisamine';
        $data['form_action'] = base_url('Lisa/Raamat');

        $this->form_validation->set_rules('title', 'title', 'is_unique[book.title]|required');
        $this->form_validation->set_rules('author', 'author', 'required');
        $this->form_validation->set_rules('year', 'year', 'numeric|required');

        $table_rows = array();

        array_push($table_rows, array('', ''));
        array_push($table_rows, array(form_label('Raamatu nimi', 'title'), form_input('title', $this->input->post('title'))));
        array_push($table_rows, array(form_label('Autor', 'author'), form_input('author', $this->input->post('author'))));
        array_push($table_rows, array(form_label('Aasta', 'year'), form_input('year', $this->input->post('year'))));
        array_push($table_rows, array('', form_submit('submit', 'Lisa').' '.form_button('katkesta', 'Katkesta', 'onclick="javascript:location.href = \''.base_url('Raamatud').'\';"')));

        $template = array(
            'table_open' => '<table border="1" cellpadding="4" class="responstable">'
        );

        $this->table->set_template($template);

        $data['table'] = $this->table->generate($table_rows);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('view/view_form');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_book();
            redirect(base_url("Raamatud"));
        }
    }

    public function add_book_to_list($class_id=NULL)
    {
        $data['active'] = 'Nimekiri';
        $data['title'] = 'Raamatu lisamine';
        $data['form_action'] = "Lisa/Nimekiri/".$class_id;

        $books = $this->database_model->get_books();
        $schools = $this->database_model->get_schools();

        $dropdown_rows_classes = array();
        $dropdown_rows_books = array();

        for ($i = 0; $i < count($schools); $i++) {
            $school = $schools[$i];
            $classes_rows = $this->database_model->get_classes($school['id']);
            $classes = array();
            for ($j = 0; $j < count($classes_rows); $j++) {
                $class = $classes_rows[$j];
                $classes[$class['id']] = $class['name'];
            }
            $dropdown_rows_classes[$school['name']] = $classes;
        }

        for ($i = 0; $i < count($books); $i++) {
            $book = $books[$i];
            $dropdown_rows_books[$book['id']] = $book['title'];
        }
        $this->form_validation->set_message('check_book_in_list', 'The book is already on the list.');
        $this->form_validation->set_rules('class_id', 'Title', 'numeric|required');
        $this->form_validation->set_rules('book_id', 'Title', 'numeric|required|callback_check_book_in_list['.$this->input->post('class_id').']');

        $table_rows = array();

        if ($class_id == NULL) {
            $class_id = $this->input->post('class_id');
        }

        array_push($table_rows, array('', ''));
        array_push($table_rows, array(form_label('Klass', 'class_id'), form_dropdown('class_id', $dropdown_rows_classes, $class_id)));
        array_push($table_rows, array(form_label('Raamat', 'book_id'), form_dropdown('book_id', $dropdown_rows_books, $this->input->post('book_id'))));
        if ($class_id) {
            array_push($table_rows, array('', form_submit('submit', 'Lisa').' '.form_button('katkesta', 'Katkesta', 'onclick="javascript:location.href = \''.base_url("Muuda/Nimekiri/".$class_id).'\';"')));
        } else {
            array_push($table_rows, array('', form_submit('submit', 'Lisa').' '.form_button('katkesta', 'Katkesta', 'onclick="javascript:location.href = \''.base_url('Nimekiri').'\';"')));
        }


        $template = array(
            'table_open' => '<table border="1" cellpadding="4" class="responstable">'
        );

        $this->table->set_template($template);

        $data['table'] = $this->table->generate($table_rows);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('view/view_form', $data);
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_book_to_reading_list();
            if ($class_id) {
                redirect("Muuda/Nimekiri/".$class_id);
            } else {
                redirect(base_url('Nimekiri'));
            }
        }
    }

    public function add_user()
    {
        if ($_SESSION['is_admin'] != 1) {
            redirect(base_url('Koolid'));
        }
        $data['active'] = 'Kasutajad';
        $data['title'] = 'Kasutaja lisamine';
        $data['form_action'] = base_url('Lisa/Kasutaja');

        $this->form_validation->set_rules('firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required');
        $this->form_validation->set_rules('email', 'E-Mail', 'is_unique[account.email]|valid_email|required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'numeric|required');

        $table_rows = array();

        array_push($table_rows, array('', ''));

        array_push($table_rows, array(form_label('Eesnimi', 'firstname'), form_input('firstname', $this->input->post('firstname'))));
        array_push($table_rows, array(form_label('Perenimi', 'lastname'), form_input('lastname', $this->input->post('lastname'))));
        array_push($table_rows, array(form_label('E-Mail', 'email'), form_input('email', $this->input->post('email'))));
        array_push($table_rows, array(form_label('Parool', 'password'), form_password('password', $this->input->post('password'))));
        array_push($table_rows, array(form_label('Telefon', 'phone'), form_input('phone', $this->input->post('phone'))));
        array_push($table_rows, array(form_label('Admin', 'is_admin'), form_checkbox('is_admin', 1, $this->input->post('is_admin'))));

        array_push($table_rows, array('', form_submit('submit', 'Lisa').' '.form_button('katkesta', 'Katkesta', 'onclick="javascript:location.href = \''.base_url('Kasutajad').'\';"')));

        $template = array(
            'table_open' => '<table border="1" cellpadding="4" class="responstable">'
        );

        $this->table->set_template($template);

        $data['table'] = $this->table->generate($table_rows);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('view/view_form');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_user();
            redirect(base_url("Kasutajad"));
        }
    }

    public function add_keyword()
    {
        $data['active'] = 'Märksõnad';
        $data['title'] = 'Märksõna lisamine';
        $data['form_action'] = base_url('Lisa/Märksõna');

        $this->form_validation->set_rules('name', 'Name', 'is_unique[keyword.name]|required');

        $table_rows = array();

        array_push($table_rows, array('', ''));
        array_push($table_rows, array(form_label('Märksõna', 'name'), form_input('name', $this->input->post('name'))));
        array_push($table_rows, array('', form_submit('submit', 'Lisa').' '.form_button('katkesta', 'Katkesta', 'onclick="javascript:location.href = \''.base_url('Märksõnad').'\';"')));

        $template = array(
            'table_open' => '<table border="1" cellpadding="4" class="responstable">'
        );

        $this->table->set_template($template);

        $data['table'] = $this->table->generate($table_rows);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('view/view_form');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_keyword();
            redirect(base_url("Märksõnad"));
        }
    }

    public function class_name_check($class_name, $school_id) {
        $classes = $this->database_model->get_classes($school_id);
        foreach ($classes as $class) {
            if ($class['name'] === $class_name) {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function check_book_in_list($book_id, $class_id) {
        $books_in_list = $this->database_model->get_reading_list_from_class($class_id);
        foreach ($books_in_list as $book) {
            if ($book['book_id'] === $book_id) {
                return FALSE;
            }
        }
        return TRUE;
    }
}