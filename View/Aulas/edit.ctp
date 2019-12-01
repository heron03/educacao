<?php
$this->extend('/Common/form');
$this->assign('title', 'Editar Aula');
$controllerName = $this->request->params['controller'];

$formFields = $this->element('formCreate');
$formFields .= $this->Form->hidden('Aula.id');
$formFields .= $this->Html->div('form-row my-2',  
    $this->Form->input('Aula.data', array(
        'div' => array('class' => 'form-group col-md-2 offset-mr-10'),
        'class' => array('form-control'),
        'type' => 'text',
        'label' => array('text' => 'Data'),
        'required' => false,
        'disabled' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);
$formFields .= $this->Html->div('form-row my-2',  
    $this->Form->input('Aula.nome', array(
        'div' => array('class' => 'form-group col-md-6'),
        'class' => array('form-control'),
        'type' => 'text',
        'label' => array('text' => 'Nome'),
        'required' => false,
        'disabled' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) . 
    $this->Form->input('Aula.disciplina_id', array(
        'div' => array('class' => 'form-group col-md-6'),
        'class' => array('form-control'),
        'type' => 'select',
        'label' => array('text' => 'Disciplina'),
        'required' => false,
        'disabled' => false,
        'options' => $disciplinas,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);
$formFields .= $this->Html->div('form-row my-2',  
    $this->Form->input('Aula.pdf', array(
        'label' => array('text' => 'Anexe um arquivo PDF', 'class' =>'input input-file', 'for' => 'file'),
        'div' => array('class' => 'col-md-6 my-3 button', 'text' => 'Anexar documento...'),
        'class' => 'form-control imagem-brasao form-control-sm',
        'type' => 'file',
        'required' => false,
        'disabled' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) . 
    $this->Form->input('Aula.imagem', array(
            'label' => array('text' => 'Anexe uma imagem', 'class' =>'input input-file', 'for' => 'file'),
            'div' => array('class' => 'col-md-6 my-3 button', 'text' => 'Anexar documento...'),
            'class' => 'form-control imagem-brasao form-control-sm',
            'type' => 'file',
            'required' => false,
            'disabled' => false,
            'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) 
);
$formFields .= $this->Html->div('form-row my-2',
    $this->Form->input('Aula.link', array(
        'label' => array('text' => 'Link de Vídeo'),
        'div' => array('class' => 'form-group col-md-6'),
        'class' => array('form-control'),
        'type' => 'text',
        'required' => false,
        'disabled' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);

$this->assign('formFields', $formFields);