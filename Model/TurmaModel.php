<?php
App::uses('AppModel', 'Model');

class Campanha extends AppModel {
    public $actsAs = array(
        'Containable'
    );
     
    public $belongsTo = array(
        'Curso'
    );
}
?>