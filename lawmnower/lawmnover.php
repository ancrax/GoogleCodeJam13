<?

$filename = "B.in";
$fd = fopen($filename, "r");
$contents = fread($fd, filesize($filename));

fclose($fd);


$lines = explode("\n", $contents);


$id = 1;
$fragmentSize = 0;
$data = array();
foreach (array_slice($lines, 1) as $line) {     //cut lines (1 to inf)
    if ($id == intval($lines[0]) + 1) {
        return;
    }
    if (!$fragmentSize) {
        if (!empty($data)) {
            
            print "Case #$id: " . getResult($data);
            print "\n";
            $id++;
            $data = array();
        }
        $fragmentSize = explode(" ", $line);
        $fragmentSize = $fragmentSize[0];
    }
    else {
        $data[] = explode(" ", $line);
        $fragmentSize--;
    }
}

function getResult($data) {
    //check neighbourds
    for ($i = 0; $i < count($data); $i++) {
        for ($j = 0; $j < count($data[0]); $j++) {
            $current = $data[$i][$j];

            $jo = false;
            foreach ($data[$i] as $point) {
                if ($current < $point) {
                    $jo = true;
                    break;
                }
            }

            if ($jo) {
                for ($k = 0; $k < count($data); $k++) {
                    
                    if ($k==0 AND $j == 1) {
                    }
                    if ($current < $data[$k][$j]) {
                        return "NO";
                    }
                }
            }

        }
    }

    return "YES";
}