<?php 

function unit($Username, $Password, $Email, $Database, $DataFile, $tablename){
if ($Database == "sqlite"){
if (!isset($Username)){
	echo "false";
	return "false";
	exit();
	
}
$db = new SQLite3('$DataFile');
$SUEmail = str_replace("@", ">", $Email);
if($db){
        
    }
    $results = $db->query('SELECT * FROM $tablename');
    while($row=$results->fetchArray(SQLITE3_ASSOC)){
        $ID = $row['Username'];
        $EMASSS = $row['Email'];
        
        
    }
    if (!filter_var($EM, FILTER_VALIDATE_EMAIL)) {
  echo "Invalid Email";
exit();
}
 if ($Username == $ID){
 echo "That Username Already Used";
exit();
 
 }else if ($EMASSS == $SUEmail){
  echo "That Email Already Used";

 exit();
 
 }else {
 
$SUPassword = password_hash('$Password', PASSWORD_DEFAULT);
$SUEmail = str_replace("@", ">", $Email);
$db->exec("INSERT INTO $tablename(Username, Password, Email) VALUES('$Username', '$SUPassword', '$SUEmail')");
$cookie_bat = "UID";
$cookie_indesk = $Username;
setcookie($cookie_bat, $cookie_indesk, time() + (86400 * 30), "/");
$cookie_pat = "SID";
setcookie($cookie_pat, $SUPassword, time() + (86400 * 30), "/");
echo "State: Done!";
}

}else {

return "F2";

}

}

function create($Database, $DataFile, $tablename){
$db = new SQLite3('$DataFile');
$db->exec("CREATE TABLE $tablename(Username TEXT INTEGER PRIMARY KEY, Password TEXT, Email TEXT)");
echo "State: Done!";
}

?>