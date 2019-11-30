<?php
$this->extend('/Common/form');
$this->assign('title', 'Editar Escola');
$controllerName = $this->request->params['controller'];


$formFields = $this->element('formCreate');
$formFields .= $this->Form->hidden('Escola.id');
$formFields .= $this->Html->div('form-row my-2',  
    $this->Form->input('Escola.nome', array(
        'div' => array('class' => 'form-group col-md-6 offset-mr-6'),
        'class' => array('form-control'),
        'type' => 'text',
        'label' => array('text' => 'Nome da Instituição'),
        'required' => false,
        'disabled' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) 
);

$this->assign('formFields', $formFields);