<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class UsuariosController extends AppController {
    public $paginate = array(
        'fields' => array('Usuario.id', 'Usuario.nome'),
        'conditions' => array(),
        'limit' => 10,
        'order' => array('Usuario.nome' => 'asc')    
    );

    public function beforeFilter() {
        $this->Auth->allow(array('logout','login', 'add', 'usuarioNivel'));       
        
        $this->Auth->mapActions(['read' => ['alterarsenha', 'bloquear', 'desbloquear', 'loginRedirect']]);
    }              

    public function setPaginateConditions() {
        $nome = '';
        if ($this->request->is('post')) {
            $nome = $this->request->data['Usuario']['nome'];
            $this->Session->write('Usuario.nome', $nome);
        } else {
            $nome = $this->Session->read('Usuario.nome');
            $this->request->data('Usuario.nome', $nome);
        }
        if (!empty($nome)) {
            $this->paginate['conditions']['Usuario.nome LIKE'] = '%' . trim($nome) . '%';
        }
    }

    public function usuarioNivel(){
        $this->layout = 'login';
        $this->setAroList();
        if (!empty($this->request->data)) {
            $this->redirect('add/' . $this->request->data['Usuario']['aro_parent_id']);
        }
    }

    public function add($parentId = null) {
        $this->layout = 'login';
        if (!empty($this->request->data)) {
            if ($this->Usuario->save($this->request->data)) {
                $this->Flash->bootstrap('Gravado com sucesso!', array('key' => 'success'));
                $this->redirect('/login');
            }
        } else {
            $this->request->data['Usuario']['aro_parent_id'] = $parentId;
        }
    }   
    
    public function alterarsenha($id) {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        if (!empty($this->request->data)) {
            if ($this->Usuario->saveAll($this->request->data)) {
                $this->Flash->bootstrap('Alterado com sucesso!', array('key' => 'success'));
                $this->redirect('/');
            }
        } else {
            $conditions = array('Usuario.id' => $id);
            $contain = array();
            $this->request->data = $this->Usuario->find('first', compact('conditions', 'contain'));
            $this->request->data['Usuario']['senha'] = '';
        }
        $this->setAroList();
        $this->autoRender = false;
        $this->render('form');
    }

    public function edit($id = null) {
        parent::edit($id);
        $this->setAroList();
        $this->autoRender = false;
        $this->render('form');
    }

    public function getEditData($id) {        
        $fields = array('Usuario.id', 'Usuario.nome', 'Usuario.login', 'Usuario.email');
        $conditions = array('Usuario.id' => $id);
        
        return $this->Usuario->find('first', compact('fields', 'conditions'));
    }

    public function view($id = null) {
        parent::view($id);
        $this->setAroList();
    }

    public function login() {
        $this->layout = 'login';
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->bootstrap('Usuário ou senha incorretos', array('key' => 'danger'));
        }        
    }

    public function logout() {
        $this->Auth->logout();
        $this->redirect('/login');
    }

    public function setAroList() {
        $aros = $this->Acl->Aro->find('list', [
            'conditions' => ['Aro.parent_id IS NULL'], 
            'fields' => ['Aro.id', 'Aro.alias']
        ]);
        $this->set('aros', $aros);
    }

}
?>