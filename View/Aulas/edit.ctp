<?php
$this->extend('/Common/form');
$this->assign('title', 'Cadastrar Aula');
$controllerName = $this->request->params['controller'];

$formFields = $this->element('formCreate');
$formFields .= $this->Form->hidden('Aula.id');
$formFields .= $this->Html->div('form-row my-2',  
    $this->Form->input('Aula.nome', array(
        'div' => array('class' => 'form-group col-md-6'),
        'class' => array('form-control'),
        'type' => 'text',
        'label' => array('text' => 'Nome'),
        'required' => false,
        'readonly' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) . 
    $this->Form->input('Aula.data', array(
        'div' => array('class' => 'form-group col-md-2 offset-mr-4'),
        'class' => array('form-control'),
        'type' => 'text',
        'label' => array('text' => 'Data da Aula'),
        'required' => false,
        'readonly' => false,
        'data-inputmask' => "'mask':'99/99/9999', 'greedy': false",
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);
$formFields .= $this->Html->div('form-row',
    $this->Form->input('Aula.conteudo', array(
        'required' => false,
        'label' => array('text' => 'Conteudo'),
        'div' => array('class' => 'form-group col-md-12'),
        'class' => 'form-control uppercase',
        'type' => 'textarea',
        'rows' => 4,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);
$formFields .= $this->Html->div('form-row my-2',  
    
    $this->Form->input('Aula.disciplina_id', array(
        'div' => array('class' => 'form-group col-md-6'),
        'class' => array('form-control'),
        'type' => 'select',
        'label' => array('text' => 'Disciplina'),
        'required' => false,
        'disabled' => true,
        'readonly' => false,
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
        'readonly' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    )) . 
    $this->Form->input('Aula.imagem', array(
            'label' => array('text' => 'Anexe uma imagem', 'class' =>'input input-file', 'for' => 'file'),
            'div' => array('class' => 'col-md-6 my-3 button', 'text' => 'Anexar documento...'),
            'class' => 'form-control imagem-brasao form-control-sm',
            'type' => 'file',
            'required' => false,
            'readonly' => false,
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
        'readonly' => false,
        'error' => array('attributes' => array('class' => 'invalid-feedback'))
    ))
);


$this->assign('formFields', $formFields);