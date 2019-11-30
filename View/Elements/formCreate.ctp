<?php
$inputDefaults = array(
    'class' => 'form-control',
    'required' => false,
    'div' => array('class' => 'form-group'),
    'error' => array('attributes' => array('class' => 'invalid-feedback')),
    'type' => 'text'
);
if ($this->request->params['action'] == 'view') {
    $inputDefaults['readonly'] = true;
    $inputDefaults['disabled'] = true;
    $botaoAlterarImagem['disabled'] = true;
}
if ($this->request->params['action'] == 'alterarsenha') {
    $inputDefaults['disabled'] = true;
}
$formCreate = $this->Form->create(false, array(
    'inputDefaults' => $inputDefaults,
    'enctype' => 'multipart/form-data'
));
echo $formCreate;