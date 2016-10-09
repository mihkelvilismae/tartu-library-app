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
        $template = array(
            'table_open' => '<table border="1" cellpadding="4">',
            'table_close' => '<tr><td colspan="3"><a href="'.site_url('Lisa/Kool').'">Lisa uus kool</a> </td></tr></table>'
        );

        $this->table->set_template($template);
        $this->table->set_heading("Id", "Name");

        $data['table'] = $this->table->generate($data['schools']);

        $this->load->view('view/view_schools', $data);
    }

    public function view_classes()
    {
        $data['classes'] = $this->database_model->get_classes();

        $i = 0;
        foreach ($data['classes'] as $class) {
            $data['classes'][$i]['school_id'] = $this->database_model->get_school_name($class['school_id']);
            $i++;
        }

        $template = array(
            'table_open' => '<table border="1" cellpadding="4">',
            'table_close' => '<tr><td colspan="3"><a href="'.site_url('Lisa/Klass').'">Lisa uus klass</a> </td></tr></table>'
        );

        $this->table->set_template($template);
        $this->table->set_heading("Id", "Name", "1");

        $data['table'] = $this->table->generate($data['classes']);

        $this->load->view('view/view_classes', $data);
    }
}