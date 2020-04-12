<?php
$form = $this->Form->create('Usuario');
$form .= $this->Html->div('container h-100',
$this->Html->div('row h-100 justify-content-center align-items-center',
    $this->Html->div('col-10 col-md-8 col-lg-6',
        $this->Html->div('text-center',
        $this->Html->tag('h3', 'Oque você é ?') .
    $this->Html->div('form align-items-center',
        $this->Html->div('form-check form-check-inline',
            $this->Form->input('Usuario.aro_parent_id', array(
                'legend' => false,
                'required' => true,
                'type' => 'radio',
                'options' => $aros,
                'class' => 'AbreOpcao form-check-input mb-2',
                'div' => false,
                'label' => array('class' => 'form-check-label mr-3 mb-2'),
                'error' => array('attributes' => array('class' => 'form-check-input mb-2 text-danger'))
            )
        ))) .
        
        $this->Form->button(
            'Proxima',
            array(
                'type' => 'submit',
                'class' => 'btn btn-success mr-3',
                'escape' => false,
                'update' => '#content'
            )
        )
    ) 
)));
echo $form;