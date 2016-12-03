<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {
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
    
    

    public function edit_school($school_id) {
        $data['active'] = 'Koolid';
        $data['title'] = 'Kooli muutmine';
        $data['form_action'] = 'Muuda/Kool/'.$school_id;
        $school = $this->database_model->get_school($school_id);

        $this->form_validation->set_rules('name', 'Name', 'is_unique[school.name]|required');
        $this->form_validation->set_rules('phone', 'Phone', 'numeric|required');
        $this->form_validation->set_rules('email', 'E-Mail', 'valid_email|required');

        $table_rows = array();

        array_push($table_rows, array('', ''));
        array_push($table_rows, array(form_label('Nimi', 'name'), form_input('name', $school['name'])));
        array_push($table_rows, array(form_label('Telefon', 'phone'), form_input('phone', $school['phone'])));
        array_push($table_rows, array(form_label('E-Mail', 'email'), form_input('email', $school['email'])));
        array_push($table_rows, array('', form_submit('submit', 'Salvesta').' '.form_button('katkesta', 'Katkesta', 'onclick="javascript:location.href = \''.base_url('Koolid').'\';"')));

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
            $this->database_model->edit_school($school_id);
            redirect(base_url('Koolid'));
        }
    }

    public function edit_class($class_id) {
        $data['active'] = 'Klassid';
        $data['title'] = 'Klassi muutmine';
        $data['form_action'] = base_url('Muuda/Klass/'.$class_id);
        $class = $this->database_model->get_class_by_id($class_id);

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
        array_push($table_rows, array(form_label('Kool', 'school_id'), form_dropdown('school_id', $dropdown_rows, $class['school_id'])));
        array_push($table_rows, array(form_label('Klassi nimi', 'name'), form_input('name', $class['name'])));

        array_push($table_rows, array('', form_submit('submit', 'Salvesta').' '.form_button('katkesta', 'Katkesta', 'onclick="javascript:location.href = \''.base_url('Klassid').'\';"')));

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
            $this->database_model->edit_class($class_id);
            redirect(base_url("Klassid"));
        }
    }

    public function edit_book($book_id) {
        $data['active'] = 'Raamatud';
        $data['title'] = 'Raamatu muutmine';
        $data['form_action'] = 'Muuda/Raamat/'.$book_id;
        $school = $this->database_model->get_book($book_id);

        $this->form_validation->set_rules('title', 'title', 'is_unique[book.title]|required');
        $this->form_validation->set_rules('author', 'author', 'required');
        $this->form_validation->set_rules('year', 'year', 'numeric|required');

        $table_rows = array();

        array_push($table_rows, array('', ''));
        array_push($table_rows, array(form_label('Raamatu nimi', 'title'), form_input('title', $school['title'])));
        array_push($table_rows, array(form_label('Autor', 'author'), form_input('author', $school['author'])));
        array_push($table_rows, array(form_label('Aasta', 'year'), form_input('year', $school['year'])));
        array_push($table_rows, array('', form_submit('submit', 'Salvesta').' '.form_button('katkesta', 'Katkesta', 'onclick="javascript:location.href = \''.base_url('Raamatud').'\';"')));

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
            $this->database_model->edit_book($book_id);
            redirect(base_url('Raamatud'));
        }
    }

    public function edit_reading_list($class_id) {
        $data['active'] = 'Nimekiri';
        $data['title'] = 'Raamatunimekirja muutmine';
        $data['form_action'] = 'Muuda/Nimekiri/'.$class_id;

        $schools = $this->database_model->get_schools();

        $dropdown_rows_classes = array();

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

        $list_rows = $this->database_model->get_list();

        $books = '<ul>';
        for ($i = 0; $i < count($list_rows); $i++) {
            $row = $list_rows[$i];
            if ($row['class_id'] == $class_id) {
                $books .= '<li>'.$this->database_model->get_book($row['book_id'])['title'].' <span class="remove-book"><a href="'.base_url('Kustuta/Nimekirjast/'.$row['id']).'">Kustuta</a></span></li>';
            }
        }
        $books .= '</ul>';

        $this->form_validation->set_message('is_unique', 'The class already has a reading list.');
        $this->form_validation->set_rules('class_id', 'Class', 'numeric|required|is_unique[reading_list.class_id]');

        $table_rows = array();
        array_push($table_rows, array('', '<a href="'.base_url("Lisa/Nimekiri/".$class_id).'">Lisa raamat</a>'));
        array_push($table_rows, array(form_label('Klass', 'class_id'), form_dropdown('class_id', $dropdown_rows_classes, $class_id)));
        array_push($table_rows, array(form_label('Raamatud', 'book_id'), $books));
        array_push($table_rows, array('', form_submit('submit', 'Salvesta').' '.form_button('katkesta', 'Katkesta', 'onclick="javascript:location.href = \''.base_url('Nimekiri').'\';"')));

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
            $this->database_model->edit_reading_list($class_id);
            redirect(base_url('Nimekiri'));
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
}