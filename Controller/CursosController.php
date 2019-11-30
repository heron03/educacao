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
}
?>