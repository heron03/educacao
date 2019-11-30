<?php
$this->extend('/Common/form');
$this->assign('title', 'Cadastrar Turma');
$controllerName = $this->request->params['controller'];

$formFields = $this->element('formCreate');
$formFields .= $this->Form->hidden('Turma.id');
$formFields .= $this->Form->hidden('Turma.curso_id');
$formFields .= $this->Html->div('form-row my-2',  
    $this->Form->input('Turma.ano', array(
        'div' => array('class' => 'form-group col-md-2 offset-mr-4 offset-mr-6'),
        'class' => array('form-control'),
        'type' => 'numeric',
        'label' => array('text' => 'Ano Atual'),
        'required' => false,
        'disabled' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);
$formFields .= $this->Html->div('form-row my-2',  
    $this->Form->input('Turma.nome', array(
        'div' => array('class' => 'form-group col-md-6 offset-mr-6'),
        'class' => array('form-control'),
        'type' => 'text',
        'label' => array('text' => 'Nome'),
        'required' => false,
        'disabled' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) .
    $this->Form->input('Turma.semestre', array(
        'div' => array('class' => 'form-group col-md-2 offset-mr-4'),
        'class' => array('form-control'),
        'type' => 'numeric',
        'label' => array('text' => 'Semestre Atual'),
        'required' => false,
        'disabled' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) 
);

$this->assign('formFields', $formFields);