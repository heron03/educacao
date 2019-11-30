<?php

class ALLTest extends CakeTestSuite {

    public static function suite() {
        $suite = new CakeTestSuite(utf8_encode('TODOS OS TESTES UNIT�RIOS:'));
        $suite->addTestDirectoryRecursive(TESTS . 'Case');
        
        return $suite;
    }
    
}
?>