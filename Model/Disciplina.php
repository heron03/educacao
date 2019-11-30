<?php
App::uses('AppModel', 'Model');

class Disciplina extends AppModel {
    public $actsAs = array(
        'Containable'
    );
     
    public $belongsTo = array(
        'Usuario'
    );
}
?>