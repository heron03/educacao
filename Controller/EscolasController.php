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

    public function edit($id = null) {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        if (!empty($this->request->data)) {
            if ($this->Escola->save($this->request->data)) {
                $this->Flash->bootstrap('Escola editada com sucesso!', array('key' => 'success'));
                $this->redirect('/escolas');
            }
        } else {
            $fields = array('Escola.id', 'Escola.nome');
            $conditions = array('Escola.id' => $id);
            $this->request->data = $this->Escola->find('first', compact('fields', 'conditions'));
        }
   }

    public function view($id = null) {
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
        $fields = array('Escola.id', 'Escola.nome');
        $conditions = array('Escola.id' => $id);
        $this->request->data = $this->Escola->find('first', compact('fields', 'conditions'));
    }

    public function delete($id) {
        $this->Escola->delete($id);
        $this->Flash->bootstrap('Escola excluída com sucesso!', array('key' => 'warning'));
        $this->redirect('/escolas');
    }

}
?>
