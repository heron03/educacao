<?php
App::uses('AppController', 'Controller');
class AulasController extends AppController {
    public $uses = array('Aula', 'Curso');
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
    
    public function setPaginateConditions() {
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
    }

    public function buscarRegistro($nome) {
        $this->autoRender = false;
        $conditions = array('Aula.nome' => $nome);
        $fields = array('Aula.id');
        $aula = $this->Aula->find('first', compact('fields', 'conditions'));
        $aula = json_encode($aula);
        
        return $aula;
   }
}
?>