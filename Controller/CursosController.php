<?php
App::uses('AppController', 'Controller');
class CursosController extends AppController {
    public $uses = array('Curso');
    public $paginate = array(
        'fields' => array(
            'Curso.id',
            'Curso.nome',
            'Curso.semestres',

        ),
        'order' => array('Curso.id' => 'desc'),
        'limit' => 10
    );  
    
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
        $fields = array('Curso.id', 'Curso.nome');
        $conditions = array('Curso.id' => $id);
        $this->request->data = $this->Curso->find('first', compact('fields', 'conditions'));
    }

    public function delete($id) {
        $this->Curso->delete($id);
        $this->Flash->bootstrap('Curso excluído com sucesso!', array('key' => 'warning'));
        $this->redirect('/cursos');
    }
}
?>