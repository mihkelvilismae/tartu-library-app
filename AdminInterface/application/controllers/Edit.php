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

        $this->form_validation->set_message('unique_school_name', 'The school name must be unique.');

        $this->form_validation->set_rules('name', 'Name', 'callback_unique_school_name['.$school_id.']|required');
        $this->form_validation->set_rules('phone', 'Phone', 'numeric|required');
        $this->form_validation->set_rules('email', 'E-Mail', 'valid_email|required');

        if ($this->form_validation->run() === FALSE) {
            $data['form_action'] = base_url('Muuda/Kool/'.$school_id);

            $school = $this->database_model->get_school($school_id);
            $data['name'] = $this->input->post('name') ? $this->input->post('name') : $school['name'];
            $data['phone'] = $this->input->post('phone') ? $this->input->post('phone') : $school['phone'];
            $data['email'] = $this->input->post('email') ? $this->input->post('email') : $school['email'];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('edit/school');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->edit_school($school_id);
            redirect(base_url('Koolid'));
        }
    }

    public function edit_class($class_id) {
        $data['active'] = 'Klassid';
        $data['title'] = 'Klassi muutmine';

        $this->form_validation->set_message('class_name_check', 'The school already has a class named that.');

        $this->form_validation->set_rules('name', 'Name', 'required|callback_class_name_check['.$this->input->post('school_id').']');
        $this->form_validation->set_rules('school_id', 'Kooli nimi', 'numeric|required');

        if ($this->form_validation->run() === FALSE) {
            $data['form_action'] = base_url('Muuda/Klass/'.$class_id);
            $class = $this->database_model->get_class_by_id($class_id);

            $schools = array();
            foreach ($this->database_model->get_schools() as $school) {
                if ($class['school_id'] == $school['id']) {
                    array_push($schools, '<option value="'.$school['id'].'" selected="selected">'.$school['name'].'</option>');
                } else {
                    array_push($schools, '<option value="'.$school['id'].'">'.$school['name'].'</option>');
                }
            }

            $data['school_options'] = implode('', $schools);
            $data['class_name'] = $this->input->post('name') ? $this->input->post('name') : $class['name'];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('edit/class');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->edit_class($class_id);
            redirect(base_url("Klassid"));
        }
    }

    public function edit_book($book_id) {
        $data['active'] = 'Raamatud';
        $data['title'] = 'Raamatu muutmine';

        $this->form_validation->set_message('unique_book_title', 'The book title must be unique.');
        $this->form_validation->set_rules('title', 'title', 'callback_unique_book_title['.$book_id.']|required');
        $this->form_validation->set_rules('lang', 'language', 'required');
        $this->form_validation->set_rules('year', 'year', 'numeric|required');

        if ($this->form_validation->run() === FALSE) {
            $data['form_action'] = base_url('Muuda/Raamat/'.$book_id);
            $book = $this->database_model->get_book($book_id);

            $authors = array();
            foreach ($this->database_model->get_authors($book_id) as $author) {
                $e = $this->database_model->get_author($author['author_id']);
                array_push($authors, '<li class="list-group-item">'.$e['firstname'].' '.$e['lastname'].' <a href="'.base_url('Kustuta/RaamatultAutor/'.$author['id']).'">Kustuta</a>'.'</li>');
            }
            array_push($authors, '<li class="list-group-item"><a href="'.base_url("Lisa/Autor/".$book_id).'">Lisa autor</a></li>');

            $keywords = array();
            foreach ($this->database_model->get_keywords($book_id) as $keyword) {
                $e = $this->database_model->get_keyword($keyword['keyword_id']);
                array_push($keywords, '<li class="list-group-item">'.$e['name'].' <a href="'.base_url('Kustuta/RaamatultMärksõna/'.$keyword['id']).'">Kustuta</a>'.'</li>');
            }
            array_push($keywords, '<li class="list-group-item"><a href="'.base_url("Lisa/Märksõna/".$book_id).'">Lisa märksõna</a></li>');

            $genres = array();
            foreach ($this->database_model->get_genres($book_id) as $genre) {
                $e = $this->database_model->get_genre($genre['genre_id']);
                array_push($genres, '<li class="list-group-item">'.$e['name'].' <a href="'.base_url('Kustuta/RaamatultŽanr/'.$genre['id']).'">Kustuta</a>'.'</li>');
            }
            array_push($genres, '<li class="list-group-item"><a href="'.base_url("Lisa/Žanr/".$book_id).'">Lisa žanr</a></li>');

            $data['authors'] = implode('', $authors);
            $data['keywords'] = implode('', $keywords);
            $data['genres'] = implode('', $genres);
            $data['book_title'] = $this->input->post('title') ? $this->input->post('title') : $book['title'];
            $data['lang'] = $this->input->post('lang') ? $this->input->post('lang') : $book['lang'];
            $data['year'] = $this->input->post('year') ? $this->input->post('year') : $book['year'];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('edit/book');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->edit_book($book_id);
            redirect(base_url('Raamatud'));
        }
    }

    public function edit_reading_list($class_id) {
        $data['active'] = 'Nimekiri';
        $data['title'] = 'Raamatunimekirja muutmine';

        $this->form_validation->set_message('is_unique', 'The class already has a reading list.');
        $this->form_validation->set_rules('class_id', 'Class', 'numeric|required|is_unique[reading_list.class_id]');

        if ($this->form_validation->run() === FALSE) {
            $data['form_action'] = base_url('Muuda/Nimekiri/'.$class_id);

            $dropdown_rows_classes = array();
            $schools = $this->database_model->get_schools();
            for ($i = 0; $i < count($schools); $i++) {
                $school = $schools[$i];
                $classes_rows = $this->database_model->get_classes($school['id']);
                $classes = array();
                for ($j = 0; $j < count($classes_rows); $j++) {
                    $class = $classes_rows[$j];
                    if ($class_id == $class['id']) {
                        array_push($classes, '<option value="'.$class['id'].'" selected="selected">'.$class['name'].'</option>');
                    } else {
                        array_push($classes, '<option value="'.$class['id'].'">'.$class['name'].'</option>');
                    }
                }
                array_push($dropdown_rows_classes, '<optgroup label="'.$school['name'].'">'.implode('', $classes).'</optgroup>');
            }

            $books = array();
            foreach ($this->database_model->get_reading_list_from_class($class_id) as $e) {
                $book = $this->database_model->get_book($e['book_id']);
                array_push($books, '<li class="list-group-item">'.$book['title'].' <a href="'.base_url('Kustuta/Nimekirjast/'.$e['id']).'">Kustuta</a>'.'</li>');
            }
            array_push($books, '<li class="list-group-item"><a href="'.base_url("Lisa/Nimekiri/".$class_id).'">Lisa raamat</a></li>');

            $data['class_options'] = implode('', $dropdown_rows_classes);
            $data['books'] = implode('', $books);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('edit/reading_list');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->edit_reading_list($class_id);
            redirect(base_url('Nimekiri'));
        }
    }

    public function edit_keyword($keyword_id) {
        $data['active'] = 'Märksõnad';
        $data['title'] = 'Märksõna muutmine';

        $this->form_validation->set_message('unique_keyword_name', 'The keyword name must be unique.');
        $this->form_validation->set_rules('name', 'Name', 'callback_unique_keyword_name['.$keyword_id.']|required');

        if ($this->form_validation->run() === FALSE) {
            $data['form_action'] = base_url('Muuda/Märksõna/'.$keyword_id);
            $keyword = $this->database_model->get_keyword($keyword_id);

            $data['name'] = $this->input->post('name') ? $this->input->post('name') : $keyword['name'];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('edit/keyword');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->edit_keyword($keyword_id);
            redirect(base_url('Märksõnad'));
        }
    }

    public function edit_author($author_id) {
        $data['active'] = 'Autor';
        $data['title'] = 'Autori muutmine';

        $this->form_validation->set_rules('firstname', 'firstname', 'required');
        $this->form_validation->set_rules('lastname', 'lastname', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['form_action'] = base_url('Muuda/Autor/'.$author_id);
            $author = $this->database_model->get_author($author_id);

            $data['firstname'] = $this->input->post('firstname') ? $this->input->post('firstname') : $author['firstname'];
            $data['lastname'] = $this->input->post('lastname') ? $this->input->post('lastname') : $author['lastname'];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('edit/author');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->edit_author($author_id);
            redirect(base_url('Autorid'));
        }
    }

    public function edit_genre($genre_id) {
        $data['active'] = 'Žanrid';
        $data['title'] = 'Žanri muutmine';

        $this->form_validation->set_message('unique_genre_name', 'The genre name must be unique.');
        $this->form_validation->set_rules('name', 'Name', 'callback_unique_genre_name['.$genre_id.']|required');

        if ($this->form_validation->run() === FALSE) {
            $data['form_action'] = base_url('Muuda/Žanr/'.$genre_id);
            $genre = $this->database_model->get_genre($genre_id);

            $data['name'] = $this->input->post('name') ? $this->input->post('name') : $genre['name'];

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('edit/genre', $data);
            $this->load->view('templates/footer');
        } else {
            $this->database_model->edit_genre($genre_id);
            redirect(base_url('Žanrid'));
        }
    }


    public function unique_school_name($school_name, $school_id) {
        $schools = $this->database_model->get_schools();
        foreach ($schools as $school) {
            if ($school['id'] == $school_id) {
                continue;
            }
            if ($school['name'] === $school_name) {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function unique_book_title($book_title, $book_id) {
        $books = $this->database_model->get_books();
        foreach ($books as $book) {
            if ($book['id'] == $book_id) {
                continue;
            }
            if ($book['title'] === $book_title) {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function class_name_check($class_name, $school_id) {
        $classes = $this->database_model->get_classes($school_id);
        foreach ($classes as $class) {
            if ($class['id'] == $this->uri->segment(3)) {
                continue;
            }
            if ($class['name'] === $class_name) {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function unique_keyword_name($keyword_name, $keyword_id) {
        $keywords = $this->database_model->get_keywords();
        foreach ($keywords as $keyword) {
            if ($keyword['id'] == $keyword_id) {
                continue;
            }
            if ($keyword['name'] === $keyword_name) {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function unique_genre_name($genre_name, $genre_id) {
        $genres = $this->database_model->get_genres();
        foreach ($genres as $genre) {
            if ($genre['id'] == $genre_id) {
                continue;
            }
            if ($genre['name'] === $genre_name) {
                return FALSE;
            }
        }
        return TRUE;
    }
}