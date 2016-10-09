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
        $data['schools'] = $this->database_model->get_schools();
        $data['title'] = 'Koolid';

        $i = 0;
        foreach ($data['schools'] as $school) {
            $data['schools'][$i]['edit'] = '<a href="'.site_url("Muuda/Kool/".$school['id']).'">Muuda</a>';
            $data['schools'][$i]['name'] = '<a href="'.site_url("Klassid/".$school['id']).'">'.$school['name'].'</a>';
            $i++;
        }

        $template = array(
            'table_open' => '<table border="1" cellpadding="4">',
            'table_close' => '<tr><td colspan="3"><a href="'.site_url('Lisa/Kool').'">Lisa uus kool</a> </td></tr></table>'
        );

        $this->table->set_template($template);
        $this->table->set_heading("Id", "Kooli nimi", "Muuda");

        $data['table'] = $this->table->generate($data['schools']);

        $this->load->view('templates/header', $data);
        $this->load->view('view/view_schools', $data);
        $this->load->view('templates/footer');
    }

    public function view_classes($id = NULL)
    {
        $data['classes'] = $this->database_model->get_classes($id);
        $data['title'] = 'Klassid';
        $i = 0;
        foreach ($data['classes'] as $class) {
            $data['classes'][$i]['school_id'] = $this->database_model->get_school_name($class['school_id']);
            $data['classes'][$i]['edit'] = '<a href="'.site_url("Muuda/Klass/".$class['id']).'">Muuda</a>';
            $i++;
        }

        $template = array(
            'table_open' => '<table border="1" cellpadding="4">',
            'table_close' => '<tr><td colspan="4"><a href="'.site_url('Lisa/Klass/'.$id).'">Lisa uus klass</a> </td></tr></table>'
        );

        $this->table->set_template($template);
        $this->table->set_heading("Id", "Kooli nimi", "Klassi nimi", "Muuda");

        $data['table'] = $this->table->generate($data['classes']);

        $this->load->view('templates/header', $data);
        $this->load->view('view/view_classes', $data);
        $this->load->view('templates/footer');
    }
}