(function () {


    var speakBtn = document.querySelector('#speakbt');
    var resultSpeaker = document.querySelector('#resultSpeak');

    if (window.SpeechRecognition || window.webkitSpeechRecognition) {

        var SpeechRecognition = SpeechRecognition || webkitSpeechRecognition;

        var myRecognition = new SpeechRecognition();

        myRecognition.lang = 'pt-BR';


        speakBtn.addEventListener('click', function () {

            try {

                myRecognition.start();

                resultSpeaker.innerHTML = "Estou te ouvindo!";

            } catch (erro) {
                alert('erro:' + erro.message);
            }

        }, false);

        myRecognition.addEventListener('result', function (evt) {

            var resultSpeak = evt.results[0][0].transcript;
            resultSpeak = resultSpeak.toLowerCase();
            resultSpeaker.innerHTML = resultSpeak;

            if (resultSpeak.match(/buscar /)) {

                resultSpeaker.innerHTML = 'Redirecionando...';
                
                setTimeout(function(){
                    
                    console.log(resultSpeak);
                    var resultado = resultSpeak.split('buscar ');
                    buscar = resultado[1];
                    teste = buscar.substr(-1);
                    console.log(teste);                
                    window.location.href = '/educacao/'+buscar;
                    
                },200);
            }

            if (resultSpeak.match(/abrir /)) {
                resultSpeaker.innerHTML = 'Redirecionando...';
                setTimeout(function(){
                    
                    console.log(resultSpeak);
                    var resultado = resultSpeak.split('abrir ');
                    abrir = resultado[1];
                    abrir = 'teste';
                    data = $.getJSON('/educacao/aulas/buscarRegistro/'+abrir,null, function(data){
                    if (data.Aula.id > 1) {
                        window.location.href = 'aulas/view/'+data.Aula.id ;
                    }
                    });
                    
                },200);
            }

        }, false);

        myRecognition.addEventListener('error', function (evt) {

            resultSpeaker.innerHTML = 'Se você disse alguma coisa, não ouvi muito bem!';

        }, false);

    } else {
        resultSpeaker.innerHTML = 'Seu navegador não suporta tanta tecnoligia!';
    }

})();
