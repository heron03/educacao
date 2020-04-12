<?php
/**
* Setup do ACL para controle de acesso dos usuários:
* 
* 1 - Criar as tables:
*       
*       cake schema create DbAcl -app f:\xampp\apps\educacao
* 
* 2 - Criar os AROs:
*   
*       cake GerarUsuarioPermissao aros -app f:\xampp\apps\educacao
* 
* 3 - Criar os ACOs:
* 
*       cake GerarUsuarioPermissao acos -app f:\xampp\apps\educacao
* 
* 4 - Criar as permissões:
* 
*       cake GerarUsuarioPermissao permissions -app f:\xampp\apps\educacao
* 
* 5 - Configurar os usuários:
* 
*       cake GerarUsuarioPermissao usuarios -app f:\xampp\apps\educacao
* 
*---------------------------------------------------------------------------------------------------- 
* 
* Toda nova funcionalidade (controller) deverá ser incluso dentro do seu ACO correspondente.
* Para adicionar novo ACO:
* 
*       cake acl create aco <nome_do_parent> <alias_novo_aco>
*  
* Para deletar um ACO:
* 
*       cake acl delete aco <alias_aco>
* 
* Para adicionar novo ARO:
* 
*       cake acl create aro <nome_do_parent> <alias_novo_aro>
* 
* Para deletar um ARO:
* 
*       cake acl delete aro <alias_aro>
* 
* Para alterar um parent de um ARO/ACO:
* 
*       cake acl setparent <aro/aco> <alias_aro_aco> <alias_parent> -app c:\xampp\apps\sinalizacao
* 
*/
App::uses('AppShell', 'Console/Command');
App::uses('Controller', 'Controller');
App::uses('ComponentCollection', 'Controller');
App::uses('AclComponent', 'Controller/Component');

class GerarUsuarioPermissaoShell extends AppShell {
 
    public $uses = array('Aro', 'Aco', 'Usuario');
    public $Acl = null;
    
    public function main() {
        echo "BEGIN\n";
        if (empty($this->args[0])) {
            echo "Nada a executar...\n";    
        } else {
            $action = $this->args[0];
            if (method_exists($this, $action)) {
                $this->{$action}();
            } else {
                echo "Comando desconhecido...\n";                    
            }
        }
        
        echo "END.\n";        
    }
    
    public function aros() {
        $aros = array(
            array('alias' => 'Aluno'),
            array('alias' => 'Professor'),
            array('alias' => 'Instituição'),
        );
        echo "Creating AROs...\n";
        foreach ($aros as $aro) {
            $this->Aro->create();
            $aro = $this->Aro->save($aro);            
            echo json_encode($aro) . "\n";
        }
        echo "done.\n";
    }
    
    public function acos() {
        $acos = array(
            array('alias' => 'Aulas'),
            array('alias' => 'Usuarios'),
            array('alias' => 'Cursos'),
            array('alias' => 'Disciplinas'),
            array('alias' => 'Provas'),
            array('alias' => 'Turmas'),
        );
        echo "Creating ACOs...\n";
        foreach ($acos as $aco) {
            $this->Aco->create();
            $aco = $this->Aco->save($aco);            
            echo json_encode($aco) . "\n";
        }
        echo "done.\n";
    }
    
    public function permissions() {
        echo "Creating Instituição permissions...";

        $collection = new ComponentCollection();
        $this->Acl = new AclComponent($collection);
        $controller = new Controller();
        $this->Acl->startup($controller);        

        $this->Acl->allow('Instituição', 'Aulas');
        $this->Acl->allow('Instituição', 'Usuarios');
        $this->Acl->allow('Instituição', 'Cursos');
        $this->Acl->allow('Instituição', 'Disciplinas');
        $this->Acl->allow('Instituição', 'Provas');
        $this->Acl->allow('Instituição', 'Turmas');

        echo "ok\n";
        
        echo "Creating Professor permissions...";
        
        $this->Acl->allow('Professor', 'Aulas');
        $this->Acl->allow('Professor', 'Usuarios');
        $this->Acl->allow('Professor', 'Cursos');
        $this->Acl->allow('Professor', 'Disciplinas');
        $this->Acl->allow('Professor', 'Provas');
        $this->Acl->allow('Professor', 'Turmas');

        echo "ok\n";       
        
        echo "Creating Aluno permissions...";

        $this->Acl->allow('Aluno', 'Aulas');
        $this->Acl->allow('Aluno', 'Usuarios');
        $this->Acl->allow('Aluno', 'Cursos', 'read');
        $this->Acl->allow('Aluno', 'Disciplinas', 'read');
        $this->Acl->allow('Aluno', 'Provas');
        $this->Acl->allow('Aluno', 'Turmas', 'read');

        echo "ok\n";         
    }
    
    public function usuarios() {
        echo "Create Usuario...\n";
        
        $fields = array('Usuario.id', 'Usuario.aro_parent_id');
        $contain = false;
        $usuarios = $this->Usuario->find('all', compact('fields', 'contain'));
        foreach ($usuarios as $usuario) {
            $saved = $this->Usuario->save($usuario);
            echo json_encode($saved) . "\n";
        }
        echo "done.\n";        
    }
    
}
?>