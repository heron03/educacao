<?php
$this->extend('/Elements/form_usuarios');

if ($this->request->params['action'] == 'add') {
    $this->assign('title', 'Novo Usuário');
}
if ($this->request->params['action'] == 'alterarsenha') {
   $this->assign('title', 'Alterar Senha do Usuário');
   $desabilitar = true;
}
if ($this->request->params['action'] == 'edit') {
    $this->assign('title', 'Editar Usuário');
    $desabilitar = true;
}
if ($this->request->params['action'] == 'view') {
    $this->assign('title', 'Usuário');
}

$formFields = $this->Form->create('Usuario');
$formFields .= $this->Form->hidden('Usuario.login');
$formFields .= $this->Form->hidden('Usuario.nome');
$formFields .= $this->Form->hidden('Usuario.cpf');
$formFields .= $this->Form->hidden('Usuario.email');

$formFields .= $this->element('formCreate');
$formFields .= $this->Html->div('form-row',
    $this->Form->input('Usuario.login', array(
        'type' => 'text',
        'label' => array('text' => 'Login'),
        'required' => false,
        'div' => array('class' => 'form-group col-md-3'),
        'class' => 'form-control uppercase',
        'error' => array('attributes' => array('class' => 'invalid-feedback')),
        'disabled' => $desabilitar
    )) 
);
$formFields .= $this->Html->div('form-row',
    $this->Form->input('Usuario.nome', array(
        'label' => array('text' => 'Nome Completo'),
        'required' => false,
        'div' => array('class' => 'form-group col-md-6'),
        'class' => 'form-control uppercase',
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) .
    $this->Form->input('Usuario.email', array(
        'type' => 'text',
        'required' => false,
        'label' => array('text' => 'E-mail'),
        'div' => array('class' => 'form-group col-md-6 offset-mr-6'),
        'class' => 'form-control uppercase',
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);


$this->assign('formFields', $formFields);