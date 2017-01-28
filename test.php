<?php

include('mrz.php');

$MRZ = new SolidusMRZ;

$mrzocr = '
PTUNKKONI<<MARTINA<<<<<<<<<<<<<<<<<<<<<<<<<<
K0503499<8UNK9701241F06022201170650553<<<<10
';

$data = $MRZ->parseMRZ($mrzocr);
print_r($data);
