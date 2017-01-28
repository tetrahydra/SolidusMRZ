# SolidusMRZ
PHP Parse MRZ from Passport, Visa or ID-1

Original development was for my website www.PaperToTravel.com but I am sure it will be useful for other's project as well.

Read an input and return parsed data in an array which can be manipulated further either for usage within PHP environment or output as JSON.

To simple usage, include mrz.php in your project file.

# $MRZ = new SolidusMRZ;
# $mrzocr = 'PTUNKKONI<<MARTINA<<<<<<<<<<<<<<<<<<<<<<<<<<K0503499<8UNK9701241F06022201170650553<<<<10';
# $data = $MRZ->parseMRZ($mrzocr);
# print_r($data);
