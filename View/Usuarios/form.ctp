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
$formFields .= $this->Form->hidden('Usuario.orgao_id', array('value' => AuthComponent::user('orgao_id')));
$formFields .= $this->Form->hidden('Usuario.login');
$formFields .= $this->Form->hidden('Usuario.nome');
$formFields .= $this->Form->hidden('Usuario.cpf');
$formFields .= $this->Form->hidden('Usuario.email');
$formFields .= $this->Form->hidden('Usuario.assinante_id', array('value' => AuthComponent::user('Assinante.id')));
$formFields .= $this->element('formCreate');
$formFields .= $this->Html->div('form-row ',
    $this->Form->input('Usuario.login', array(
        'type' => 'text',
        'label' => array('text' => 'Login'),
        'required' => false,
        'div' => array('class' => 'form-group col-md-3'),
        'class' => 'form-control uppercase',
        'error' => array('attributes' => array('class' => 'invalid-feedback')),
        'disabled' => $desabilitar
    )) .
    $this->Form->input('Usuario.nome', array(
        'label' => array('text' => 'Nome Completo'),
        'required' => false,
        'div' => array('class' => 'form-group col-md-6 offset-md-3'),
        'class' => 'form-control uppercase',
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);
$formFields .= $this->Html->div(
    'form-row',
    $this->Form->input('Usuario.cpf', array(
        'label' => array('text' => 'CPF'),
        'required' => false,
        'div' => array('class' => 'form-group  col-md-3'),
        'class' => 'form-control',
        'error' => array('attributes' => array('class' => 'invalid-feedback')),
        'data-inputmask' => "'mask': '9', 'repeat': 11, 'greedy' : false"
    )) .
        $this->Form->input('Usuario.email', array(
            'type' => 'text',
            'required' => false,
            'label' => array('text' => 'E-mail'),
            'div' => array('class' => 'form-group col-md-6 offset-md-3'),
            'class' => 'form-control uppercase',
            'error' => array('attributes' => array('class' => 'invalid-feedback'))
        ))
);
$formFields .= $this->Html->div(
    'form-row ',
    $this->Form->input('Usuario.aro_parent_id', array(
        'type' => 'select',
        'div' => array('class' => 'form-group col-md-3 offset-mr-9'),
        'class' => 'form-control',
        'label' => array('text' => 'Nível de Usuario'),
        'options' => $aros,
        'disabled' => true
    ))
);
$formFields .= $this->Form->hidden('Usuario.aro_parent_id', array('value' => 1));


$this->assign('formFields', $formFields);