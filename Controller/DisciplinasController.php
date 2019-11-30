<?php
App::uses('AppController', 'Controller');
class DisciplinasController extends AppController {
    public $uses = array('Disciplina', 'Curso');
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
}
?>