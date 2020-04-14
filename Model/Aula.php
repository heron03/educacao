<?php
App::uses('AppModel', 'Model');

class Aula extends AppModel {
    public $actsAs = array(
        'Containable'
    );
     
    public $belongsTo = array(
        'Disciplina'
    );

    public function beforeSave($options = array()) {
        $continue = true;
        if (!empty($this->data['Aula']['data'])) {
            $this->data['Aula']['data'] = $this->sqlDate($this->data['Aula']['data']);
        }
        
        return parent::beforeSave($options);
    }
}
?>