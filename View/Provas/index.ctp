<?php
$this->extend('/Common/index');
$this->assign('title', 'Prova');
$searchFields .= $this->Form->input(
    'Prova.nome',
    array(
        'placeholder' => 'Nome',
        'label' => array('class' => 'sr-only'),
        'class' => 'form-control mr-2',
        'div' => false,
        'requisicaoAjax' => 'post'
    )
);

$this->assign('searchFields', $searchFields);

$titulos = array(
    array($this->Paginator->sort('Prova.data', 'Data') => array('width' => '25%')),
    array($this->Paginator->sort('Disciplina.nome', 'Disciplina') => array('width' => '25%')),
    array($this->Paginator->sort('Prova.nome', 'Prova') => array('width' => '25%')),
    array('' => array('width' => '20%')),
);

$tableHeaders = $this->Html->tableHeaders($titulos);
$this->assign('tableHeaders', $tableHeaders);

$detalhe = array();
foreach ($provas as $prova) { 
    $viewData = date('d/m/Y h:i', strtotime($prova['Prova']['data'] . $prova['Prova']['hora']));
    $viewNome = $this->Js->link($prova['Prova']['nome'], '/provas/view/' . $prova['Prova']['id'], array('update' => '#content'));
    $viewData = $this->Js->link($viewData, '/provas/view/' . $prova['Prova']['id'], array('update' => '#content'));
    $editLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-pen')), '/provas/edit/' . $prova['Prova']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'escape' => false, 'title' => 'Alterar'));
    $excluirLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-trash')), '/provas/delete/' . $prova['Prova']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'title' => 'delete', 'escape' => false, 'confirm' => 'Confirmar Exclusão ?'));

    $detalhe[] = array(
        $viewData,
        $prova['Disciplina']['nome'],
        $viewNome,
        $excluirLink.$editLink
    );
}

$tableCells = $this->Html->tableCells($detalhe);
$this->assign('tableCells', $tableCells);