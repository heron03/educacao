<?php
App::uses('AppController', 'Controller');
class CursosController extends AppController {
    
    public $uses = array('Curso', 'Turma', 'Disciplina');
    
    public $paginate = array(
        'fields' => array(
            'Curso.id',
            'Curso.nome',
            'Curso.semestres',
            'Curso.usuario_id'
        ),
        'order' => array('Curso.id' => 'desc'),
        'limit' => 10
    );  
    
    public function beforeFilter() {
        $this->Auth->mapActions(['read']);
    }

    public function setPaginateConditions() {
        $nome = '';
        if ($this->request->is('post')) {
            $nome = $this->request->data['Curso']['nome'];
            $this->Session->write('Curso.nome', $nome);
        } else {
            $nome = $this->Session->read('Curso.nome');
            $this->request->data('Curso.nome', $nome);
        }
        if (!empty($nome)) {
            $this->paginate['conditions']['Curso.Nome LIKE'] = '%' . trim($nome) . '%';
        }
        if ($this->Auth->User('aro_parent_id') == 3) {
            $this->paginate['conditions']['Curso.usuario_id'] = $this->Auth->User('id');
        }
    }

    public function index() {
        $this->setPaginateConditions();
        $cursos = $this->paginate();
        if ($this->Auth->User('aro_parent_id') == 2) {
            $cursos = array();
            foreach($this->paginate() as $curso) {
                if ($curso['Curso']['usuario_id'] == $this->Auth->User('id')) {
                    array_push($cursos, $curso);
                } 
            }
            $contain = array('Turma' => array('fields' => 'curso_id'));
            $conditions = array('Disciplina.usuario_id' => $this->Auth->User('id'));
            $fields = array('Turma.curso_id', 'Turma.curso_id');
            $turmas = $this->Disciplina->find('list', compact('fields', 'conditions', 'contain'));
            foreach ($turmas as $turma) {
                $conditions = array('Curso.id' => $turma);
                $curso = $this->Curso->find('first', compact('conditions'));
                if ($curso['Curso']['usuario_id'] != $this->Auth->User('id')) {
                    array_push($cursos, $curso);
                }
                
            }
        }
        $this->set('cursos', $cursos);
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
    }

    public function add() {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        if (!empty($this->request->data)) {
            $this->Curso->create();
            if ($this->Curso->save($this->request->data)) {
                $this->Flash->bootstrap('Curso cadastrado com sucesso!', array('key' => 'success'));
                $this->redirect('/cursos');
            }
        }
    }

    public function edit($id = null) {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        if (!empty($this->request->data)) {
            if ($this->Curso->save($this->request->data)) {
                $this->Flash->bootstrap('Curso editado com sucesso!', array('key' => 'success'));
                $this->redirect('/cursos');
            }
        } else {
            $fields = array('Curso.id', 'Curso.nome', 'Curso.semestres');
            $conditions = array('Curso.id' => $id);
            $this->request->data = $this->Curso->find('first', compact('fields', 'conditions'));
        }
   }

    public function view($id = null) {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        $this->redirect('/turmas/index/' . $id);
    }

    public function delete($id) {
        $this->Curso->delete($id);
        $this->Flash->bootstrap('Curso excluído com sucesso!', array('key' => 'warning'));
        $this->redirect('/cursos');
    }
}
?>