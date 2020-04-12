<?php
$form = $this->Form->create('Usuario');
$form .= $this->Html->div('container h-100',
$this->Html->div('row h-100 justify-content-center align-items-center',
    $this->Html->div('col-10 col-md-8 col-lg-6',
        $this->Html->div('text-center',
            $this->Html->tag('h3', 'Informe seu nível de usuário:') .
            $this->Html->div('form align-items-center',
                $this->Html->div('form-check form-check-inline',
                    $this->Form->input('Usuario.aro_parent_id', array(
                        'legend' => false,
                        'required' => true,
                        'type' => 'radio',
                        'options' => $aros,
                        'class' => 'AbreOpcao form-check-input my-4',
                        'div' => false,
                        'label' => array('class' => 'form-check-label mx-2 my-2'),
                        'error' => array('attributes' => array('class' => 'form-check-input mb-2 text-danger'))
                    ))
                )
            ) .
            
            $this->Form->button(
                'Próximo',
                array(
                    'type' => 'submit',
                    'class' => 'btn btn-success my-4',
                    'escape' => false,
                    'update' => '#content'
                )
            )
        ) 
    )
));
echo $form;