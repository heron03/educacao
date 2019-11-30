<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
    
    public $layout = 'bootstrap';
    public $helpers = array('Js' => array('Jquery'));

    public function index() {
        $this->setPaginateConditions();
        try {
            $this->set($this->getControllerName(), $this->paginate());        
        } catch (NotFoundException $e) {
            $this->redirect('/' . $this->getControllerName());
        }
        if ($this->request->is('ajax')) {
            $this->layout = false;
        }
    }

    public function getControllerName() {
        return $this->request->params['controller'];
    }
}
?>