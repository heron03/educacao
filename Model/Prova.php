<?php
App::uses('AppModel', 'Model');

class Prova extends AppModel {
    public $actsAs = array(
        'Containable'
    );
     
    public $belongsTo = array(
        'Disciplina'
    );
}
?>