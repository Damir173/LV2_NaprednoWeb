<?php


function open($p, $element, $attributes) {
    switch($element) {
        case 'DATASET':
            echo ' <table><tr> <th>ID</th> <th>IME</th> <th>PREZIME</th> <th>EMAIL</th> <th>SPOL</th> <th>SLIKA</th> <th>ŽIVOTOPIS</th> </tr>';
            break;
        case 'RECORD':
            echo '<tr>';
            break;
        case 'SLIKA':
            echo '<th><div><img src="';
            break;
        case 'ID';    	
        case 'IME':
        case 'PREZIME':
        case 'EMAIL':
        case 'ZIVOTOPIS':
        case 'SPOL':
            echo '<th>';
            break;
    }
}


function close($p, $element) {
    switch($element) {
        case 'DATASET':
            echo '</table>';
            break;
        case 'RECORD':
            echo '</tr>';
            break;
        case 'ID':
        case 'IME':
        case 'PREZIME':
        case 'EMAIL':
        case 'ZIVOTOPIS':
            echo '</th>';
            break;
        case 'SLIKA':
            echo '"/></div></th>';
            break;
        
    }
}

function data($p, $cdata) {
    echo $cdata;
}


$p = xml_parser_create();
	xml_set_element_handler($p, 'open', 'close');
	xml_set_character_data_handler($p, 'data');
	
	$file = 'LV2.xml';
	$fp = @fopen($file, 'r');
	while ($data = fread($fp, 4096)) {
		xml_parse($p, $data, feof($fp));
	}
	xml_parser_free($p);
?>