<?php
$this->extend('/Common/index');
$this->assign('title', 'Usuários');
$searchFields .= $this->Form->input(
    'Usuario.nome_or_cpf',
    array(
        'placeholder' => 'Nome ou CPF',
        'label' => array('class' => 'sr-only'),
        'class' => 'form-control mr-2',
        'div' => false,
        'requisicaoAjax' => 'post'
    )
);

$this->assign('searchFields', $searchFields);

$titulos = array(
    array($this->Paginator->sort('Usuario.login', 'Login') => array('width' => '8%')),
    array('Nome' => array('width' => '30%')),
    array('E-mail' => array('width' => '10%')),
    array('CPF' => array('width' => '10%')),
    array('Nível' => array('width' => '7%')),
    array('Situação' => array('width' => '10%')),
    array(' ' => array('width' => '15%'))
);

$tableHeaders = $this->Html->tableHeaders($titulos);
$this->assign('tableHeaders', $tableHeaders);

$detalhe = array();
foreach ($usuarios as $usuario) {
    $viewlogin = $this->Js->link(
        $usuario['Usuario']['login'], '/usuarios/view/' . $usuario['Usuario']['id'], array('update' => '#content'));
    $editLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-pen')), '/usuarios/edit/' . $usuario['Usuario']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'escape' => false, 'title' => 'Alterar'));
    $alterarsenhaLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-key')), '/usuarios/alterarsenha/' . $usuario['Usuario']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'escape' => false,'title' => 'Alterar Senha'));
    $bloquearLink = $desbloquearLink="";
    if (empty($usuario['Usuario']['blocked'])) {
        $usuario['Usuario']['blocked'] = 'Ativo';
        $bloquearLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-lock')), '/usuarios/bloquear/' . $usuario['Usuario']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'title' => 'Bloquear', 'escape' => false, 'confirm' => 'Bloquear Usuário?'));
        $colorTextSituacao = 'text-success';
    } else { 
        $usuario['Usuario']['blocked'] = 'Bloqueado';
        $desbloquearLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-unlock')), '/usuarios/desbloquear/' . $usuario['Usuario']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'escape' => false, 'title' => 'Desbloquear', 'confirm' => 'Desbloquear Usuário?'));

        $colorTextSituacao = 'text-warning';
    }
    
    $detalhe[] = array(
        $viewlogin,
        $usuario['Usuario']['nome'],
        $usuario['Usuario']['email'],
        $usuario['Usuario']['cpf'],
        $usuario['Usuario']['aro_parent_id'],
        $this->Html->tag('span', $usuario['Usuario']['blocked'], array('class' => $colorTextSituacao)),
        $bloquearLink.$desbloquearLink.$alterarsenhaLink.$editLink 
    );
}

$tableCells = $this->Html->tableCells($detalhe);
$this->assign('tableCells', $tableCells);