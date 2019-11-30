<?php
App::uses('AppModel', 'Model');

class Turma extends AppModel {
    public $actsAs = array(
        'Containable'
    );
     
    public $hasMany = array(
        'Curso'
    );

    public $validate = array(
        'nome' => array(
            'notBlank' => array('rule' => 'notBlank', 'message' => 'Informe o nome'),
            'minLength' => array('rule' => array('minLength', 3), 'message' => 'O nome deve conter no mínimo 3 dígitos')
        ),
        'ano' => array(
            'notBlank' => array('rule' => 'notBlank', 'message' => 'Informe o ano'),
            'date' => array('rule' => array('date', 'Y'), 'message' => 'Insira um ano válido'),
        ),
        'semestre' => array(
            'notBlank' => array('rule' => 'notBlank', 'message' => 'Informe o semestre que está cursado'),
            'alphanumeric' => array('rule' => 'numeric'),
            'range' => array('rule' => array('range', 1, 10), 'message' => 'O semestre informado deve estar entre 1 e 10')
        )
    );

}