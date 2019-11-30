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
}
?>