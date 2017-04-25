<?php
    session_start();
?>
<?php

    $connect = @mysql_connect("localhost", "root", "") or exit("Nem sikerült kapcsolódni a MySQL szerverhez!");
    @mysql_select_db("kerdoiv") or exit("Nem sikerült megnyitni az adatbázist!");
    @mysql_query("SET NAMES 'utf8'");
    
    $valaszok = array();
    foreach ($_POST as $key){
        foreach ($key as $value){
            $valaszok[] = $value;
        }
    }
    
    $sql = "SELECT id, v1, v2, v3, v4 FROM kerdesek;";   
    
    $result_k = mysql_query($sql);
    
    $kerdes = array();
    while ($sor = mysql_fetch_assoc($result_k)){
        $kerdes[] = $sor;
    }
    
    $v1 = 0;
    $v2 = 0;
    $v3 = 0;
    $v4 = 0;
    
    
    for($i=0;$i<4;$i++){
        foreach($kerdes as $key => $value){
            if(isset($valaszok[$i])){
                if($valaszok[$i] == $kerdes[$key]['v1'] && $v1 == 0){
                    $v1 = 1;
                }
                
                if($valaszok[$i] == $kerdes[$key]['v2'] && $v2 == 0){
                    $v2 = 1;
                }
                
                if($valaszok[$i] == $kerdes[$key]['v3'] && $v3 == 0){
                    $v3 = 1;
                }
                
                if($valaszok[$i] == $kerdes[$key]['v4'] && $v4 == 0){
                    $v4 = 1;
                }
            }
        }
    }
    
   $sql = "INSERT INTO valaszok(k_id,v1,v2,v3,v4) VALUES('{$_SESSION['id']}','{$v1}','{$v2}','{$v3}','{$v4}')";
    
    
   mysql_query($sql);
   
   header("Location: index.php");
    
?>