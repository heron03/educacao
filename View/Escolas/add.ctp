<?php
$this->extend('/Common/form');
$controllerName = $this->request->params['controller'];

$this->assign('title', 'Cadastro de Escola');
$formFields = $this->element('formCreate');
$formFields .= $this->Form->hidden('Escola.id');
$formFields .= $this->Html->div('form-row',  
    $this->Form->input('Escola.nome', array(
        'div' => array('class' => 'form-group col-md-7 offset-mr-6'),
        'type' => 'text',
        'label' => array('text' => 'Nome da Instituição'),
        'required' => false,
        'disabled' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) 
);

echo $this->Html->script('pages');
$this->assign('formFields', $formFields);