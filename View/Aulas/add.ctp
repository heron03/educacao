<?php
$this->extend('/Common/form');
$this->assign('title', 'Cadastrar Aula');
$controllerName = $this->request->params['controller'];

$formFields = $this->element('formCreate');
$formFields .= $this->Form->hidden('Aula.id');
$formFields .= $this->Html->div('form-row my-2',  
    $this->Form->input('Aula.nome', array(
        'div' => array('class' => 'form-group col-md-6 offset-mr-6'),
        'class' => array('form-control'),
        'type' => 'text',
        'label' => array('text' => 'Nome'),
        'required' => false,
        'disabled' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) 
);

$formFields .= $this->Form->button($this->Html->tag('i', '', array('class' => 'fas fa-microphone', 'id' => "speakbt")) .
    ' Gravar',
    array(
        'id' => "speakbt",
        'type' => 'button',
        'class' => 'btn btn-success mr-3 mt-4',
        'escape' => false,
    )
);
$formFields .= $this->Html->div('form-row my-2',  
    $this->Form->input('Aula.conteudo', array(
        'id' => "resultSpeak",
        'label' => array('text' => 'Conteudo'),
        'required' => false,
        'type' => 'select','type' => 'textarea',
        'rows' => 4,
        'div' => array('class' => 'form-group col-md-4'),
        'class' => 'form-control',
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);

$this->assign('formFields', $formFields);