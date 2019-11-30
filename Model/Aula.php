<?php
App::uses('AppModel', 'Model');

class Aula extends AppModel {
    public $actsAs = array(
        'Containable'
    );
     
    public $belongsTo = array(
        'Disciplina'
    );
}
?>