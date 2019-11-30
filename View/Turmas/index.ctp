<?php
$this->extend('/Common/index');
$this->assign('title', 'Turma');
$searchFields .= $this->Form->input(
    'Turma.nome',
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
    array($this->Paginator->sort('Turma.nome', 'Nome') => array('width' => '40%')),
    array($this->Paginator->sort('Turma.semestres', 'Semestre') => array('width' => '40%')),
    array('' => array('width' => '20%')),
);

$tableHeaders = $this->Html->tableHeaders($titulos);
$this->assign('tableHeaders', $tableHeaders);

$detalhe = array();
foreach ($turmas as $turma) {   
    $imprimirLote = null;
    $viewNome = $this->Js->link($turma['Turma']['nome'], '/turmas/view/' . $turma['Turma']['id'], array('update' => '#content'));
    $editLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-pen')), '/turmas/edit/' . $turma['Turma']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'escape' => false, 'title' => 'Alterar'));
    $excluirLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-trash')), '/turmas/delete/' . $turma['Turma']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'title' => 'delete', 'escape' => false, 'confirm' => 'Confirmar Exclusão ?'));

    $detalhe[] = array(
        $viewNome,
        $turma['Turma']['semestres'],
        $excluirLink.$editLink
    );
    $imprimirLink = null;
}

$tableCells = $this->Html->tableCells($detalhe);
$this->assign('tableCells', $tableCells);