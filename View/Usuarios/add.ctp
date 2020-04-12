<?php
$form = $this->Form->create('Usuario');
$form .= $this->Form->hidden('Usuario.aro_parent_id', array('value' => $this->request->data['Usuario']['aro_parent_id']));
if ($this->request->data['Usuario']['aro_parent_id'] == 3) {
    $form .= $this->Html->div('container h-100',
        $this->Html->div('row h-100 justify-content-center align-items-center',
            $this->Html->div('col-10 col-md-8 col-lg-6',
                $this->Html->div('text-center',
                    $this->Html->tag('h3', 'Cadastro de Usuário') .
                    $this->Html->div('form align-items-center',
                        $this->Form->input('Usuario.login', array(
                            'type' => 'text',
                            'label' => array('text' => 'Login', 'class' => 'float-left'),
                            'required' => true,
                            'div' => array('class' => 'form-group col-md-12'),
                            'class' => 'form-control uppercase',
                            'error' => array('attributes' => array('class' => 'invalid-feedback')),
                        )) .
                        $this->Form->input('Usuario.nome', array(
                            'type' => 'text',
                            'label' => array('text' => 'Nome', 'class' => 'float-left'),
                            'required' => true,
                            'div' => array('class' => 'form-group col-md-12'),
                            'class' => 'form-control uppercase',
                            'error' => array('attributes' => array('class' => 'invalid-feedback')),
                        )) .
                        $this->Form->input('Usuario.email', array(
                            'type' => 'email',
                            'label' => array('text' => 'E-mail', 'class' => 'float-left'),
                            'required' => true,
                            'div' => array('class' => 'form-group col-md-12'),
                            'class' => 'form-control uppercase',
                            'error' => array('attributes' => array('class' => 'invalid-feedback')),
                        )) .
                        $this->Form->input('Usuario.cnpj', array(
                            'type' => 'text',
                            'label' => array('text' => 'CNPJ', 'class' => 'float-left'),
                            'required' => true,
                            'div' => array('class' => 'form-group col-md-12'),
                            'class' => 'form-control uppercase',
                            'error' => array('attributes' => array('class' => 'invalid-feedback')),
                        )) .
                        $this->Form->input('Usuario.senha', array(
                            'type' => 'password',
                            'label' => array('text' => 'Senha', 'class' => 'float-left'),
                            'required' => true,
                            'div' => array('class' => 'form-group col-md-12'),
                            'class' => 'form-control uppercase',
                            'error' => array('attributes' => array('class' => 'invalid-feedback')),
                        )) .
                        $this->Form->input('Usuario.confirma_senha', array(
                            'type' => 'password',
                            'label' => array('text' => 'Confirmar Senha', 'class' => 'float-left'),
                            'required' => true,
                            'div' => array('class' => 'form-group col-md-12'),
                            'class' => 'form-control uppercase',
                            'error' => array('attributes' => array('class' => 'invalid-feedback')),
                        ))
                    ) .
                    $this->Form->button(
                        'Gravar',
                        array(
                            'type' => 'submit',
                            'class' => 'btn btn-success mr-3',
                            'escape' => false,
                            'update' => '#content'
                        )
                    )
                ) 
            )
        )
    );
} else {
    $form .= $this->Html->div('container h-100',
        $this->Html->div('row h-100 justify-content-center align-items-center',
            $this->Html->div('col-10 col-md-8 col-lg-6',
                $this->Html->div('text-center',
                $this->Html->tag('h3', 'Cadastro de Usuário') .
                    $this->Html->div('form align-items-center',
                        $this->Form->input('Usuario.login', array(
                            'type' => 'text',
                            'label' => array('text' => 'Login', 'class' => 'float-left'),
                            'required' => true,
                            'div' => array('class' => 'form-group col-md-12'),
                            'class' => 'form-control uppercase',
                            'error' => array('attributes' => array('class' => 'invalid-feedback')),
                        )) .
                        $this->Form->input('Usuario.nome', array(
                            'type' => 'text',
                            'label' => array('text' => 'Nome', 'class' => 'float-left'),
                            'required' => true,
                            'div' => array('class' => 'form-group col-md-12'),
                            'class' => 'form-control uppercase',
                            'error' => array('attributes' => array('class' => 'invalid-feedback')),
                        )) .
                        $this->Form->input('Usuario.email', array(
                            'type' => 'email',
                            'label' => array('text' => 'E-mail', 'class' => 'float-left'),
                            'required' => true,
                            'div' => array('class' => 'form-group col-md-12'),
                            'class' => 'form-control uppercase',
                            'error' => array('attributes' => array('class' => 'invalid-feedback')),
                        )) .
                        $this->Form->input('Usuario.senha', array(
                            'type' => 'password',
                            'label' => array('text' => 'Senha', 'class' => 'float-left'),
                            'required' => true,
                            'div' => array('class' => 'form-group col-md-12'),
                            'class' => 'form-control uppercase',
                            'error' => array('attributes' => array('class' => 'invalid-feedback')),
                        )) .
                        $this->Form->input('Usuario.confirmar_senha', array(
                            'type' => 'password',
                            'label' => array('text' => 'Confirmar Senha', 'class' => 'float-left'),
                            'required' => true,
                            'div' => array('class' => 'form-group col-md-12'),
                            'class' => 'form-control uppercase',
                            'error' => array('attributes' => array('class' => 'invalid-feedback')),
                        ))
                    ) .
                    $this->Form->button(
                        'Gravar',
                        array(
                            'type' => 'submit',
                            'class' => 'btn btn-success mr-3',
                            'escape' => false,
                            'update' => '#content'
                        )
                    )
                ) 
            )
        )
    );
}
echo $form;
$this->Js->buffer('$(".form-error").addClass("is-invalid")');
if ($this->request->is('ajax')) {
    echo $this->Js->writeBuffer();
}