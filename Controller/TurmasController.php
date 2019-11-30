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
}
?>