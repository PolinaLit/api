<?php
echo "<a target='_blank' href='https://github.com/PolinaLit/api_hw'>Github repo</a>";

main();

function main () {
    $apiCall = "https://api.covid19api.com/summary";
    $json_string = curl_get_contents($apiCall);
    $obj = json_decode($json_string);



$arr1= Array();
$arr2= Array();

foreach($obj->Countries as $i) {
   array_push($arr1, $i->Country);
   array_push($arr2, $i->TotalDeaths);
}
$sortedbydeaths = Array();
$sortedbydeaths = array_multisort($arr2, SORT_DESC, $arr1);


make_table($arr1,$arr2);

}

#generating HTML table

function make_table($arr1,$arr2) {
    
    echo "<head>
    <style>
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
}
th {
  text-align: left;
}
</style>
</head>
<body>
<table style='width:100%'>
 <tr>
  <th>Country</th>
  <th>Deaths</th>
      </tr>
    <tr>";

    for ($x = 0; $x <= 10; $x++) {
       echo  "<td>" . $arr1[$x] . "</td>";
       echo  "<td>" . $arr2[$x] . "</td>";
       echo "</tr>
       <tr>";
      }

echo "</tr>

</table>";

    }


#-----------------------------------------
//read data from URL into a string

function curl_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
    
}