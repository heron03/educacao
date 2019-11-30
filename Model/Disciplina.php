<?php
App::uses('AppModel', 'Model');

class Disciplina extends AppModel {
    public $actsAs = array(
        'Containable'
    );
     
    public $belongsTo = array(
        'Usuario',
        'Turma'
    );

    public $validate = array(
        'data' => array(
            'notBlank' => array('rule' => 'notBlank', 'message' => 'Campo Obrigatório'),
            'dataAtual' => array('rule' => 'vencimentoIgualDataAtual', 'message' => 'Não pode ser igual a data atual'),
        ),
        'nome' => array(
            'notBlank' => array('rule' => 'notBlank', 'message' => 'Campo Obrigatório')
        )
    );
}
?>