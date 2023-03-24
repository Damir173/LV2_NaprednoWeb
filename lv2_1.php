<?php

databaseBackup("localhost", "root", "", "radovi");

function databaseBackup($host, $user, $pass, $dbname) {

    $return = '';
    $dbConnection = mysqli_connect($host, $user, $pass, $dbname);
    mysqli_query($dbConnection, "SET NAMES 'utf8'");


    #region Dohvacanje liste tablica, popunjavanje u polje
        $arrayOfTables = array();
        $query = mysqli_query($dbConnection, 'SHOW TABLES');

        while($row = mysqli_fetch_row($query))
        {
            $arrayOfTables[] = $row[0];
        }
    #endregion

    #region Prolazak kroz polje tablica
    foreach($arrayOfTables as $table)
    {
        $query = mysqli_query($dbConnection, 'SELECT * FROM '.$table);
        $col = mysqli_num_fields($query);    // broj stupaca 
        $rows = mysqli_num_rows($query);        // broj redaka 


        $return.= 'DROP TABLE IF EXISTS '.$table.';';
        $row2 = mysqli_fetch_row(mysqli_query($dbConnection, 'SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";
        $counter = 1;

    
        for ($i = 0; $i < $col; $i++) 
        {   
            while($row = mysqli_fetch_row($query))
            {   
                if($counter == 1){
                    $return.= 'INSERT INTO '.$table.' VALUES(';
                } else {
                    $return.= '(';
                }

                for($j=0; $j<$col; $j++) 
                {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ( $j <($col - 1)) { $return.= ','; }
                }
                
                if($rows == $counter) {
                    $return.= ");\n";
                } else {
                    $return.= "),\n";
                }

                ++$counter;
            }
        }
        $return.="\n\n\n";
    }

    #endregion


    $file = 'backup-'.time().'.txt';
    $save = fopen($file,'w+');
    fwrite($save,$return);
}