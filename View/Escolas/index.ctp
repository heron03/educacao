<?php
$this->extend('/Common/index');
$this->assign('title', 'Escola');
$searchFields .= $this->Form->input(
    'Escola.nome',
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
    array($this->Paginator->sort('Escola.nome', 'Nome') => array('width' => '20%')),
    array('' => array('width' => '28%')),
);

$tableHeaders = $this->Html->tableHeaders($titulos);
$this->assign('tableHeaders', $tableHeaders);

$detalhe = array();
foreach ($escolas as $escola) {   
    $imprimirLote = null;
    $viewNome = $this->Js->link($escola['Escola']['nome'], '/escolas/view/' . $escola['Escola']['id'], array('update' => '#content'));
    $editLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-pen')), '/escolas/edit/' . $escola['Escola']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'escape' => false, 'title' => 'Alterar'));
    $excluirLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-trash')), '/escolas/delete/' . $escola['Escola']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'title' => 'delete', 'escape' => false, 'confirm' => 'Confirmar Exclusão ?'));

    $detalhe[] = array(
        $viewNome,
        $escola['Conteudo']['nome'],
        $excluirLink.$editLink
    );
    $imprimirLink = null;
}

$tableCells = $this->Html->tableCells($detalhe);
$this->assign('tableCells', $tableCells);