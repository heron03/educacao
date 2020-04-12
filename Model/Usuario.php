<?php
App::uses('AppModel', 'Model');

class Usuario extends AppModel {
    public $actsAs = array('Containable');
    
    public $validate = array(
        'nome' => array(
            'notBlank' => array('rule' => 'notBlank', 'message' => 'Informe o nome'),
            'minLength' => array('rule' => array('minLength', 3), 'message' => 'Informe um nome com mais de 2 dígitos'),
        ),
        'senha' => array(
            'notBlank' => array('rule' => 'notBlank', 'message' => 'Campo Obrigatório'),
            'minLength' => array('rule' => array('minLength', 4), 'message' => 'Senha deve possuir mais de 3 dígitos.', 'last' => true),
            'checkSenha' => array('rule' => 'checkSenha', 'message' => 'Senha informada não confere com a informada na confirmação.'),
        ),
        'confirma_senha' => array(
            'notBlank' => array('rule' => 'notBlank', 'message' => 'Confirme a senha.', 'last' => true),
        ),
        'login' => array(
            'isUnique' => array('rule' => 'isUnique', 'message' => 'Login já existe'),
        )
    );

    public function beforeSave($options = array()) {
        if (!empty($this->data['Usuario']['senha'])) {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $this->data['Usuario']['senha'] = $passwordHasher->hash(
                $this->data['Usuario']['senha']
            );
        }

        return true;
    }    

    public function checkSenha($check) {
        $result = true;
        if (!empty($check) && isset($this->data["Usuario"]["confirma_senha"])) {
            $values = array_values($check);
            $result = $this->data["Usuario"]["confirma_senha"] == $values[0];
        }
        
        return $result;
    }

    public function afterSave($created, $options = array()) {
        if (!empty($this->data['Usuario']['aro_parent_id'])) {
            $this->aroSave();
        }
    }

    public function aroSave() {
        $Aro = ClassRegistry::init('Aro');
        $aro = $Aro->findByForeignKey($this->data['Usuario']['id']);
        $saveAro = array(
            'model' => 'Usuario',
            'foreign_key' => $this->data['Usuario']['id'],
            'parent_id' => $this->data['Usuario']['aro_parent_id']
        );
        if (empty($aro)) {
            $Aro->create();
        } else {
            $Aro->id = $aro['Aro']['id'];
        }
        $Aro->save($saveAro);        
    }

}
?>