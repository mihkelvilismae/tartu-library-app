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

    public function getTable($heading, $rows) {
        $template = array(
            'table_open' => '<table class="table table-bordered">'
        );

        $this->table->set_template($template);
        $this->table->set_heading($heading);

        return $this->table->generate($rows);
    }

    public function getLink($linkText, $linkDestination, $btnStyle='btn-primary btn-xs') {
        return '<a href="'.$linkDestination.'" class="btn '.$btnStyle.'" role="button">'.$linkText.'</a>';
    }

    public function getButtonGroup($buttons) {
        return '<div class="btn-group">'.implode('', $buttons).'</div>';
    }

    public function view_users() {
        if ($_SESSION['is_admin'] != 1) {
            redirect(base_url('Koolid'));
        }
        $data['title'] = 'Kasutajad';

        $table_rows = array();
        $users = $this->database_model->get_users();
        for ($i = 0; $i < count($users); $i++) {
            $user = $users[$i];

            $delete = $this->getLink('Kustuta', base_url('Kustuta/Kasutaja/'.$user["id"]), 'btn-warning btn-xs');

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

        $heading = array("Eesnimi", "Perenimi", "E-Mail", "Telefon", "Admin", $this->getLink('Lisa kasutaja', base_url('Lisa/Kasutaja')));
        $data['table'] = $this->getTable($heading, $table_rows);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('view/view_table');
        $this->load->view('templates/footer');
    }

    public function view_schools() {
        $data['title'] = 'Koolid';

        $table_rows = array();
        $schools = $this->database_model->get_schools();
        for ($i = 0; $i < count($schools); $i++) {
            $school = $schools[$i];
            $change_delete = $this->getButtonGroup(array(
                $this->getLink('Muuda', base_url("Muuda/Kool/".$school['id'])),
                $this->getLink('Kustuta', base_url('Kustuta/Kool/'.$school["id"]), 'btn-warning btn-xs')
            ));
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

        $heading = array("Kooli nimi", "Telefon", "E-Mail", $this->getLink('Lisa kool', base_url('Lisa/Kool')));
        $data['table'] = $this->getTable($heading, $table_rows);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('view/view_table');
        $this->load->view('templates/footer');
    }

    public function view_classes() {
        $data['title'] = 'Klassid';

        $table_rows = array();
        $classes = $this->database_model->get_classes();
        for ($i = 0; $i < count($classes); $i++) {
            $class = $classes[$i];
            $change_delete = $this->getButtonGroup(array(
                $this->getLink('Muuda', base_url("Muuda/Klass/".$class['id'])),
                $this->getLink('Kustuta', base_url('Kustuta/Klass/'.$class["id"]), 'btn-warning btn-xs')
            ));

            array_push(
                $table_rows,
                array(
                    $class['name'],
                    $this->database_model->get_school_name($class['school_id']),
                    $change_delete
                )
            );
        }

        $heading = array("Klassi nimi", "Kooli nimi", $this->getLink('Lisa klass', base_url('Lisa/Klass')));
        $data['table'] = $this->getTable($heading, $table_rows);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('view/view_table');
        $this->load->view('templates/footer');
    }

    public function view_reading_list() {
        $data['title'] = 'Nimekirjad';

        $table_rows = array();
        $list_rows = $this->database_model->get_list();
        $classes = $this->database_model->get_classes();
        for ($i = 0; $i < count($classes); $i++) {
            $class = $classes[$i];
            $school = $this->database_model->get_school_name($class['school_id']);

            $change_delete = $this->getButtonGroup(array(
                $this->getLink('Muuda', base_url("Muuda/Nimekiri/".$class['id'])),
                $this->getLink('Kustuta', base_url('Kustuta/Nimekiri/'.$class["id"]), 'btn-warning btn-xs')
            ));

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
                        $this->getLink($books, base_url('Muuda/Nimekiri/'.$class['id']), 'btn-xs'),
                        $change_delete
                    )
                );
            }
        }

        $heading = array("Klassi nimi", "Kooli nimi", "Raamatud", $this->getLink('Lisa raamat nimekirja', base_url('Lisa/Nimekiri')));
        $data['table'] = $this->getTable($heading, $table_rows);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('view/view_table');
        $this->load->view('templates/footer');
    }

    public function view_books() {
        $data['title'] = 'Raamatud';

        $table_rows = array();
        $books = $this->database_model->get_books();
        for ($i = 0; $i < count($books); $i++) {
            $book = $books[$i];

            $change_delete = $this->getButtonGroup(array(
                $this->getLink('Muuda', base_url("Muuda/Raamat/".$book['id'])),
                $this->getLink('Kustuta', base_url('Kustuta/Raamat/'.$book["id"]), 'btn-warning btn-xs')
            ));

            $book_authors = $this->database_model->get_authors($book['id']);
            $authors = '<ul>';
            foreach ($book_authors as $author) {
                $a = $this->database_model->get_author($author['author_id']);
                $authors.='<li>'.$a['firstname'].' '.$a['lastname'].'</li>';
            }
            $authors .= '</ul>';

            $book_genres = $this->database_model->get_genres($book['id']);
            $genres = '<ul>';
            foreach ($book_genres as $genre) {
                $a = $this->database_model->get_genre($genre['genre_id']);
                $genres.='<li>'.$a['name'].'</li>';
            }
            $genres .= '</ul>';
            array_push(
                $table_rows,
                array(
                    $book['title'],
                    $authors,
                    $book['lang'],
                    $book['year'],
                    $genres,
                    $change_delete
                )
            );
        }

        $heading = array("Raamatu pealkiri","Autorid", "Keel", "Aasta", "Žanrid", $this->getLink('Lisa raamat', base_url('Lisa/Raamat')));
        $data['table'] = $this->getTable($heading, $table_rows);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('view/view_table');
        $this->load->view('templates/footer');
    }

    public function view_keywords() {
        $data['title'] = 'Märksõnad';

        $table_rows = array();
        $schools = $this->database_model->get_keywords();
        for ($i = 0; $i < count($schools); $i++) {
            $school = $schools[$i];

            $change_delete = $this->getButtonGroup(array(
                $this->getLink('Muuda', base_url("Muuda/Märksõna/".$school['id'])),
                $this->getLink('Kustuta', base_url('Kustuta/Märksõna/'.$school["id"]), 'btn-warning btn-xs')
            ));
            array_push(
                $table_rows,
                array(
                    $school['name'],
                    $change_delete
                )
            );
        }

        $heading = array("Märksõna", $this->getLink('Lisa märksõna', base_url('Lisa/Märksõna')));
        $data['table'] = $this->getTable($heading, $table_rows);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('view/view_table');
        $this->load->view('templates/footer');
    }

    public function view_authors() {
        $data['title'] = 'Autorid';

        $table_rows = array();
        $authors = $this->database_model->get_authors();
        foreach ($authors as $author) {
            $change_delete = $this->getButtonGroup(array(
                $this->getLink('Muuda', base_url("Muuda/Autor/".$author['id'])),
                $this->getLink('Kustuta', base_url('Kustuta/Autor/'.$author["id"]), 'btn-warning btn-xs')
            ));

            array_push(
                $table_rows,
                array(
                    $author['firstname'],
                    $author['lastname'],
                    $change_delete
                )
            );
        }

        $heading = array("Eesnimi", "Perenimi", $this->getLink('Lisa autor', base_url('Lisa/Autor')));
        $data['table'] = $this->getTable($heading, $table_rows);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('view/view_table');
        $this->load->view('templates/footer');
    }

    public function view_genres() {
        $data['title'] = 'Žanrid';

        $table_rows = array();
        $genres = $this->database_model->get_genres();
        foreach ($genres as $genre) {
            $change_delete = $this->getButtonGroup(array(
                $this->getLink('Muuda', base_url("Muuda/Žanr/".$genre['id'])),
                $this->getLink('Kustuta', base_url('Kustuta/Žanr/'.$genre["id"]), 'btn-warning btn-xs')
            ));
            array_push(
                $table_rows,
                array(
                    $genre['name'],
                    $change_delete
                )
            );
        }

        $heading = array("Žanri nimi", $this->getLink('Lisa žanr', base_url('Lisa/Žanr')));
        $data['table'] = $this->getTable($heading, $table_rows);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('view/view_table');
        $this->load->view('templates/footer');
    }
}