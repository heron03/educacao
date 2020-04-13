<?php
$this->extend('/Common/index');
$this->assign('title', 'Turma');
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


if (AuthComponent::user('aro_parent_id') != 1) {
    $titulos = array(
        array($this->Paginator->sort('Curso.nome', 'Curso') => array('width' => '25%')),
        'Código para vincular aluno na turma',
        array('' => array('width' => '20%')),
    );
} else {
    $titulos = array(
        array($this->Paginator->sort('Curso.nome', 'Curso') => array('width' => '25%')),
        array('' => array('width' => '20%')),
    );
}

$tableHeaders = $this->Html->tableHeaders($titulos);
$this->assign('tableHeaders', $tableHeaders);

$detalhe = array();
foreach ($turmas as $turma) { 
    $viewNome = $this->Js->link($turma['Curso']['nome'] . ' ' . $turma['Turma']['semestres'] . '° Semestre', '/turmas/view/' . $turma['Turma']['id'], array('update' => '#content'));    $excluirLink.$editLink = null;
    if (AuthComponent::user('aro_parent_id') != 1) {
        $editLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-pen')), '/turmas/edit/' . $turma['Turma']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'escape' => false, 'title' => 'Alterar'));
        $excluirLink = $this->Js->link($this->Html->tag('span', '', array('class' => 'fas fa-trash')), '/turmas/delete/' . $turma['Turma']['id'], array('update' => '#content', 'class' => 'btn btn-secondary float-right ml-2', 'title' => 'delete', 'escape' => false, 'confirm' => 'Confirmar Exclusão ?'));
        $detalhe[] = array(
            $viewNome,
            base64_encode($turma['Turma']['id']),
            $excluirLink.$editLink
        );
    } else {
        $detalhe[] = array(
            $viewNome,
            $excluirLink.$editLink
        );
    }
    $imprimirLink = null;
}

$tableCells = $this->Html->tableCells($detalhe);
$this->assign('tableCells', $tableCells);