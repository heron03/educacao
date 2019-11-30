<?php
App::uses('AppModel', 'Model');

class Prova extends AppModel {
    public $actsAs = array(
        'Containable'
    );
     
    public $belongsTo = array(
        'Disciplina'
    );

    public function beforeSave($options = array()) {
        if (!empty($this->data['Prova']['data'])) {
            $this->data['Prova']['data'] = $this->sqlDate($this->data['Prova']['data']);
        }
        
        return parent::beforeSave($options);
    }
}
?>