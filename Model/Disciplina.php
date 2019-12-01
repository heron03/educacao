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
        'nome' => array(
            'notBlank' => array('rule' => 'notBlank', 'message' => 'Campo Obrigatório')
        )
    );
}
?>