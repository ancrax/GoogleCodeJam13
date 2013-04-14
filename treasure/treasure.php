<?

$filename = "D.in";
$fd = fopen($filename, "r");
$contents = fread($fd, filesize($filename));

fclose($fd);


$lines = explode("\n", $contents);

$count = 0;
$tmp = 0;
$hasKeys = array();
$chests = array();


$id = 1;
foreach (array_slice($lines, 1) as $line) {     //cut lines (1 to inf)
    if ($id == intval($lines[0]) + 1) {
        return;
    }

    if (!$count) {
        $tmp = explode(" ", $line);
        $count = $tmp[1] + 1;

        if (!empty($hasKeys)) {
            print "Case #$id: " . getResult($hasKeys, $chests, 0);
            print "\n";
            $id++;
            $chests = array();
            $keys = array();
        }
        continue;
    }

    if ($tmp[1] == $count - 1) {
        $hasKeys = explode(" ", $line);
        $count--;
    }
    else {
        $chests[] = explode(" ", $line);
        $count--;
    }
}

function getResult($keys, $chests, $count, $order = null) {
    if (empty($chests)) {
        return $order;
    }
    if (empty($keys) OR $count > 21) {
        return "IMPOSSIBLE";
    }
   // print $count. ":c\n";
    
    foreach ($chests as $i => $chest) {
        
        $way = array_search($chest[0], $keys);
        if ($way !== false) {
            $orderBefore = $order;
            if (is_null($order)) {
                $order = $i + 1 . " ";
            }
            else {
                $order .= $i + 1 . " ";
            }

            $keysN = $keys;
            unset($keysN[$way]);
            
            

            if (isset($chest[2])) {
                for ($j = 2; $j < count($chest); $j++) {
                    $keysN[] = $chest[$j];
                }
            }
            
            
            
            $chestsN = $chests;
            unset($chestsN[$i]);
            
            $res = getResult($keysN, $chestsN, $count + 1, $order);
            if ($res != "IMPOSSIBLE") {
                return $res;
            }
            $order = $orderBefore;
        }
    }

    return "IMPOSSIBLE";
}
