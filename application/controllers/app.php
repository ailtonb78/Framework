<?php

class App extends Controller {

    function __construct() {
        parent::__construct();
        $this->load->native_helper('URLHelper');
    }

    public function index() {
        $this->data['titulo'] = 'Projeto';
        $this->render('index');
    }

}
