<!doctype html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php 
            echo $this->Html->css('bootstrap.min.css');
            echo $this->Html->css('font.css');
        ?>
    </head>
    <body id="content">
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
        <?php 
            echo $this->fetch('content');
            echo $this->Html->script('jquery-3.4.1.min.js');
            echo $this->Html->script('bootstrap.bundle.min.js');
            echo $this->Js->writeBuffer();
        ?>
    </body>
</html>