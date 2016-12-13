<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {
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

    public function set_messages() {
        $this->form_validation->set_message('required', '%s väli on kohustuslik.');
        $this->form_validation->set_message('is_unique', '%s väli peab olema unikaalne.');
        $this->form_validation->set_message('valid_email', '%s väli peab olema emaili kujuga.');
        $this->form_validation->set_message('numeric', '%s väli peab olema numbriline.');
    }

    public function add_user() {
        if ($_SESSION['is_admin'] != 1) {
            redirect(base_url('Koolid'));
        }
        $data['active'] = 'Kasutajad';
        $data['title'] = 'Kasutaja lisamine';

        $this->set_messages();

        $this->form_validation->set_rules('firstname', 'Eesnime', 'required');
        $this->form_validation->set_rules('lastname', 'Perenime', 'required');
        $this->form_validation->set_rules('email', 'E-Maili', 'is_unique[account.email]|valid_email|required');
        $this->form_validation->set_rules('password', 'Parooli', 'required');
        $this->form_validation->set_rules('phone', 'Tefefoni', 'numeric|required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('add/user');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_user();
            redirect(base_url("Kasutajad"));
        }
    }

    public function add_school() {
        $data['active'] = 'Koolid';
        $data['title'] = 'Kooli lisamine';

        $this->set_messages();

        $this->form_validation->set_rules('name', 'Kooli nime', 'is_unique[school.name]|required');
        $this->form_validation->set_rules('phone', 'Telefoni', 'numeric|required');
        $this->form_validation->set_rules('email', 'E-Maili', 'valid_email|required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('add/school');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_school();
            redirect(base_url("Koolid"));
        }
    }

    public function add_class() {
        $data['active'] = 'Klassid';
        $data['title'] = 'Klassi lisamine';

        $this->set_messages();
        $this->form_validation->set_message('class_name_check', 'Sellel koolil on juba sellise nimega klass.');

        $this->form_validation->set_rules('name', 'Klassi nime', 'required|callback_class_name_check['.$this->input->post('school_id').']');
        $this->form_validation->set_rules('school_id', 'Kooli nime', 'numeric|required');

        if ($this->form_validation->run() === FALSE) {
            $dropdown_rows = array();
            $schools = $this->database_model->get_schools();
            for ($i = 0; $i < count($schools); $i++) {
                $school = $schools[$i];
                array_push($dropdown_rows, '<option value="'.$school['id'].'">'.$school['name'].'</option>');
            }
            $data['school_options'] = implode('',$dropdown_rows);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('add/class');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_class();
            redirect(base_url("Klassid"));
        }
    }

    public function add_book() {
        $data['active'] = 'Raamatud';
        $data['title'] = 'Raamatu lisamine';

        $this->set_messages();

        $this->form_validation->set_rules('title', 'Pealkirja', 'is_unique[book.title]|required');
        $this->form_validation->set_rules('lang', 'Keele', 'required');
        $this->form_validation->set_rules('year', 'Aasta', 'numeric|required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('add/book');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_book();
            redirect(base_url("Raamatud"));
        }
    }

    public function add_keyword() {
        $data['active'] = 'Märksõnad';
        $data['title'] = 'Märksõna lisamine';

        $this->set_messages();

        $this->form_validation->set_rules('name', 'Märksõna nime', 'is_unique[keyword.name]|required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('add/keyword');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_keyword();
            redirect(base_url("Märksõnad"));
        }
    }

    public function add_author() {
        $data['active'] = 'Autor';
        $data['title'] = 'Autori lisamine';

        $this->set_messages();

        $this->form_validation->set_rules('firstname', 'Eesnime', 'required');
        $this->form_validation->set_rules('lastname', 'Perenime', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('add/author');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_author();
            redirect(base_url("Autorid"));
        }
    }

    public function add_genre() {
        $data['active'] = 'Žanrid';
        $data['title'] = 'Žanri lisamine';

        $this->set_messages();

        $this->form_validation->set_rules('name', 'Žanri nime', 'is_unique[genre.name]|required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('add/genre');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_genre();
            redirect(base_url("Žanrid"));
        }
    }

    public function add_book_to_list($class_id=NULL) {
        $data['active'] = 'Nimekiri';
        $data['title'] = 'Raamatu lisamine';

        $this->set_messages();
        $this->form_validation->set_message('check_book_in_list', 'See raamat on juba selles lugemisnimekirjas.');

        $this->form_validation->set_rules('class_id', 'Klassi nime', 'numeric|required');
        $this->form_validation->set_rules('book_id', 'Raamatu pealkirja', 'numeric|required|callback_check_book_in_list['.$this->input->post('class_id').']');

        if ($this->form_validation->run() === FALSE) {
            if ($class_id) {
                $data['form_action'] = base_url("Lisa/Nimekiri/".$class_id);
                $data['cancel_link'] = base_url("Muuda/Nimekiri/".$class_id);
            } else {
                $data['form_action'] = base_url("Lisa/Nimekiri");
                $data['cancel_link'] = base_url("Nimekiri");
            }

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

            $dropdown_rows_books = array();
            $books = $this->database_model->get_books();
            $books_in_list = array();
            foreach ($this->database_model->get_books_in_list($class_id) as $entry) {
                array_push($books_in_list, $entry['book_id']);
            }
            for ($i = 0; $i < count($books); $i++) {
                $book = $books[$i];
                if (in_array($book['id'], $books_in_list)) {
                    continue;
                }
                $dropdown_rows_books[$book['id']] = $book['title'];
                array_push($dropdown_rows_books, '<option value="'.$book['id'].'">'.$book['title'].'</option>');
            }

            $data['classes'] = implode('', $dropdown_rows_classes);
            $data['books'] = implode('', $dropdown_rows_books);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('add/book_to_list');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_book_to_reading_list();
            if ($class_id) {
                redirect("Muuda/Nimekiri/".$class_id);
            } else {
                redirect(base_url('Nimekiri'));
            }
        }
    }

    public function add_keyword_to_book($book_id) {
        $data['active'] = 'Raamatud';
        $data['title'] = 'Raamatule märksõna lisamine';

        $this->set_messages();
        $this->form_validation->set_message('check_keyword_in_book', 'Sellel raamatul on juba selline märksõna.');

        $this->form_validation->set_rules('keyword_id', 'Märksõna nime', 'required|callback_check_keyword_in_book['.$book_id.']');

        if ($this->form_validation->run() === FALSE) {
            $data['form_action'] = base_url('Lisa/Märksõna/'.$book_id);
            $data['cancel_link'] = base_url('Muuda/Raamat/'.$book_id);

            $keywords_in_book = array();
            foreach ($this->database_model->get_keywords($book_id) as $entry) {
                array_push($keywords_in_book, $entry['keyword_id']);
            }
            $keywords = array();
            foreach ($this->database_model->get_keywords() as $keyword) {
                if (in_array($keyword['id'], $keywords_in_book)) {
                    continue;
                }
                array_push($keywords, '<option value="'.$keyword['id'].'">'.$keyword['name'].'</option>');
            }
            $data['keywords'] = implode('', $keywords);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('add/keyword_to_book');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_keyword_to_book($book_id);
            redirect(base_url('Muuda/Raamat/'.$book_id));
        }
    }

    public function add_author_to_book($book_id) {
        $data['active'] = 'Autorid';
        $data['title'] = 'Raamatule autori lisamine';

        $this->set_messages();
        $this->form_validation->set_message('check_author_in_book', 'Sellel raamatul on juba selline autor.');

        $this->form_validation->set_rules('author_id', 'Autori nime', 'required|callback_check_author_in_book['.$book_id.']');

        if ($this->form_validation->run() === FALSE) {
            $data['form_action'] = base_url('Lisa/Autor/'.$book_id);
            $data['cancel_link'] = base_url('Muuda/Raamat/'.$book_id);
            
            $authors_in_book = array();
            foreach ($this->database_model->get_authors($book_id) as $entry) {
                array_push($authors_in_book, $entry['author_id']);
            }
            $authors = array();
            foreach ($this->database_model->get_authors() as $author) {
                if (in_array($author['id'], $authors_in_book)) {
                    continue;
                }
                array_push($authors, '<option value="'.$author['id'].'">'.$author['firstname'].' '.$author['lastname'].'</option>');
            }
            $data['keywords'] = implode('', $authors);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('add/author_to_book');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_author_to_book($book_id);
            redirect(base_url('Muuda/Raamat/'.$book_id));
        }
    }

    public function add_genre_to_book($book_id) {
        $data['active'] = 'Žanrid';
        $data['title'] = 'Raamatule žanri lisamine';

        $this->set_messages();
        $this->form_validation->set_message('check_genre_in_book', 'Sellel raamatul on juba selline žanr.');

        $this->form_validation->set_rules('genre_id', 'Žanri nime', 'required|callback_check_genre_in_book['.$book_id.']');

        if ($this->form_validation->run() === FALSE) {
            $data['form_action'] = base_url('Lisa/Žanr/'.$book_id);
            $data['cancel_link'] = base_url('Muuda/Raamat/'.$book_id);

            $genres_in_book = array();
            foreach ($this->database_model->get_genres($book_id) as $entry) {
                array_push($genres_in_book, $entry['genre_id']);
            }
            $genres = array();
            foreach ($this->database_model->get_genres() as $genre) {
                if (in_array($genre['id'], $genres_in_book)) {
                    continue;
                }
                array_push($genres, '<option value="'.$genre['id'].'">'.$genre['name'].'</option>');
            }
            $data['genres'] = implode('', $genres);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('add/genre_to_book');
            $this->load->view('templates/footer');
        } else {
            $this->database_model->add_genre_to_book($book_id);
            redirect(base_url('Muuda/Raamat/'.$book_id));
        }
    }

    public function class_name_check($class_name, $school_id) {
        $classes = $this->database_model->get_classes($school_id);
        foreach ($classes as $class) {
            if ($class['name'] === $class_name) {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function check_book_in_list($book_id, $class_id) {
        $books_in_list = $this->database_model->get_reading_list_from_class($class_id);
        foreach ($books_in_list as $book) {
            if ($book['book_id'] === $book_id) {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function check_keyword_in_book($keyword_id, $book_id) {
        $keywords = $this->database_model->get_keywords($book_id);
        foreach ($keywords as $keyword) {
            if ($keyword['keyword_id'] === $keyword_id) {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function check_author_in_book($author_id, $book_id) {
        $authors = $this->database_model->get_authors($book_id);
        foreach ($authors as $author) {
            if ($author['author_id'] === $author_id) {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function check_genre_in_book($genre_id, $book_id) {
        $genres = $this->database_model->get_genres($book_id);
        foreach ($genres as $genre) {
            if ($genre['genre_id'] === $genre_id) {
                return FALSE;
            }
        }
        return TRUE;
    }
}