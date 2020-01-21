<?php
$this->extend('/Common/form');
$this->assign('title', 'Visualizar Aula');
$controllerName = $this->request->params['controller'];

$formFields = $this->element('formCreate');
$formFields .= $this->Form->hidden('Aula.id');
$formFields .= $this->Html->div('form-row my-2',  
    $this->Form->input('Aula.nome', array(
        'div' => array('class' => 'form-group col-md-6'),
        'class' => array('form-control'),
        'type' => 'text',
        'label' => array('text' => 'Nome'),
        'required' => true,
        'readonly' => true,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) . 
    $this->Form->input('Aula.disciplina_id', array(
        'div' => array('class' => 'form-group col-md-6'),
        'class' => array('form-control'),
        'type' => 'select',
        'label' => array('text' => 'Disciplina'),
        'required' => true,
        'readonly' => true,
        'options' => $disciplinas,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);
$formFields .= $this->Html->div('form-row',
    $this->Form->input('Aula.conteudo', array(
        'required' => false,
        'label' => array('text' => 'Conteudo'),
        'div' => array('class' => 'form-group col-md-12'),
        'class' => 'form-control uppercase',
        'type' => 'txt',
        'rows' => 4,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);

$this->assign('formFields', $formFields);