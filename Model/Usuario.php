<?php
App::uses('AppModel', 'Model');

class Usuario extends AppModel {
    public $actsAs = array('Containable');
    public $belongsTo = array('Disciplina');

}
?>