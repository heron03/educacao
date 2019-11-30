<?php
App::uses('AppController', 'Controller');
class DisciplinasController extends AppController {
    public $uses = array('Disciplina', 'Turma', 'Usuario', 'Curso');
    public $paginate = array(
        'fields' => array(
            'Disciplina.id',
            'Disciplina.nome',
            'Disciplina.turma_id',
            'Usuario.nome'
        ),
        'order' => array('Disciplina.id' => 'desc'),
        'limit' => 10
    );  
    
    public function setPaginateConditions() {
        $nome = '';
        if ($this->request->is('post')) {
            $nome = $this->request->data['Disciplina']['nome'];
            $this->Session->write('Disciplina.nome', $nome);
        } else {
            $nome = $this->Session->read('Disciplina.nome');
            $this->request->data('Disciplina.nome', $nome);
        }
        if (!empty($nome)) {
            $this->paginate['conditions']['Disciplina.Nome LIKE'] = '%' . trim($nome) . '%';
        }
    }

    public function add() {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        if (!empty($this->request->data)) {
            $this->Disciplina->create();
            if ($this->Disciplina->save($this->request->data)) {
                $this->Flash->bootstrap('Disciplina cadastrada com sucesso!', array('key' => 'success'));
                $this->redirect('/disciplinas');
            }
        }
        $turmas = $this->Turma->getTurma();
        $this->set('turmas', $turmas);

        $contain = array();
        $fields = array('Usuario.id', 'Usuario.nome');
        $usuarios = $this->Usuario->find('list', compact('fields', 'contain'));
        $this->set('usuarios', $usuarios);
    }

    public function edit($id = null) {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        if (!empty($this->request->data)) {
            if ($this->Disciplina->save($this->request->data)) {
                $this->Flash->bootstrap('Disciplina editada com sucesso!', array('key' => 'success'));
                $this->redirect('/disciplinas');
            }
        } else {
            $fields = array('Disciplina.id', 'Disciplina.nome');
            $conditions = array('Disciplina.id' => $id);
            $this->request->data = $this->Disciplina->find('first', compact('fields', 'conditions'));

            $turmas = $this->Turma->getTurma();
            $this->set('turmas', $turmas);
    
            $contain = array();
            $fields = array('Usuario.id', 'Usuario.nome');
            $usuarios = $this->Usuario->find('list', compact('fields', 'contain'));
            $this->set('usuarios', $usuarios);
        }
   }

    public function view($id = null) {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        $fields = array('Disciplina.id', 'Disciplina.nome');
        $conditions = array('Disciplina.id' => $id);
        $this->request->data = $this->Disciplina->find('first', compact('fields', 'conditions'));
        $turmas = $this->Turma->getTurma();
        $this->set('turmas', $turmas);

        $contain = array();
        $fields = array('Usuario.id', 'Usuario.nome');
        $usuarios = $this->Usuario->find('list', compact('fields', 'contain'));
        $this->set('usuarios', $usuarios);
    }

    public function delete($id) {
        $this->Disciplina->delete($id);
        $this->Flash->bootstrap('Disciplina excluída com sucesso!', array('key' => 'warning'));
        $this->redirect('/disciplinas');
    }
}
?>