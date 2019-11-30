<?php
App::uses('AppController', 'Controller');
class ProvasController extends AppController {
    public $uses = array('Prova', 'Disciplina');
    public $paginate = array(
        'fields' => array(
            'Prova.id',
            'Prova.nome',
            'Prova.data',
            'Prova.hora',
            'Disciplina.nome'
        ),
        'order' => array('Prova.id' => 'desc'),
        'limit' => 10
    );  
    
    public function setPaginateConditions() {
        $nome = '';
        if ($this->request->is('post')) {
            $nome = $this->request->data['Prova']['nome'];
            $this->Session->write('Prova.nome', $nome);
        } else {
            $nome = $this->Session->read('Prova.nome');
            $this->request->data('Prova.nome', $nome);
        }
        if (!empty($nome)) {
            $this->paginate['conditions']['Prova.Nome LIKE'] = '%' . trim($nome) . '%';
        }
    }

    public function add() {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        if (!empty($this->request->data)) {
            $this->Prova->create();
            if ($this->Prova->save($this->request->data)) {
                $this->Flash->bootstrap('Prova cadastrada com sucesso!', array('key' => 'success'));
                $this->redirect('/provas');
            }
        }

        $fields = array('Disciplina.id', 'Disciplina.nome');
        $disciplinas = $this->Disciplina->find('list', compact('fields'));
        $this->set('disciplinas', $disciplinas);
    }

    public function edit($id = null) {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        if (!empty($this->request->data)) {
            if ($this->Prova->save($this->request->data)) {
                $this->Flash->bootstrap('Prova editada com sucesso!', array('key' => 'success'));
                $this->redirect('/provas');
            }
        } else {
            $fields = array('Prova.id', 'Prova.curso_id', 'Prova.semestres', 'Prova.ano');
            $conditions = array('Prova.id' => $id);
            $this->request->data = $this->Prova->find('first', compact('fields', 'conditions'));
        }
        
        $fields = array('Curso.nome');
        $cursos = $this->Curso->find('list', compact('fields'));
        $this->set('cursos', $cursos);
   }

    public function view($id = null) {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        $fields = array('Prova.id', 'Prova.curso_id', 'Prova.semestres', 'Prova.ano');
        $conditions = array('Prova.id' => $id);
        $this->request->data = $this->Prova->find('first', compact('fields', 'conditions'));

        $fields = array('Curso.nome');
        $cursos = $this->Curso->find('list', compact('fields'));
        $this->set('cursos', $cursos);
    }

    public function delete($id) {
        $this->Prova->delete($id);
        $this->Flash->bootstrap('Prova excluída com sucesso!', array('key' => 'warning'));
        $this->redirect('/provas');
    }

}
?>