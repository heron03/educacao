<?php
$this->extend('/Common/form');
$this->assign('title', 'Cadastrar Curso');
$controllerName = $this->request->params['controller'];

$formFields = $this->element('formCreate');
$formFields .= $this->Form->hidden('Curso.id');
$formFields .= $this->Form->hidden('Curso.usuario_id', array('value' => AuthComponent::user('id')));
$formFields .= $this->Html->div('form-row my-2',  
    $this->Form->input('Curso.nome', array(
        'div' => array('class' => 'form-group col-md-6 offset-mr-6'),
        'class' => array('form-control'),
        'type' => 'text',
        'label' => array('text' => 'Nome do Curso'),
        'required' => false,
        'disabled' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) .
    $this->Form->input('Curso.semestres', array(
        'div' => array('class' => 'form-group col-md-2 offset-mr-4'),
        'class' => array('form-control'),
        'type' => 'numeric',
        'label' => array('text' => 'Total de Semestres'),
        'required' => false,
        'disabled' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) 
);

$this->assign('formFields', $formFields);