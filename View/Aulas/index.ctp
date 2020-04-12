<?php
$this->extend('/Common/index');
$this->assign('title', 'Aula');
$searchFields .= $this->Form->input(
    'Aula.nome',
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
    array($this->Paginator->sort('Aula.data', 'Data') => array('width' => '25%')),
    array($this->Paginator->sort('Disciplina.nome', 'Disciplina') => array('width' => '25%')),
    array($this->Paginator->sort('Aula.nome', 'Aula') => array('width' => '25%')),
    array('' => array('width' => '20%')),
);

$tableHeaders = $this->Html->tableHeaders($titulos);
$this->assign('tableHeaders', $tableHeaders);

$detalhe = array();
foreach ($aulas as $aula) { 
    $viewData = date('d/m/Y', $aula['Aula']['data']);
    $viewNome = $this->Js->link($aula['Aula']['nome'], '/aulas/view/' . $aula['Aula']['id'], array('update' => '#content'));
    $viewData = $this->Js->link($viewData, '/aulas/view/' . $aula['Aula']['id'], array('update' => '#content'));    $excluirLink.$editLink = null;
    if (AuthComponent::user('aro_parent_id') != 1) {
        $editLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-pen')), '/aulas/edit/' . $aula['Aula']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'escape' => false, 'title' => 'Alterar'));
        $excluirLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-trash')), '/aulas/delete/' . $aula['Aula']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'title' => 'delete', 'escape' => false, 'confirm' => 'Confirmar Exclusão ?'));
    }

    $detalhe[] = array(
        $viewNome,
        $viewData,
        $aula['Disciplina']['nome'],
        $excluirLink.$editLink
    );
}

$tableCells = $this->Html->tableCells($detalhe);
$this->assign('tableCells', $tableCells);