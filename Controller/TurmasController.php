<?php
App::uses('AppController', 'Controller');

class TurmasController extends AppController {
    public $uses = array('Turma', 'Curso');
    
    public $paginate = array(
        'fields' => array(
            'Turma.id',
            'Turma.semestres',
            'Turma.curso_id',
            'Curso.nome'
        ),
        'order' => array('Turma.id' => 'desc'),
        'limit' => 10
    );  

    public function index($cursoId = null) {
        if ($cursoId != null) {
            $this->Session->write('Curso', $cursoId);
        }
        $this->setPaginateConditions($this->Session->read('Curso'));
        $this->set('turmas', $this->paginate());
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
    }
    
    public function setPaginateConditions($cursoId) {
        $nome = '';
        if ($this->request->is('post')) {
            $nome = $this->request->data['Turma']['nome'];
            $this->Session->write('Turma.nome', $nome);
        } else {
            $nome = $this->Session->read('Turma.nome');
            $this->request->data('Turma.nome', $nome);
        }
        if (!empty($nome)) {
            $this->paginate['conditions']['Turma.Nome LIKE'] = '%' . trim($nome) . '%';
        }
        $this->paginate['conditions']['Turma.curso_id'] = $cursoId;
    }

    public function add() {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        if (!empty($this->request->data)) {
            $this->Turma->create();
            if ($this->Turma->save($this->request->data)) {
                $this->Flash->bootstrap('Turma cadastrada com sucesso!', array('key' => 'success'));
                $this->redirect('/turmas');
            }
        }
        $cursoId = $this->Session->read('Curso');
        $fields = array('Curso.nome');
        $conditions = array('Curso.id' => $cursoId);
        $cursos = $this->Curso->find('list', compact('fields', 'conditions'));
        $this->set('cursos', $cursos);
    }

    public function edit($id = null) {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        if (!empty($this->request->data)) {
            if ($this->Turma->save($this->request->data)) {
                $this->Flash->bootstrap('Turma editada com sucesso!', array('key' => 'success'));
                $this->redirect('/turmas');
            }
        } else {
            $fields = array('Turma.id', 'Turma.curso_id', 'Turma.semestres');
            $conditions = array('Turma.id' => $id);
            $this->request->data = $this->Turma->find('first', compact('fields', 'conditions'));
        }
        
        $fields = array('Curso.nome');
        $cursos = $this->Curso->find('list', compact('fields'));
        $this->set('cursos', $cursos);
   }

    public function view($id = null) {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        
        $this->redirect('/disciplinas/index/' . $id);
    }

    public function delete($id) {
        $this->Turma->delete($id);
        $this->Flash->bootstrap('Turma excluída com sucesso!', array('key' => 'warning'));
        $this->redirect('/turmas');
    }

}
?>