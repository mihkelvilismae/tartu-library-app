<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JSON extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('database_model');
    }

    public function schools() {
        $schools = $this->database_model->get_schools();

        $arr = array();

        for ($i = 0; $i < count($schools); $i++) {
            $school = $schools[$i];
            $arr[$school['id']] = $school['name'];
        }

        echo json_encode($arr);
    }

    public function classes($school_id) {
        $classes = $this->database_model->get_classes($school_id);

        $arr = array();

        for ($i = 0; $i < count($classes); $i++) {
            $class = $classes[$i];
            $arr[$class['id']] = $class['name'];
        }

        echo json_encode($arr);
    }

    public function lists($class_id) {
        $items = $this->database_model->get_reading_list_from_class($class_id);

        $arr = array();

        for ($i = 0; $i < count($items); $i++) {
            $item = $items[$i];
            $arr[$item['id']] = $this->database_model->get_book($item['book_id'])['title'];
        }

        echo json_encode($arr);
    }

    public function keywords() {
        $keywords = $this->database_model->get_keywords();
        echo json_encode($keywords);
    }

    public function search() {
        $author = $this->input->get('autor');
        $keyword = $this->input->get('zanr');
        $language = $this->input->get('keel');

        $year = array();
        if (!($this->input->get('aasta') == '')) {
            foreach (explode(',', $this->input->get('aasta')) as $y) {
                array_push($year, $y);
                if (count($year) == 2) {
                    break;
                }
            }
        }

        $keywords = array();

        if (!($keyword == '')) {
            foreach (explode(',', $keyword) as $kwd) {
                array_push($keywords, $kwd);
            }
        }

        echo json_encode($this->database_model->search($author, $keywords, $language, $year));
    }
}