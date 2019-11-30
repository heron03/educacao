<html lang="PT-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Educação 4.0</title>
    <?php
    echo $this->Html->css('bootstrap.min.css');
    echo $this->Html->css('fontawesome.min.css');
    echo $this->Html->css('font.css');
    ?>
</head>
<body>
<div class="container-fluid bg-white">
        <a class="navbar-brand mr-auto"><p class="h4"> Educação 4.0 &nbsp;|&nbsp; <?php ?></p></a>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="/educacao/disciplinas"><p class="h5"> Disciplinas </p><span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/educacao/aulas"><p class="h5"> Aulas</p></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="/educacao/provas"> <p class="h5"> Provas</p></a>
      </li>
      <li class="nav-item dropdown  active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <spam class="h5"> 
          Instituição
        </spam></a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/educacao/escolas">Escolas</a>
          <a class="dropdown-item" href="/educacao/cursos">Cursos</a>
          <a class="dropdown-item" href="/educacao/turmas">Turmas</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<main role="main" class="container-fluid">
        <div class="my-3 p-3 bg-white rounded shadow-sm">
            <div class="media text-muted pt-3">
                <main role="main" class="container-fluid" id="content">
                    <?php
                    echo $this->Flash->render();
                    echo $this->fetch('content');
                    ?>
                </main>
            </div>
        </div>
    </main>
    <div vw class="enabled">
      <div vw-access-button class="active"></div>
      <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
      </div>
    </div>

    <?php
    echo $this->Html->script('jquery-3.4.1.min.js');
    echo $this->Html->script('vlibras-plugin.js');
    echo $this->Html->script('bootstrap.bundle.min.js');
    echo $this->Js->writeBuffer();
    ?>
    <script>
      new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
</body>

</html>