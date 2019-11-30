<?php
$this->extend('/Common/index');
$this->assign('title', 'Curso');
$searchFields .= $this->Form->input(
    'Curso.nome',
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
    array($this->Paginator->sort('Curso.nome', 'Nome') => array('width' => '40%')),
    array($this->Paginator->sort('Curso.semestres', 'Semestre') => array('width' => '40%')),
    array('' => array('width' => '20%')),
);

$tableHeaders = $this->Html->tableHeaders($titulos);
$this->assign('tableHeaders', $tableHeaders);

$detalhe = array();
foreach ($cursos as $curso) {   
    $imprimirLote = null;
    $viewNome = $this->Js->link($curso['Curso']['nome'], '/cursos/view/' . $curso['Curso']['id'], array('update' => '#content'));
    $editLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-pen')), '/cursos/edit/' . $curso['Curso']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'escape' => false, 'title' => 'Alterar'));
    $excluirLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-trash')), '/cursos/delete/' . $curso['Curso']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'title' => 'delete', 'escape' => false, 'confirm' => 'Confirmar Exclusão ?'));

    $detalhe[] = array(
        $viewNome,
        $curso['Curso']['semestres'],
        $excluirLink.$editLink
    );
    $imprimirLink = null;
}

$tableCells = $this->Html->tableCells($detalhe);
$this->assign('tableCells', $tableCells);