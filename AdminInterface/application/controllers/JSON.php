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
            $book = $this->database_model->get_book($item['book_id']);

//            $authors = array();
//            foreach ($this->database_model->get_authors($book['id']) as $a) {
//                $author = $this->database_model->get_author($a['author_id']);
//                array_push($authors, $author["firstname"].' '.$author['lastname']);
//            }
//            $book["authors"] = implode(", ", $authors);
//            $genres = array();
//            foreach ($this->database_model->get_genres($book['id']) as $g) {
//                $genre = $this->database_model->get_genre($g['genre_id']);
//                array_push($genres, $genre["name"]);
//            }
//            $book["genres"] = implode(", ", $genres);
//            $keywords = array();
//            foreach ($this->database_model->get_keywords($book['id']) as $k) {
//                $keyword = $this->database_model->get_keyword($k['keyword_id']);
//                array_push($keywords, $keyword["name"]);
//            }
//            $book["keywords"] = implode(", ", $keywords);
//            array_push($arr, $book);
            $arr[$item['book_id']] = $this->database_model->get_book($item['book_id'])['title'];
        }

        echo json_encode($arr);
    }

    public function keywords() {
        $start = strtolower($this->input->get('sõna'));
        $keywords = array();
        foreach ($this->database_model->get_keywords() as $keyword) {
            if (substr(strtolower($keyword['name']), 0, strlen($start)) === $start) {
                if (!in_array($keyword['name'], $keywords)) {
                    $keywords[$keyword['id']] = $keyword['name'];
                }
            }
        }
        asort($keywords);
        echo json_encode($keywords, JSON_FORCE_OBJECT);
    }

    public function authors() {
        $start = strtolower($this->input->get('sõna'));
        $authors = array();
        $last_names = array();
        foreach ($this->database_model->get_authors() as $author) {
            if (substr(strtolower($author['lastname']), 0, strlen($start)) === $start) {
                if (!in_array($author, $authors)) {
                    $authors[$author['id']] = $author['firstname'].' '.$author['lastname'];
                    array_push($last_names, $author['lastname']);
                }
            }
        }
        $keys = array_keys($authors);
        array_multisort($last_names, SORT_STRING, $authors, $keys);
        $arr = array_combine($keys, $authors);
        echo json_encode($arr);
    }

    public function genres() {
        $start = strtolower($this->input->get('sõna'));
        $genres = array();
        foreach ($this->database_model->get_genres() as $genre) {
            if (substr(strtolower($genre['name']), 0, strlen($start)) === $start) {
                if (!in_array($genre['name'], $genres)) {
                    $genres[$genre['id']] = $genre['name'];
                }
            }
        }
        asort($genres);
        echo json_encode($genres);
    }

    public function book() {
        $id = strtolower($this->input->get('id'));
        $book = $this->database_model->get_book($id);

        $authors = array();
        foreach ($this->database_model->get_authors($book['id']) as $a) {
            $author = $this->database_model->get_author($a['author_id']);
            array_push($authors, $author["firstname"].' '.$author['lastname']);
        }
        $book["authors"] = implode(", ", $authors);
        $genres = array();
        foreach ($this->database_model->get_genres($book['id']) as $g) {
            $genre = $this->database_model->get_genre($g['genre_id']);
            array_push($genres, $genre["name"]);
        }
        $book["genres"] = implode(", ", $genres);
        $keywords = array();
        foreach ($this->database_model->get_keywords($book['id']) as $k) {
            $keyword = $this->database_model->get_keyword($k['keyword_id']);
            array_push($keywords, $keyword["name"]);
        }
        $book["keywords"] = implode(", ", $keywords);


        echo json_encode($book);
    }

    public function search() {
        $author = $this->input->get('autor');
        $keyword = $this->input->get('märksõna');
        $language = $this->input->get('keel');
        $genre = $this->input->get('žanr');

        $year = array();
        if (!($this->input->get('aasta') == '')) {
            foreach (explode(',', $this->input->get('aasta')) as $y) {
                array_push($year, $y);
                if (count($year) == 2) {
                    break;
                }
            }
        }

        $authors = array();
        if (!($author == '')) {
            foreach (explode(',', $author) as $a) {
                array_push($authors, $a);
            }
        }

        $keywords = array();
        if (!($keyword == '')) {
            foreach (explode(',', $keyword) as $kwd) {
                array_push($keywords, $kwd);
            }
        }

        $languages = array();
        if (!($language == '')) {
            foreach (explode(',', $language) as $l) {
                array_push($languages, $l);
            }
        }

        $genres = array();
        if (!($genre == '')) {
            foreach (explode(',', $genre) as $g) {
                array_push($genres, $g);
            }
        }

        $books = $this->database_model->search($authors, $keywords, $languages, $year, $genres);
//        $i = 0;
//        foreach ($books as $book) {
//            $authors = array();
//            foreach ($this->database_model->get_authors($book['id']) as $a) {
//                $author = $this->database_model->get_author($a['author_id']);
//                array_push($authors, $author["firstname"].' '.$author['lastname']);
//            }
//            $books[$i]["authors"] = implode(", ", $authors);
//            $genres = array();
//            foreach ($this->database_model->get_genres($book['id']) as $g) {
//                $genre = $this->database_model->get_genre($g['genre_id']);
//                array_push($genres, $genre["name"]);
//            }
//            $books[$i]["genres"] = implode(", ", $genres);
//            $keywords = array();
//            foreach ($this->database_model->get_keywords($book['id']) as $k) {
//                $keyword = $this->database_model->get_keyword($k['keyword_id']);
//                array_push($keywords, $keyword["name"]);
//            }
//            $books[$i]["keywords"] = implode(", ", $keywords);
//
////            $books[$i]["authors"] = array();
////            foreach ($this->database_model->get_authors($book['id']) as $a) {
////                $author = $this->database_model->get_author($a['author_id']);
////                array_push($books[$i]["authors"], $author["firstname"].' '.$author['lastname']);
////            }
////            $books[$i]["genres"] = array();
////            foreach ($this->database_model->get_genres($book['id']) as $g) {
////                $genre = $this->database_model->get_genre($g['genre_id']);
////                array_push($books[$i]["genres"], $genre["name"]);
////            }
////            $books[$i]["keywords"] = array();
////            foreach ($this->database_model->get_keywords($book['id']) as $k) {
////                $keyword = $this->database_model->get_keyword($k['keyword_id']);
////                array_push($books[$i]["keywords"], $keyword["name"]);
////            }
//            $i++;
//        }

        $arr = array();
        foreach ($books as $book) {
            $arr[$book['id']] = $book['title'];
        }

        echo json_encode($arr);
    }
}