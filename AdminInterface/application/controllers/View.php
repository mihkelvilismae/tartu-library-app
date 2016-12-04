<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('database_model');
        $this->load->library('table');
        $this->load->helper('url_helper');

        if (!isset($_SESSION['logged_in'])) {
            $_SESSION['REFERER'] = base_url($_SERVER['REQUEST_URI']);
            redirect(base_url());
        }
    }

    public function view_schools()
    {
        $data['active'] = 'Koolid';
        $schools = $this->database_model->get_schools();
        $data['title'] = 'Koolid';
        $table_rows = array();

        for ($i = 0; $i < count($schools); $i++) {
            $school = $schools[$i];
            $change_delete = '<a href="'.base_url("Muuda/Kool/".$school['id']).'">Muuda</a> / <a href="'.base_url('Kustuta/Kool/'.$school["id"]).'">Kustuta</a>';

            array_push(
                $table_rows,
                array(
                    $school['name'],
                    $school['phone'],
                    $school['email'],
                    $change_delete
                )
            );
        }

        $template = array(
            'table_open' => '<table border="1" cellpadding="4" class="responstable">'
        );

        $this->table->set_template($template);
        $this->table->set_heading("Kooli nimi","Telefon","E-Mail",'<a href="'.base_url('Lisa/Kool').'\">Lisa</a>');

        $data['table'] = $this->table->generate($table_rows);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('view/view_table');
        $this->load->view('templates/footer');
    }

    public function view_classes()
    {
        $data['active'] = 'Klassid';
        $data['title'] = 'Klassid';

        $table_rows = array();
        $template = array(
            'table_open' => '<table border="1" cellpadding="4" class="responstable">'
        );

        $this->table->set_template($template);
        $this->table->set_heading("Klassi nimi", "Kooli nimi",'<a href="'.base_url('Lisa/Klass').'\">Lisa</a>');

        $classes = $this->database_model->get_classes();
        for ($i = 0; $i < count($classes); $i++) {
            $class = $classes[$i];
            $change_delete = '<a href="'.base_url("Muuda/Klass/".$class['id']).'">Muuda</a> / <a href="'.base_url('Kustuta/Klass/'.$class["id"]).'">Kustuta</a>';

            array_push(
                $table_rows,
                array(
                    $class['name'],
                    $this->database_model->get_school_name($class['school_id']),
                    $change_delete
                )
            );
        }

        $data['table'] = $this->table->generate($table_rows);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('view/view_table');
        $this->load->view('templates/footer');
    }

    public function view_books()
    {
        $data['active'] = 'Raamatud';
        $books = $this->database_model->get_books();
        $data['title'] = 'Raamatud';
        $table_rows = array();

        for ($i = 0; $i < count($books); $i++) {
            $book = $books[$i];
            $change_delete = '<a href="'.base_url("Muuda/Raamat/".$book['id']).'">Muuda</a> / <a href="'.base_url('Kustuta/Raamat/'.$book["id"]).'">Kustuta</a>';

            array_push(
                $table_rows,
                array(
                    $book['title'],
                    $book['author'],
                    $book['year'],
                    $change_delete
                )
            );
        }

        $template = array(
            'table_open' => '<table border="1" cellpadding="4" class="responstable">'
        );

        $this->table->set_template($template);
        $this->table->set_heading("Raamatu pealkiri","Autor","Aasta",'<a href="'.base_url('Lisa/Raamat').'\">Lisa</a>');

        $data['table'] = $this->table->generate($table_rows);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('view/view_table');
        $this->load->view('templates/footer');
    }

    public function view_reading_list()
    {
        $data['active'] = 'Nimekiri';
        $this->load->helper('form');
        $data['title'] = 'Nimekirjad';
        $classes = $this->database_model->get_classes();

        $table_rows = array();
        $template = array(
            'table_open' => '<table border="1" cellpadding="4" class="responstable">'
        );

        $this->table->set_template($template);
        $this->table->set_heading("Klassi nimi", "Kooli nimi", "Raamatud", '<a href="'.base_url('Lisa/Nimekiri').'\">Lisa</a>');

        $list_rows = $this->database_model->get_list();
        for ($i = 0; $i < count($classes); $i++) {
            $class = $classes[$i];
            $school = $this->database_model->get_school_name($class['school_id']);
            $change_delete = '<a href="'.base_url("Muuda/Nimekiri/".$class['id']).'">Muuda</a> / <a href="'.base_url('Kustuta/Nimekiri/'.$class["id"]).'">Kustuta</a>';

            $books = array();
            for ($j = 0; $j < count($list_rows); $j++) {
                $row = $list_rows[$j];
                if ($row['class_id'] == $class['id']) {
                    $books[$row['book_id']] = $this->database_model->get_book($row['book_id'])['title'];
                }
            }
            if (count($books) > 0) {
                $books = 'Kokku: '.count($books);
                array_push(
                    $table_rows,
                    array(
                        $class['name'],
                        $school,
                        '<a href="Muuda/Nimekiri/'.$class['id'].'">'.$books.'</a>',
                        $change_delete
                    )
                );
            }
        }
        /*
        for ($i = 0; $i < count($list_rows); $i++) {
            $row = $list_rows[$i];
            $change_delete = '<a href="'.base_url("Muuda/Nimekiri/".$row['id']).'">Muuda</a> / <a href="'.base_url('Kustuta/Nimekiri/'.$row["id"]).'">Kustuta</a>';

            $class = $this->database_model->get_class_by_id($row['class_id']);
            $school = $this->database_model->get_school_name($class['school_id']);

            array_push(
                $table_rows,
                array(
                    $class['name'],
                    $school,
                    $this->database_model->get_book_by_id($row['book_id'])['title'],
                    $change_delete
                )
            );
        }*/

        $data['table'] = $this->table->generate($table_rows);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('view/view_table');
        $this->load->view('templates/footer');
    }

    public function view_users() {
        if ($_SESSION['is_admin'] != 1) {
            redirect(base_url('Koolid'));
        }
        $data['active'] = 'Kasutajad';
        $users = $this->database_model->get_users();
        $data['title'] = 'Kasutajad';
        $table_rows = array();

        for ($i = 0; $i < count($users); $i++) {
            $user = $users[$i];
            $delete = '<a href="'.base_url('Kustuta/Kasutaja/'.$user["id"]).'">Kustuta</a>';

            array_push(
                $table_rows,
                array(
                    $user['firstname'],
                    $user['lastname'],
                    $user['email'],
                    $user['phone'],
                    $user['is_admin'],
                    $delete
                )
            );
        }

        $template = array(
            'table_open' => '<table border="1" cellpadding="4" class="responstable">'
        );

        $this->table->set_template($template);
        $this->table->set_heading("Eesnimi","Perenimi","E-Mail","Telefon", "Admin",'<a href="'.base_url('Lisa/Kasutaja').'\">Lisa</a>');

        $data['table'] = $this->table->generate($table_rows);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('view/view_table');
        $this->load->view('templates/footer');
    }

    public function view_keywords()
    {
        $data['active'] = 'Märksõnad';
        $schools = $this->database_model->get_keywords();
        $data['title'] = 'Märksõnad';
        $table_rows = array();

        for ($i = 0; $i < count($schools); $i++) {
            $school = $schools[$i];
            $change_delete = '<a href="'.base_url("Muuda/Märksõna/".$school['id']).'">Muuda</a> / <a href="'.base_url('Kustuta/Märksõna/'.$school["id"]).'">Kustuta</a>';

            array_push(
                $table_rows,
                array(
                    $school['name'],
                    $change_delete
                )
            );
        }

        $template = array(
            'table_open' => '<table border="1" cellpadding="4" class="responstable">'
        );

        $this->table->set_template($template);
        $this->table->set_heading("Märksõna",'<a href="'.base_url('Lisa/Märksõna').'\">Lisa</a>');

        $data['table'] = $this->table->generate($table_rows);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('view/view_table');
        $this->load->view('templates/footer');
    }
}