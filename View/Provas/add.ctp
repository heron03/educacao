<?php
$this->extend('/Common/form');
$this->assign('title', 'Cadastrar Prova');
$controllerName = $this->request->params['controller'];

$formFields = $this->element('formCreate');
$formFields .= $this->Form->hidden('Prova.id');
$formFields .= $this->Html->div('form-row my-2',  
    $this->Form->input('Prova.nome', array(
        'div' => array('class' => 'form-group col-md-6 offset-mr-6'),
        'class' => array('form-control'),
        'type' => 'text',
        'label' => array('text' => 'Nome do Prova'),
        'required' => false,
        'disabled' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) .
    $this->Form->input('Prova.disciplina_id', array(
        'label' => array('text' => 'Disciplina'),
        'required' => false,
        'type' => 'select',
        'options' => $disciplinas,
        'div' => array('class' => 'form-group col-md-4'),
        'class' => 'form-control',
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) 
);
$formFields .= $this->Html->div('form-row my-2',  
    $this->Form->input('Prova.data', array(
        'div' => array('class' => 'form-group col-md-2'),
        'class' => array('form-control'),
        'type' => 'text',
        'label' => array('text' => 'Data da Prova'),
        'required' => false,
        'disabled' => false,
        'data-inputmask' => "'mask': '99/99/9999', 'greedy' : false",
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) .
    $this->Form->input('Prova.hora', array(
        'label' => array('text' => 'Horario da Prova'),
        'required' => false,
        'div' => array('class' => 'form-group col-md-2 offset-mr-4 offset-md-4'),
        'class' => 'form-control',
        'data-inputmask' => "'mask': '99:99', 'greedy' : false",
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) 
);

$formFields .= $this->Html->tag('hr');

$formFields .= $this->Html->div('form-row', $this->Html->tag('h4', 'Exercício 1', array('class' => 'mt-4 col-md-11')));

$formFields .= $this->Html->div('form-row',
    $this->Form->input('Prova.enunciado1', array(
        'required' => false,
        'label' => array('text' => 'Enunciado'),
        'div' => array('class' => 'form-group col-md-12'),
        'class' => 'form-control uppercase',
        'type' => 'textarea',
        'rows' => 4,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);

$formFields .= $this->Html->div('form-row', $this->Html->tag('h4', 'Exercício 1', array('class' => 'mt-4 col-md-11')));

$formFields .= $this->Html->div('form-row',
    $this->Form->input('Prova.enunciado1', array(
        'required' => false,
        'label' => array('text' => 'Enunciado'),
        'div' => array('class' => 'form-group col-md-12'),
        'class' => 'form-control uppercase',
        'type' => 'textarea',
        'rows' => 4,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);
$formFields .= $this->Html->div('form-row', $this->Html->tag('h4', 'Exercício 2', array('class' => 'mt-4 col-md-11')));

$formFields .= $this->Html->div('form-row',
    $this->Form->input('Prova.enunciado2', array(
        'required' => false,
        'label' => array('text' => 'Enunciado'),
        'div' => array('class' => 'form-group col-md-12'),
        'class' => 'form-control uppercase',
        'type' => 'textarea',
        'rows' => 4,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);
$formFields .= $this->Html->div('form-row', $this->Html->tag('h4', 'Exercício 3', array('class' => 'mt-4 col-md-11')));

$formFields .= $this->Html->div('form-row',
    $this->Form->input('Prova.enunciado3', array(
        'required' => false,
        'label' => array('text' => 'Enunciado'),
        'div' => array('class' => 'form-group col-md-12'),
        'class' => 'form-control uppercase',
        'type' => 'textarea',
        'rows' => 4,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);
$formFields .= $this->Html->div('form-row', $this->Html->tag('h4', 'Exercício 4', array('class' => 'mt-4 col-md-11')));

$formFields .= $this->Html->div('form-row',
    $this->Form->input('Prova.enunciado4', array(
        'required' => false,
        'label' => array('text' => 'Enunciado'),
        'div' => array('class' => 'form-group col-md-12'),
        'class' => 'form-control uppercase',
        'type' => 'textarea',
        'rows' => 4,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);
$formFields .= $this->Html->div('form-row', $this->Html->tag('h4', 'Exercício 5', array('class' => 'mt-4 col-md-11')));

$formFields .= $this->Html->div('form-row',
    $this->Form->input('Prova.enunciado5', array(
        'required' => false,
        'label' => array('text' => 'Enunciado'),
        'div' => array('class' => 'form-group col-md-12'),
        'class' => 'form-control uppercase',
        'type' => 'textarea',
        'rows' => 4,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);


$this->assign('formFields', $formFields);