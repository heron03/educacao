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
}
?>