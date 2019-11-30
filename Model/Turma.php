<?php
App::uses('AppModel', 'Model');

class Turma extends AppModel {
    public $actsAs = array(
        'Containable'
    );
     
    public $belongsTo = array(
        'Curso'
    );
}
?>