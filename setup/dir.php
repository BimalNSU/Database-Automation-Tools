
<?php $out = array();
$index = 0;
foreach (glob('../scripts/*.php') as $filename) {
    $p = pathinfo($filename);
    $out[$index] = $p['filename'];
    $index++;
}
echo json_encode($out); 
?>
