<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('database_model');
        $this->load->helper('url_helper');

        if (!isset($_SESSION['logged_in'])) {
            $_SESSION['REFERER'] = base_url($_SERVER['REQUEST_URI']);
            redirect(base_url());
        }
    }

    public function delete_school($school_id)
    {
        $this->database_model->delete_school($school_id);
        redirect(base_url("Koolid"));
    }

    public function delete_class($class_id)
    {
        $this->database_model->delete_class($class_id);
        redirect(base_url("Klassid"));
    }

    public function delete_book($book_id)
    {
        $this->database_model->delete_book($book_id);
        redirect(base_url("Raamatud"));
    }

    public function delete_from_list($id)
    {
        $list_item = $this->database_model->get_from_reading_list($id);
        $class_id = $list_item['class_id'];
        $this->database_model->delete_from_reading_list($id);
        redirect(base_url("Muuda/Nimekiri/".$class_id));
    }

    public function delete_list($id)
    {
        $this->database_model->delete_reading_list($id);
        redirect(base_url("Nimekiri"));
    }

    public function delete_user($user_id)
    {
        $this->database_model->delete_user($user_id);
        redirect(base_url("Kasutajad"));
    }

    public function delete_keyword($keyword_id)
    {
        $book_keyword_entries = $this->database_model->get_keywords(NULL, $keyword_id);
        foreach ($book_keyword_entries as $entry) {
            $this->database_model->delete_keyword_from_book($entry['id']);
        }
        $this->database_model->delete_keyword($keyword_id);
        redirect(base_url("Märksõnad"));
    }

    public function delete_keyword_from_book($id)
    {
        $book_id = $this->database_model->get_book_keyword_entry($id)['book_id'];
        $this->database_model->delete_keyword_from_book($id);
        redirect(base_url("Muuda/Raamat/".$book_id));
    }

    public function delete_author($author_id)
    {
        $book_keyword_entries = $this->database_model->get_authors(NULL, $author_id);
        foreach ($book_keyword_entries as $entry) {
            $this->database_model->delete_author_from_book($entry['id']);
        }
        $this->database_model->delete_author($author_id);
        redirect(base_url("Autorid"));
    }

    public function delete_author_from_book($id)
    {
        $book_id = $this->database_model->get_book_author_entry($id)['book_id'];
        $this->database_model->delete_author_from_book($id);
        redirect(base_url("Muuda/Raamat/".$book_id));
    }

    public function delete_genre($genre_id)
    {
        $book_genre_entries = $this->database_model->get_genres(NULL, $genre_id);
        foreach ($book_genre_entries as $entry) {
            $this->database_model->delete_genre_from_book($entry['id']);
        }
        $this->database_model->delete_genre($genre_id);
        redirect(base_url("Zanrid"));
    }

    public function delete_genre_from_book($id)
    {
        $book_id = $this->database_model->get_book_genre_entry($id)['book_id'];
        $this->database_model->delete_genre_from_book($id);
        redirect(base_url("Muuda/Raamat/".$book_id));
    }
}