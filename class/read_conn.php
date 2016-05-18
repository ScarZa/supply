<?php
class Read_DB{
    public $read;
    public function Read_Text(){
        
$myfile = fopen("$this->read", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  $conn_db[]= fgets($myfile);
}
fclose($myfile);
return $conn_db;
    }
}
?>
