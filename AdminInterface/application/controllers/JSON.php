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
        $start = strtolower($this->input->get('sõna'));
        $keywords = array();
        foreach ($this->database_model->get_keywords() as $keyword) {
            if (substr(strtolower($keyword['name']), 0, strlen($start)) === $start) {
                if (!in_array($keyword['name'], $keywords)) {
                    array_push($keywords, $keyword['name']);
                }
            }
        }
        sort($keywords);
        echo json_encode($keywords);
    }

    public function authors() {
        $start = strtolower($this->input->get('sõna'));
        $authors = array();
        $last_names = array();
        foreach ($this->database_model->get_authors() as $author) {
            if (substr(strtolower($author['lastname']), 0, strlen($start)) === $start) {
                if (!in_array($author, $authors)) {
                    array_push($authors, $author['firstname'].' '.$author['lastname']);
                    array_push($last_names, $author['lastname']);
                }
            }
        }
        array_multisort($last_names, SORT_STRING, $authors);
        echo json_encode($authors);
    }

    public function genres() {
        $start = strtolower($this->input->get('sõna'));
        $genres = array();
        foreach ($this->database_model->get_genres() as $genre) {
            if (substr(strtolower($genre['name']), 0, strlen($start)) === $start) {
                if (!in_array($genre['name'], $genres)) {
                    array_push($genres, $genre['name']);
                }
            }
        }
        sort($genres);
        echo json_encode($genres);
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