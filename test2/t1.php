<?php 

    echo "<h3>Structure Data Test (1)</h3>";
    // test 1
    $data = [
        [
            'no_transaction' => '001',
            'items' => [
                ['name' => 'Milk', 'total' => 4],
                ['name' => 'Coffee', 'total' => 2],
            ]
        ],
        [
            'no_transaction' => '002',
            'items' => [
                ['name' => 'Tea', 'total' => 7],
                ['name' => 'Sugar', 'total' => 1],
                ['name' => 'Coffee', 'total' => 5],
            ]
        ]

    ];

    foreach($data as $d){
        echo $d['no_transaction']."<br>";
        foreach($d['items'] as $i){
            if($i['name'] == "Sugar" || $i['name'] == "Coffe"){
                echo "";
            }else{
                echo "  ".$i['name']." (".$i['total'].")<br>";
            }
        }
    }

    echo "<br><br><br>";
    echo "<h3>Structure Data Test (2)</h3>";
    
    // test 2
    $customers = ['rio', 'ari', 'yuki'];
    $contacts = [
        'ari' => '84684646',
        'dewi' => '47464524',
        'beni' => '4734526',
        'rio' => '4774525',
        'fitri' => '74563734',
    ];

    foreach($customers as $val){
        if (array_key_exists($val,$contacts)){
            echo $val.": ".$contacts[$val]."<br>";
        }else{
            echo $val.": no contact<br>";
        }
    }
?>
