<?php
$this->extend('/Common/form');
$this->assign('title', 'Cadastrar Turma');
$controllerName = $this->request->params['controller'];

$formFields = $this->element('formCreate');
$formFields .= $this->Form->hidden('Turma.id');
$formFields .= $this->Html->div('form-row my-2',  
    $this->Form->input('Turma.curso_id', array(
        'div' => array('class' => 'form-group col-md-6 offset-mr-6'),
        'class' => array('form-control'),
        'type' => 'select',
        'label' => array('text' => 'Nome'),
        'required' => false,
        'disabled' => false,
        'options' => $cursos,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) .
    $this->Form->input('Turma.semestres', array(
        'div' => array('class' => 'form-group col-md-2 offset-mr-4'),
        'class' => array('form-control'),
        'type' => 'text',
        'label' => array('text' => 'Semestre Atual'),
        'required' => false,
        'disabled' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback')),
    )) 
);

$this->assign('formFields', $formFields);