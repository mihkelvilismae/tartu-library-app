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
    }

    public function edit_school($school_id) {
        $data['title'] = 'Kooli muutmine';
        $data['form_action'] = 'Muuda/Kool/'.$school_id;
        $school = $this->database_model->get_school($school_id);

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('email', 'E-Mail', 'required');

        $table_rows = array();

        array_push($table_rows, array('<label for="name">Nimi</label>', '<input type="input" name="name" value="'.$school['name'].'" />'));
        array_push($table_rows, array('<label for="phone">Telefon</label>', '<input type="input" name="phone" value="'.$school['phone'].'" />'));
        array_push($table_rows, array('<label for="email">E-Mail</label>', '<input type="input" name="email" value="'.$school['email'].'" />'));
        array_push($table_rows, array('', '<input type="submit" name="submit" value="Salvesta" /> <input type="button" value="Katkesta" onclick="javascript:location.href = \''.base_url("Koolid").'\';">'));

        $template = array(
            'table_open' => '<table border="1" cellpadding="4" class="responstable">'
        );

        $this->table->set_template($template);

        $data['table'] = $this->table->generate($table_rows);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('view/view_form', $data);
            $this->load->view('templates/footer');
        } else {
            $this->database_model->edit_school($school_id);
            redirect(base_url('Koolid'));
            /*
            $data['message'] = 'Kooli muutmine õnnestus';

            $this->load->view('templates/header', $data);
            $this->load->view('success', $data);
            $this->load->view('templates/footer');*/
        }
    }

    public function edit_class($class_id) {
        $data['title'] = 'Klassi muutmine';
        $data['form_action'] = base_url('Muuda/Klass/'.$class_id);
        $class = $this->database_model->get_class_by_id($class_id);

        $schools = $this->database_model->get_schools();

        $dropdown_rows = array();

        for ($i = 0; $i < count($schools); $i++) {
            $school = $schools[$i];
            $dropdown_rows[$school['id']] = $school['name'];
        }

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('school_id', 'Kooli nimi', 'required');

        $table_rows = array();

        array_push($table_rows, array('<label for="school_id">Kool</label>', form_dropdown('school_id', $dropdown_rows, $class['school_id'])));
        array_push($table_rows, array('<label for="name">Klassi nimi</label>', '<input type="input" name="name" value="'.$class['name'].'" />'));
        array_push($table_rows, array('', '<input type="submit" name="submit" value="Salvesta" />
            <input type="button" value="Katkesta" onclick="javascript:location.href = \''.base_url("Klassid").'\';">'));

        $template = array(
            'table_open' => '<table border="1" cellpadding="4" class="responstable">'
        );

        $this->table->set_template($template);

        $data['table'] = $this->table->generate($table_rows);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('view/view_form', $data);
            $this->load->view('templates/footer');
        } else {
            $this->database_model->edit_class($class_id);
            redirect(base_url("Klassid"));
        }
    }

    public function edit_book($id) {
        $data['title'] = 'Raamatu muutmine';
        $book = $this->database_model->get_book_by_id($id);
        $data['current_title'] = $book['title'];
        $data['current_author'] = $book['author'];
        $data['current_year'] = $book['year'];
        $data['id'] = $id;

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_rules('year', 'Year', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('edit/edit_book');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->edit_book($id);

            $data['message'] = 'Raamatu muutmine õnnestus';

            $this->load->view('templates/header', $data);
            $this->load->view('success', $data);
            $this->load->view('templates/footer');
        }
    }

    public function edit_reading_list($class_id) {
        $data['title'] = 'Raamatunimekirja muutmine';
        $data['form_action'] = 'Muuda/Nimekiri/'.$class_id;
        $reading_list_items = $this->database_model->get_reading_list($class_id);

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

        $books = '';
        for ($i = 0; $i < count($list_rows); $i++) {
            $row = $list_rows[$i];
            if ($row['class_id'] == $class_id) {
                if ($books !== '') {
                    $books .= '<br />';
                }
                $books .= $this->database_model->get_book_by_id($row['book_id'])['title'];
            }
        }
        $books .= '<br /><a href="'.base_url("Lisa/Nimekiri/".$class_id).'">Lisa raamat</a>';
        $this->form_validation->set_rules('class_id', 'Class', 'required');

        $table_rows = array();
        array_push($table_rows, array('<label for="class_id">Klass</label>', form_dropdown('class_id', $dropdown_rows_classes, $class_id)));
        array_push($table_rows, array('<label for="book_id">Raamatud</label>', $books));
        array_push($table_rows, array('', '<input type="submit" name="submit" value="Salvesta" />
            <input type="button" value="Katkesta" onclick="javascript:location.href = \''.base_url("Nimekiri").'\';">'));

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
}