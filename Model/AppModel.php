<?php

App::uses('Model', 'Model');

class AppModel extends Model {
    public function sqlDate($userDate) {
        $date = $userDate;   
        if (strlen($userDate) == 10) {
            $year = substr($userDate, 6, 4);
            $month = substr($userDate, 3, 2);
            $day = substr($userDate, 0, 2);
            $date = $year . '-' . $month . '-' . $day;
        }
        
        return $date;
    }

    public function userDate($sqlDate) {
        $date = $sqlDate;   
        if (strlen($sqlDate) == 10) {
            $year = substr($sqlDate, 0, 4);
            $month = substr($sqlDate, 5, 2);
            $day = substr($sqlDate, 8, 2);
            $date =  $day . '/' . $month . '/' . $year;
        }
        
        return $date;
    }
}
?>