<?php
$controllerName = $this->request->params['controller'];

$novoButton = $this->Js->link(
    $this->Html->tag('i', '', array(
        'class' => 'fas fa-plus '
    )) . 
    '&nbsp;Incluir',
    '/' . $controllerName . '/add', 
    array('class' => 'btn btn-success float-right', 'escape' => false, 'update' => '#content')
);

$filtro = $this->Form->create(false, array('class' => 'form-inline'));
$filtro .= $this->fetch('searchFields'); 
$filtro .= $this->Form->button(
    $this->Html->tag('i', '', array('class' => 'fas fa-search')),
    array(
        'class' => 'btn btn-secondary btn-lg',
        'escape' => false,
        'title' => 'Pesquisar',
        'update' => '#content',
        'requisicaoAjax' => 'post'
    )
);
$filtro .= $this->Form->end();
$filtroBar = $this->Html->div('row mb-3 mt-3', 
    $this->Html->div('col-md-10', $filtro) . 
    $this->Html->div('col-md-2', $novoButton) 
);

$tableHeaders = $this->fetch('tableHeaders'); 
$header = $this->Html->tag('thead', $tableHeaders);
$tableCells = $this->fetch('tableCells'); 
$table = $this->Html->tag('table', $header . $tableCells, array('class' => 'table'));


$this->Paginator->options(array('update' => '#content'));
$params = $this->Paginator->params();
$urlPage = $this->Html->url('/' . $controllerName . '/index/page:');
$paginacaoLeft = array(
    'Página',
    $this->html->div(
        'input-group',
        $this->Html->div(
            'input-group-prepend',
            $this->Paginator->prev(
                $this->Html->tag('i', '', array('class' => 'fas fa-chevron-left text-white')),
                array('class' => 'btn btn-secondary btn-lg', 'escape' => false, 'tag' => false)
        )) .
        $this->Form->input('Pagina.atual', array(
            'class' => 'form-control paginacao-campo-size',
            'label' => false,
            'value' => $params['page'],
            'url' => $urlPage,
            'paginate-control' => 'paginateAjax',
            'div' => false
        )) .
        $this->Html->div(
            'input-group-append',
            $this->Paginator->next(
                $this->Html->tag('i', '', array('class' => 'fas fa-chevron-right text-white')),
                array('class' => 'btn btn-secondary btn-lg', 'escape' => false, 'tag' => false)
            )
        )
    ),
    $this->Paginator->counter('de {:pages}')
);
$url = $this->Html->url('/' . $controllerName . '/index/limit:');
$paginacaoRight = array(
    'Ver',
    $this->Form->input('Paginate.limit', array(
        'type' => 'select',
        'options' => array(
            '10' => '10',
            '50' => '50',
            '50' => '50',
            '100' => '100',
        ),
        'label' => false,
        'class' => 'form-control',
        'div' => false,
        'url' => $url,
        'paginate-control' => 'paginateAjax',
        'value' => $params['limit']
    )),
    $this->Paginator->counter('de {:end} encontrados.')
);
$paginateLeft = $this->Html->nestedList($paginacaoLeft, array('class' => 'list-inline'), array('class' => 'list-inline-item'));
$paginateRight = $this->Html->nestedList($paginacaoRight, array('class' => 'list-inline float-right'), array('class' => 'list-inline-item'));
$paginateBar = $this->Html->div(
    'row',
    $this->Html->div('col-md-6', $paginateLeft) .
        $this->Html->div('offset-md-3 col-md-3', $paginateRight)
);

if ($tableCells == '<tr></tr>') {
    $table = $this->Html->div('nenhum-item mb-3',
        $this->Html->tag('h4', 'Nenhum Registro Encontrado', array('class' => 'text-muted mt-5 mb-5 text-center'))
    );
}

echo $this->Flash->render('warning'); 
echo $this->Flash->render('success'); 
echo $this->Html->tag('h1', $this->fetch('title')); 
echo $filtroBar;
echo $table;
if ($tableCells != '<tr></tr>') {
    echo $paginateBar;
}
$this->Js->buffer('setPaginate();');
$this->Js->buffer('createAjax()');
$this->Js->buffer('$(".nav-link").removeClass("active");');
$this->Js->buffer('$(".nav-link a[href$=\'vagas\']").addClass("active");');
if ($this->request->is('ajax')) {
    echo $this->Js->writeBuffer();
}
?>