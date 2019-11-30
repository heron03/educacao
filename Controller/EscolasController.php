<?php
App::uses('AppController', 'Controller');

class EscolasController extends AppController {
 
    public $uses = array('Escola');
    public $paginate = array(
        'fields' => array(
            'Escola.id',
            'Escola.nome',

        ),
        'order' => array('Escola.id' => 'desc'),
        'limit' => 10
    );  
    
    public function setPaginateConditions() {
        $nome = '';
        if ($this->request->is('post')) {
            $nome = $this->request->data['Escola']['nome'];
            $this->Session->write('Escola.nome', $nome);
        } else {
            $nome = $this->Session->read('Escola.nome');
            $this->request->data('Escola.nome', $nome);
        }
        if (!empty($nome)) {
            $this->paginate['conditions']['Escola.Nome LIKE'] = '%' . trim($nome) . '%';
        }
    }

    public function add() {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        if (!empty($this->request->data)) {
            $this->Escola->create();
            if ($this->Escola->save($this->request->data)) {
                $this->Flash->bootstrap('Escola cadastrada com sucesso!', array('key' => 'success'));
                $this->redirect('/escolas');
            }
        }
    }
}
?>
