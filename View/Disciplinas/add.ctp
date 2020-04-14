<?php
$this->extend('/Common/form');
$this->assign('title', 'Cadastrar Disciplina');
$controllerName = $this->request->params['controller'];

$formFields = $this->element('formCreate');
$formFields .= $this->Form->hidden('Disciplina.id');
$formFields .= $this->Form->hidden('Disciplina.turma_id', array('value' => key($turmas)));
$formFields .= $this->Html->div('form-row my-2',  
    $this->Form->input('Disciplina.nome', array(
        'div' => array('class' => 'form-group col-md-6 offset-mr-6'),
        'class' => array('form-control'),
        'type' => 'text',
        'label' => array('text' => 'Nome'),
        'required' => false,
        'disabled' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) .
    $this->Form->input('Disciplina.turma_id', array(
        'label' => array('text' => 'Turma'),
        'required' => false,
        'type' => 'select',
        'disabled' => true,
        'options' => $turmas,
        'div' => array('class' => 'form-group col-md-4'),
        'class' => 'form-control',
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);

if (AuthComponent::user('aro_parent_id') == 2) {
    $formFields .= $this->Form->hidden('Disciplina.usuario_id', array('value' => AuthComponent::user('id')));
    $formFields .= $this->Html->div('form-row my-2',  
        $this->Form->input('Disciplina.usuario_id', array(
            'label' => array('text' => 'Professor'),
            'required' => false,
            'type' => 'select',
            'options' => $usuarios,
            'readonly' => true,
            'div' => array('class' => 'form-group col-md-4'),
            'class' => 'form-control',
            'error' => array('attributes' => array('class' => 'invalid-feedback'))
        ))
    );
} else {
    $formFields .= $this->Html->div('form-row my-2',  
        $this->Form->input('Disciplina.usuario_id', array(
            'label' => array('text' => 'Professor'),
            'required' => false,
            'type' => 'select',
            'options' => $usuarios,
            'div' => array('class' => 'form-group col-md-4'),
            'class' => 'form-control',
            'error' => array('attributes' => array('class' => 'invalid-feedback'))
        ))
    );
}

$this->assign('formFields', $formFields);