<?php
$actionName = $this->request->params['action'];
$form = $this->fetch('formFields');

if ($actionName != 'add') {
    $form .= $this->Form->hidden('Usuario.id');
}
if ($actionName == 'add' || $actionName == 'alterarsenha') {
    $form .= $this->Form->hidden('Usuario.confirma_senha');
    $form .= $this->Html->div(
        'form-row ',
        $this->Form->input('Usuario.senha', array(
            'type' => 'password',
            'label' => array('text' => 'Senha'),
            'required' => false,
            'div' => array('class' => 'form-group col-md-3'),
            'class' => 'form-control uppercase',
            'disabled' => false,
            'error' => array('attributes' => array('class' => 'invalid-feedback'))
        )) .
        $this->Form->input('Usuario.confirma_senha', array(
            'type' => 'password',
            'label' => array('text' => 'Confirmar Senha'),
            'required' => false,
            'disabled' => false,
            'div' => array('class' => 'form-group col-md-3 offset-md-3 offset--mr-3'),
            'class' => 'form-control uppercase',
            'error' => array('attributes' => array('class' => 'invalid-feedback'))
        ))
    );
}
if ($actionName != 'view') {
    $form .= $this->Form->button(
        $this->Html->tag('i', '', array(
            'class' => 'fas fa-check'
        )) .
        ' Gravar',
        array(
            'type' => 'submit',
            'class' => 'btn btn-success mr-3',
            'escape' => false,
            'update' => '#content'
        )
    );
}
$form.= $this->Js->link(
    $this->Html->tag('i', '', array(
        'class' => 'fas fa-undo'
    )) .
    ' Voltar',
    '/usuarios',
    array(
        'class' => 'btn btn-secondary',
        'escape' => false,
        'update' => '#content'
    )
);
$form .= $this->Form->end();

echo $this->Html->tag('h3', $this->fetch('title'));
echo $form;

$this->Js->buffer('$(".form-error").addClass("is-invalid")');
if ($this->request->is('ajax')) {
    echo $this->Js->writeBuffer();
}