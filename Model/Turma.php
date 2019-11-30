<?php
App::uses('AppModel', 'Model');

class Turma extends AppModel {
    public $actsAs = array(
        'Containable'
    );
     
    public $belongsTo = array(
        'Curso'
    );

    public $virtualFields = array(
        'nomeSemestre' => "CONCAT(Curso.nome, ' - ', Turma.semestres, '° Semestre')",
    );

    public function getTurma() {
        $this->virtualFields = array(
            'nomeSemestre' => "CONCAT(Curso.nome, ' - ', Turma.semestres, '° Semestre')"
        );
        $contain = array('Curso' => array('fields' => 'Curso.nome'));
        $fields = array('Turma.id', 'Turma.nomeSemestre');
        $retorno = $this->find('list', compact('fields', 'contain'));

        return $retorno;
    }
}
?>