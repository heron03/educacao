<?php
App::uses('AppModel', 'Model');

class Prova extends AppModel {
    public $actsAs = array(
        'Containable'
    );
     
    public $belongsTo = array(
        'Disciplina'
    );

    public $validate = array(
        'nome' => array(
            'notBlank' => array('rule' => 'notBlank', 'message' => 'Campo Obrigatório')
        ),
        'enunciado1' => array(
            'notBlank' => array('rule' => 'notBlank', 'message' => 'Campo Obrigatório')
        ),
        'hora' => array(
            'notBlank' => array('rule' => 'notBlank', 'message' => 'Campo Obrigatório')
        ),
        'data' => array(
            'notBlank' => array('rule' => 'notBlank', 'message' => 'Campo Obrigatório')
        )
    );

    public function beforeSave($options = array()) {
        $nomeDaImagem = array(1, 2, 3, 4, 5);
        foreach ($nomeDaImagem as $value) {
            if (!empty($this->data['Prova']['imagem' . $value])) {
                if (is_uploaded_file($this->data['Prova']['imagem' . $value]['tmp_name'])) {
                        $tipo = substr($this->data['Prova']['imagem' . $value]['name'], -4);
                        $this->data['Prova']['imagem' . $value]['name'] = $value . '-foto-' . $value . date("YmdHis") . $tipo;
                        move_uploaded_file($this->data['Prova']['imagem' . $value]['tmp_name'], PROVA . DS . $this->data['Prova']['imagem' . $value]['name']);
                        $this->data['Prova']['imagem' . $value] = $this->data['Prova']['imagem' . $value]['name'];
                } else {
                    $this->data['Prova']['imagem' . $value] = null;
                }
            }
        }

        if (!empty($this->data['Prova']['data'])) {
            $this->data['Prova']['data'] = $this->sqlDate($this->data['Prova']['data']);
        }
        
        return parent::beforeSave($options);
    }
}
?>