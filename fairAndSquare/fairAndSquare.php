<?

$filename = "C.in";
$fd = fopen($filename, "r");
$contents = fread($fd, filesize($filename));

fclose($fd);


$lines = explode("\n", $contents);


$GLOBALS['table'] = array();
genDat();


////gen test
//for ($i =1; $i<=10000; $i ++) {
//    $r1 = rand(1, 100000000000000);
//    echo $r1 . " " . rand($r1, 100000000000000). "\n";
//}
//return;


$id = 1;
foreach (array_slice($lines, 1) as $line) {     //cut lines (1 to inf)
    if ($id == intval($lines[0]) + 1) {
        return;
    }

    print "Case #$id: " . getResult2(explode(" ", $line));
    print "\n";
    $id++;
}

function getResult2($data) {
    $from = $data[0];
    $to = $data[1];
    $counter = 0;
    $db = $GLOBALS['table'];


    foreach ($db as $num) {
        if ($num >= $from) {
            if ($num <= $to) {
                $counter++;
            }
            else {
                return $counter;
            }
        }
    }

    return $counter;
}

function genDat() {
    
    $GLOBALS['table'] = array(
        0 =>
        1,
        1 =>
        4,
        2 =>
        9,
        3 =>
        121,
        4 =>
        484,
        5 =>
        10201,
        6 =>
        12321,
        7 =>
        14641,
        8 =>
        40804,
        9 =>
        44944,
        10 =>
        1002001,
        11 =>
        1234321,
        12 =>
        4008004,
        13 =>
        100020001,
        14 =>
        102030201,
        15 =>
        104060401,
        16 =>
        121242121,
        17 =>
        123454321,
        18 =>
        125686521,
        19 =>
        400080004,
        20 =>
        404090404,
        21 =>
        10000200001,
        22 =>
        10221412201,
        23 =>
        12102420121,
        24 =>
        12345654321,
        25 =>
        40000800004,
        26 =>
        1000002000001,
        27 =>
        1002003002001,
        28 =>
        1004006004001,
        29 =>
        1020304030201,
        30 =>
        1022325232201,
        31 =>
        1024348434201,
        32 =>
        1210024200121,
        33 =>
        1212225222121,
        34 =>
        1214428244121,
        35 =>
        1232346432321,
        36 =>
        1234567654321,
        37 =>
        4000008000004,
        38 =>
        4004009004004,
    );


    return;

    //script to gen
    //to speed it up, I save output and reuse
    $from = 1;
    $to = 10E13;

    $from = round(sqrt($from));
    $to = round(sqrt($to));

    $db = array();

    $current = $from;
    while ($current <= $to) {
        if (($current == strrev(strval($current)))) {
            $pow = pow($current, 2);
            if ($pow == strrev(strval($pow))) {
                $db[] = pow($current, 2);
            }
        }
        $current++;
    }
    $GLOBALS['table'] = $db;
}