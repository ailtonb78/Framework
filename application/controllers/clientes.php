<?php

class Clientes extends Controller {

    private $model;

    public function __construct() {
        parent::__construct();
        $this->load->native_helper('URLHelper');
        $this->model = new Cliente();
    }

    public function index() {
        $this->data['titulo'] = 'Projeto  - Clientes';
        $dados['clientes'] = $this->model->buscarTodos();
        if (!empty($dados)) {
            $this->view('base/head');
            $this->view('clientes/index', $dados);
            $this->view('base/foot');
        } else {
            $this->view('base/head');
            $this->view('clientes/index');
            $this->view('base/foot');
        }
    }

    public function add($param1 = '') {
        $this->data['titulo'] = 'Projeto - Novo Cliente';
        if ($param1 != 'new') {
            $this->render('clientes/add');
        } else {
            $obj = $this->post_to_array(array('descricao', 'salario'));
            $this->model->inserir($obj);
            redirect('clientes');
        }
    }

    public function ler($param1 = '', $param2 = '') {
        $this->data['titulo'] = 'Projeto  - Visualizar Cliente';
        $dados['cliente'] = $this->model->buscarPorCod($param1, $param2);
        if (!empty($dados)) {
            $this->view('base/head');
            $this->view('clientes/view', $dados);
            $this->view('base/foot');
        }
    }

    public function editar($param1 = '', $param2 = '', $param3 = '') {
        $this->data['titulo'] = 'Projeto  - Editar Cliente';
        if ($param1 != 'read') {
            $obj = $this->post_to_array(array('descricao', 'salario'));
            $onde = array("0" => $param2, "1" => $param3);
            $this->model->atualizar($obj, $onde);
            redirect('clientes');
        } else {
            $dados['cargo'] = $this->model->buscarPorCod($param2, $param3);
            if (!empty($dados)) {
                $this->view('base/head');
                $this->view('clientes/edit', $dados);
                $this->view('base/foot');
            }
        }
    }

    public function excluir($param1 = '', $param2 = '') {
        if ($param1 == 'id') {
            $this->model->excluir($param2);
            redirect('clientes');
        }
    }

    public function pesquisar() {
        $this->data['titulo'] = 'Projeto  - Clientes';
        $obj = $this->post_to_array(array('valor'));
        $dados['clientes'] = $this->model->pesquisar($obj);
        $this->view('base/head');
        $this->view('clientes/index', $dados);
        $this->view('base/foot');
    }

}
