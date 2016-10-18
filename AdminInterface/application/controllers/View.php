<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('database_model');
        $this->load->library('table');
        $this->load->helper('url_helper');
    }

    public function view_schools()
    {
        $schools = $this->database_model->get_schools();
        $data['title'] = 'Koolid';
        $table_rows = array();

        for ($i = 0; $i < count($schools); $i++) {
            $school = $schools[$i];
            $change_delete = '<a href="'.base_url("Muuda/Kool/".$school['id']).'">Muuda</a> / <a href="'.base_url('Kustuta/Kool/'.$school["id"]).'">Kustuta</a>';

            array_push(
                $table_rows,
                array(
                    '<a href="'.base_url("Klassid/".$school['id']).'">'.$school['name'].'</a>',
                    $school['phone'],
                    $school['email'],
                    $change_delete
                )
            );
        }

        $template = array(
            'table_open' => '<table border="1" cellpadding="4">'
        );

        $this->table->set_template($template);
        $this->table->set_heading("Kooli nimi","Telefon","E-Mail",'<a href="'.base_url('Lisa/Kool').'\">Lisa</a>');

        $data['table'] = $this->table->generate($table_rows);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('view/view_table');
        $this->load->view('templates/footer');
    }

    public function view_classes()
    {
        $data['title'] = 'Klassid';

        $table_rows = array();
        $template = array(
            'table_open' => '<table border="1" cellpadding="4">'
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
        $this->load->view('templates/sidebar');
        $this->load->view('view/view_table');
        $this->load->view('templates/footer');
    }

    public function view_books()
    {
        $data['books'] = $this->database_model->get_books();
        $data['title'] = 'Raamatud';
        $i = 0;
        foreach ($data['books'] as $book) {
            $data['books'][$i]['edit'] = '<a href="'.base_url("Muuda/Raamat/".$book['id']).'">Muuda</a>';
            $i++;
        }

        $template = array(
            'table_open' => '<table border="1" cellpadding="4">',
            'table_close' => '<tr><td colspan="5"><a href="'.base_url('Lisa/Raamat').'">Lisa uus raamat</a> </td></tr>
                <tr><td colspan="5"><a href="'.base_url('Kustuta/Raamat').'">Kustuta raamat</a></td></tr>
                </table>'
        );

        $this->table->set_template($template);
        $this->table->set_heading("Id", "Raamatu nimi", "Autor", "Aasta", "Muuda");

        $data['table'] = $this->table->generate($data['books']);

        $this->load->view('templates/header', $data);
        $this->load->view('view/view_books', $data);
        $this->load->view('templates/footer');
    }

    public function view_reading_list()
    {

        $data['title'] = 'Nimekirjad';

        $table_rows = array();
        $template = array(
            'table_open' => '<table border="1" cellpadding="4">'
        );

        $this->table->set_template($template);
        $this->table->set_heading("Klassi nimi", "Kooli nimi", "Raamatu nimi", '<a href="'.base_url('Lisa/Nimekiri').'\">Lisa</a>');

        $list_rows = $this->database_model->get_list();
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
                    $this->database_model->get_book_by_id($row['book_id']),
                    $change_delete
                )
            );
        }

        $data['table'] = $this->table->generate($table_rows);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('view/view_table');
        $this->load->view('templates/footer');

    }
}