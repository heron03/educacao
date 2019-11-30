<?php
App::uses('AppController', 'Controller');
class ProvasController extends AppController {
    public $uses = array('Prova', 'Disciplina');
    public $paginate = array(
        'fields' => array(
            'Prova.id',
            'Prova.nome',
            'Prova.data',
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
}
?>