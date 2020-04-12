<html lang="PT-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Educação 4.0</title>
    <?php
    echo $this->Html->css('bootstrap.min.css');
    echo $this->Html->css('font.css');
    ?>
</head>
<body>
<div class="container-fluid bg-white">
    <a class="navbar-brand mr-auto"><p class="h4"> e-PNE &nbsp;|&nbsp; <?php ?></p></a>
      <div class='float-right'>
        <button class='btn btn-success my-2' id="speakbt">
            <i class="fa fa-microphone "></i>
        </button>
        <div class="btn-group" role="group">
          <button class='btn btn-secondary my-2' id='play'>
          <i class="fas fa-play"></i>
        </button>
          <button class='btn btn-secondary my-2' id='pause'>
            <i class="fas fa-pause"></i>
          </button>
          <button class='btn btn-secondary my-2' id='stop'>
            <i class="fas fa-stop"></i>
          </button>
      </div>
    </div>
</div>
<div id='ler'>
    <div id="resultSpeak"></div> 
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav col-md-11">
      <li class="nav-item active">
        <a class="nav-link" href="/educacao/cursos"> <p class="h5"> Cursos</p></a>
      </li>
	  <?php

	  ?>
	</ul>
	<ul class="navbar-nav float-right">
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-user"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left" aria-labelledby="navbarDropdown">
				<?php
				echo $this->Html->link('Usuários', '/usuarios/edit/' . AuthComponent::user('id'), array(
					'escape' => false,
					'class' => 'dropdown-item'
        ));
				echo $this->Html->link('Alterar Senha', '/usuarios/alterarsenha/' . AuthComponent::user('id'), array(
					'escape' => false,
					'class' => 'dropdown-item'
        ));
				echo $this->Html->link('Sair', '/usuarios/logout', array(
					'escape' => false,
					'class' => 'dropdown-item'
				));
				?>
			</div>
		</li>
	</ul>
  </div>
</nav>
<div class="search">
</div>
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
  </div>
    <div vw class="enabled">
      <div vw-access-button class="active"></div>
      <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
      </div>
    </div>
    <?php
    echo $this->Html->script('jquery-3.4.1.min.js');
    echo $this->Html->script('vlibras-plugin.js');
    echo $this->Html->script('all.js');
    echo $this->Html->script('inputmask/jquery.inputmask.min.js');
    echo $this->Html->script('inputmask/bindings/inputmask.binding.js');
    echo $this->Html->script('bootstrap.bundle.min.js');
    echo $this->Html->script('textToSpeech.js');
    echo $this->Js->writeBuffer();
    ?>
    <script>
      new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
</body>

</html>