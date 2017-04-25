<?php

    $connect = @mysql_connect("localhost", "root", "") or exit("Nem sikerült kapcsolódni a MySQL szerverhez!");
    @mysql_select_db("kerdoiv") or exit("Nem sikerült megnyitni az adatbázist!");
    @mysql_query("SET NAMES 'utf8'");
    
    $sql = "SELECT 
    kerdes,
    SUM(valaszok.v1) AS v1,
    SUM(valaszok.v2) AS v2,
    SUM(valaszok.v3) AS v3,
    SUM(valaszok.v4) AS v4
    FROM
    valaszok,
    kerdesek
    WHERE
    kerdesek.id = valaszok.k_id
    GROUP BY 1;";
    
    $result = mysql_query($sql);
    
    $tabla = array();
    while ($sor = mysql_fetch_assoc($result)){
        $tabla[] = $sor;
    }

    $sql = "SELECT kerdes,v1,v2,v3,v4 FROM kerdesek;";
    
    $result_q  = mysql_query($sql);
    
    $kerdesek = array();
    while($sor = mysql_fetch_array($result_q)){
        $kerdesek[] = $sor;
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Eredmények</title>
        <link rel="stylesheet" href="results.css" type="text/css">
    </head>
    <body>
        <h1><label id="elso">A vála</label>
            <label id="masod">szok</label>
            <label id='harm'> össze</label>
            <label id='negyed'>gzése</label>
        </h1>
        <?php
            echo "<table border='1'>";
            foreach($kerdesek as $kerdes => $value){
                foreach($tabla as $ered => $value2){
                    if($kerdesek[$kerdes]['kerdes']==$tabla[$ered]['kerdes']){
                        echo "<tr class='kerdes'>";
                        echo "<td>{$kerdesek[$kerdes]['kerdes']}</td>";
                        echo "<td>{$kerdesek[$kerdes]['v1']}</td>";
                        echo "<td>{$kerdesek[$kerdes]['v2']}</td>";
                        echo "<td>{$kerdesek[$kerdes]['v3']}</td>";
                        echo "<td>{$kerdesek[$kerdes]['v4']}</td>";
                        echo "</tr>";
                        echo "<tr class='valasz'>";
                        echo "<td>Eredmény</td>";
                        echo "<td>{$tabla[$ered]['v1']}</td>";
                        echo "<td>{$tabla[$ered]['v2']}</td>";
                        echo "<td>{$tabla[$ered]['v3']}</td>";
                        echo "<td>{$tabla[$ered]['v4']}</td>";
                        echo "</tr>";
                    }
                }
            }
            echo "</table>";
        ?>
    </body>
</html>