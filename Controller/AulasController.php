<?php
App::uses('AppController', 'Controller');
class AulasController extends AppController {
    public $uses = array('Aula', 'Disciplina');
    public $paginate = array(
        'fields' => array(
            'Aula.id',
            'Aula.nome',
            'Aula.data',
            'Disciplina.nome'
        ),
        'order' => array('Aula.id' => 'desc'),
        'limit' => 10
    );  
    
    public function setPaginateConditions($disciplinaId) {
        $nome = '';
        if ($this->request->is('post')) {
            $nome = $this->request->data['Aula']['nome'];
            $this->Session->write('Aula.nome', $nome);
        } else {
            $nome = $this->Session->read('Aula.nome');
            $this->request->data('Aula.nome', $nome);
        }
        if (!empty($nome)) {
            $this->paginate['conditions']['Aula.Nome LIKE'] = '%' . trim($nome) . '%';
        }
        $this->paginate['conditions']['Aula.disciplina_id'] = $disciplinaId;
    }

    public function index($disciplinaId = null) {
        if ($disciplinaId != null) {
            $this->Session->write('Disciplina', $disciplinaId);
        }
        $this->setPaginateConditions($this->Session->read('Disciplina'));
        $this->set('aulas', $this->paginate());
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
    }

    public function buscarRegistro($nome) {
        $this->autoRender = false;
        $conditions = array('Aula.nome' => $nome);
        $fields = array('Aula.id');
        $aula = $this->Aula->find('first', compact('fields', 'conditions'));
        $aula = json_encode($aula);
        
        return $aula;
   }

   public function add() {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        if (!empty($this->request->data)) {
            $this->Aula->create();
            if ($this->Aula->save($this->request->data)) {
                $this->Flash->bootstrap('Aula cadastrada com sucesso!', array('key' => 'success'));
                $this->redirect('/aulas');
            }
        }
        $disciplinaId = $this->Session->read('Disciplina');
        $conditions = array('Disciplina.id' => $disciplinaId);
        $fields = array('Disciplina.nome');
        $disciplinas = $this->Disciplina->find('list', compact('fields', 'conditions'));
        $this->set('disciplinas', $disciplinas);
    }

    public function edit($id = null) {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        if (!empty($aula['Aula']['data'])) {
            $aula['Aula']['data'] = date('d/m/Y', strtotime($aula['Aula']['data']));
        }
        if (!empty($this->request->data)) {
            if ($this->Aula->save($this->request->data)) {
                $this->Flash->bootstrap('Aula editada com sucesso!', array('key' => 'success'));
                $this->redirect('/aulas');
            }
        } else {
            $fields = array('Aula.id', 'Aula.nome', 'Aula.disciplina_id', 'Aula.data');
            $conditions = array('Aula.id' => $id);
            $this->request->data = $this->Aula->find('first', compact('fields', 'conditions'));
            if (!empty($this->request->data['Aula']['data'])) {
                $this->request->data['Aula']['data'] = $this->Aula->userDate($this->request->data['Aula']['data']);
            }
        }
        
        $fields = array('Disciplina.nome');
        $disciplinas = $this->Disciplina->find('list', compact('fields'));
        $this->set('disciplinas', $disciplinas);
    }

    public function view($id = null) {
    if ($this->request->is('ajax')) {
        $this->layout = false;
        }
        $conditions = array('Aula.id' => $id);
        $this->request->data = $this->Aula->find('first', compact('conditions'));
        if (!empty($this->request->data['Aula']['data'])) {
            $this->request->data['Aula']['data'] = $this->Aula->userDate($this->request->data['Aula']['data']);
        }

        $fields = array('Disciplina.nome');
        $disciplinas = $this->Disciplina->find('list', compact('fields'));
        $this->set('disciplinas', $disciplinas);
    }

    public function delete($id) {
        $this->Aula->delete($id);
        $this->Flash->bootstrap('Aula excluída com sucesso!', array('key' => 'warning'));
        $this->redirect('/aulas');
    }

}
?>