<?php

App::uses('AppController', 'Controller');

class UsuariosController extends AppController {
    public $paginate = array(
        'fields' => array(
            'Usuario.id',
            'Usuario.login',
            'Usuario.nome',
            'Usuario.email',
            'Usuario.cpf',
            'Usuario.blocked',
            'Usuario.aro_parent_id'
        ),
        'order' => array('usuario.id' => 'desc'),
        'limit' => 10
    );
    
    public function setPaginateConditions() {
        $nomeOrcpf = '';
        if ($this->request->is('post')) {
            $nomeOrcpf = $this->request->data['Usuario']['nome_or_cpf'];
            $this->Session->write('Usuario.nome_or_cpf', $nomeOrcpf);
        } else {
            $nomeOrcpf = $this->Session->read('Usuario.nome_or_cpf');
            $this->request->data('Usuario.nome_or_cpf', $nomeOrcpf);
        }
        if (!empty($nomeOrcpf)) {
            $this->paginate['conditions']['Usuario.NomeCpf LIKE'] = '%' . trim($nomeOrcpf) . '%';
        }
    }

    public function add() {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        if (!empty($this->request->data)) {
            $this->Usuario->create();
            if ($this->Usuario->save($this->request->data)) {
                $this->Flash->bootstrap('Usuário incluído com sucesso!', array('key' => 'success'));
                $this->afterAdd();
                $this->redirect('/usuarios');
            }
        }
        $this->setAroList();
        $this->render('form');
    }

    public function edit($id = null) {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        if (!empty($this->request->data)) {
            if ($this->Usuario->saveAll($this->request->data)) {
                $this->Flash->bootstrap('Alterado com sucesso!', array('key' => 'success'));
                $this->afterEdit();
                $this->redirect('/usuarios');
            }
        } else {
            $conditions = array('Usuario.id' => $id);
            $contain = array();
            $this->request->data = $this->Usuario->find('first', compact('conditions', 'contain'));
        }
        $this->setAroList();
        $this->autoRender = false;
        $this->render('form');
    }

    public function view($id = null) {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        $conditions = array('Usuario.id' => $id);
        $contain = array();
        $this->request->data = $this->Usuario->find('first', compact('conditions', 'contain'));
        $this->setAroList();
        $this->autoRender = false;
        $this->render('form');
    }

    public function alterarsenha($id) {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        if (!empty($this->request->data)) {
            if ($this->Usuario->saveAll($this->request->data)) {
                $this->Flash->bootstrap('Alterado com sucesso!', array('key' => 'success'));
                $this->UserLog->save($this->Auth->user('id'));
                $this->redirect('/usuarios');
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

    public function bloquear($id = null) {
        $assinanteId = $this->Auth->user('Assinante.id');
        if ($this->Usuario->bloquear($assinanteId, $id)) {
            $this->Flash->bootstrap('Bloqueado com sucesso!', array('key' => 'success'));
        } else {
            $this->Flash->bootstrap('Não foi possível bloquear usuario', array('key' => 'success'));
        }
        
        $this->UserLog->save($this->Auth->user('id'));
        $this->redirect('/usuarios');
    }

    public function desbloquear($id = null) {
        $assinanteId = $this->Auth->user('Assinante.id');
        if ($this->Usuario->desbloquear($assinanteId, $id)) {
            $this->Flash->bootstrap('Desbloqueado com sucesso!', array('key' => 'success'));
        } else {
            $this->Flash->bootstrap('Não foi possível desbloqeuar o usuário', array('key' => 'success'));
        }

        $this->UserLog->save($this->Auth->user('id'));   
        $this->redirect('/usuarios');
    }

    public function criptografaSenha() {
        $this->autoRender = false;
        if (!empty($this->request->data)) {
            if ($this->Usuario->saveField($this->request->data)) {
                $this->Flash->bootstrap('Senha Alterada', array('key' => 'success'));
                $this->redirect('/usuarios');
            }
        } else {
            $fields = array('Usuario.usuario');
            $contain = array();
            $this->request->data = $this->Usuario->find('all', compact('fields', 'contain'));
            $this->redirect('/usuarios');
        }
    }

    public function login() {
        
    }

    public function loginRedirect() {
        $this->layout = false;
    }
    
    public function logout() {
        $this->UserLog->save($this->Auth->user('id'));
        $this->Session->destroy();
        $this->redirect($this->Auth->logout());
    }

    /* public function setAroList() {
        $aros = $this->Acl->Aro->find('list', ['conditions' => ['Aro.parent_id IS NULL'], 'fields' => ['Aro.id', 'Aro.alias']]);
        $this->set('aros', $aros);
    }
    */
}
?>