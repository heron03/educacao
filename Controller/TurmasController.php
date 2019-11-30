<?php
App::uses('AppController', 'Controller');

class TurmasController extends AppController {

    public $uses = array('Turma', 'Curso');
    public $paginate = array(
        'fields' => array(
            'Turma.id',
            'Turma.semestres',
            'Turma.curso_id'
        ),
        'order' => array('Turma.id' => 'desc'),
        'limit' => 10
    );  
    
    public function setPaginateConditions() {
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
            $fields = array('Turma.id', 'Turma.nome', 'Turma.semestres', 'Turma.ano');
            $conditions = array('Turma.id' => $id);
            $this->request->data = $this->Turma->find('first', compact('fields', 'conditions'));
        }
   }

    public function view($id = null) {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        $fields = array('Turma.id', 'Turma.nome');
        $conditions = array('Turma.id' => $id);
        $this->request->data = $this->Turma->find('first', compact('fields', 'conditions'));
    }

    public function delete($id) {
        $this->Curso->delete($id);
        $this->Flash->bootstrap('Turma excluída com sucesso!', array('key' => 'warning'));
        $this->redirect('/turmas');
    }

}
?>