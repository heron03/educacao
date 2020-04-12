<?php 
$form = $this->Form->create('Usuario');

$form .= $this->Html->div('container h-100',
    $this->Html->div('row h-100 justify-content-center align-items-center',
        $this->Html->div('col-10 col-md-8 col-lg-6',
            $this->Html->div('text-center',
            $this->Html->tag('h1', 'e-PNE'
            )) .
            $this->Html->div(
                'form-row align-items-center',
            $this->Form->input('Usuario.login', array(
                'required' => false,
                'div' => false,
                'class' => 'form-control margin-top-1', 
                'placeholder' => 'Login',
                'error' => array('attributes' => array('class' => 'invalid-feedback'))    
            )) .
            $this->Form->input('Usuario.senha', array(
                'required' => false,
                'type' => 'password',
                'div' => false,
                'placeholder' => 'Senha',
                'class' => 'form-control', 
                'error' => array('attributes' => array('class' => 'invalid-feedback'))    
            ))) .
            $this->Form->submit('Entrar', array('div' => false, 'class' => 'btn btn-primary btn-lg btn-block mt-3')) .
            $this->Html->Link('Criar Conta', '/usuarios/usuarioNivel')
)));
        
$form .= $this->Flash->render('danger'); 
$form .= $this->Flash->render('warning'); 
$form .= $this->Form->end();

echo $form;

$this->Js->buffer('$(".form-error").addClass("is-invalid");');

if ($this->request->is('ajax')) {
    echo $this->Js->writeBuffer();
}

