<?php
$this->extend('/Common/index');
$this->assign('title', 'Disciplina');
$searchFields .= $this->Form->input(
    'Disciplina.nome',
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
    array($this->Paginator->sort('Disciplina.nome', 'Disciplina') => array('width' => '25%')),
    array($this->Paginator->sort('Usuario.nome', 'Profesor') => array('width' => '25%')),
    array('' => array('width' => '20%')),
);

$tableHeaders = $this->Html->tableHeaders($titulos);
$this->assign('tableHeaders', $tableHeaders);

$detalhe = array();
foreach ($disciplinas as $disciplina) { 
    $viewNome = $this->Js->link($disciplina['Disciplina']['nome'], '/disciplinas/view/' . $disciplina['Disciplina']['id'], array('update' => '#content'));
    $excluirLink.$editLink = null;
    if (AuthComponent::user('aro_parent_id') != 1) {	
        $editLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-pen')), '/disciplinas/edit/' . $disciplina['Disciplina']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'escape' => false, 'title' => 'Alterar'));
        $excluirLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-trash')), '/disciplinas/delete/' . $disciplina['Disciplina']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'title' => 'delete', 'escape' => false, 'confirm' => 'Confirmar Exclusão ?'));
    }

    $detalhe[] = array(
        $viewNome,
        $disciplina['Usuario']['nome'],
        $excluirLink.$editLink
    );
    $imprimirLink = null;
}

$tableCells = $this->Html->tableCells($detalhe);
$this->assign('tableCells', $tableCells);