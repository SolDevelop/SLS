<?php
if (isset($port)){

    $portop = array(
        "port"=>$port
    );

}
class Unit{
    public $Username;
    public $Password;
    public $Email;
    public $Database;
    public $DataFile;
    public $tablename;
    public $state;
    public $ip;
    public $DatabaseN;
    public $DataPW;
    public $DataUM;
    public $port;
	



    function signup($Username, $Password, $Email, $Database, $DataFile, $tablename)
    {
        if ($Database == "sqlite") {
            if (!isset($Username)) {
                $this->state = "false";
                return $this->state;


            }
            $Username = stripslashes($Username);
            $PW = stripslashes($Password);
            $Email = stripslashes($Email);
            $db = new SQLite3('$DataFile');
            $SUEmail = str_replace("@", ">", $Email);
            if ($db) {

            }
             
            $results = $db->query("SELECT * FROM $tablename");

            while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
                $ID = $row['Username'];
                $EMASSS = $row['Email'];


            }
            if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid Email";
                exit();
            }
            if ($Username == $ID) {
                echo "That Username Already Used";
                exit();

            } else if ($EMASSS == $SUEmail) {
                echo "That Email Already Used";

                exit();

            } else {

                $SUPassword = password_hash('$PW', PASSWORD_DEFAULT);
                $SUEmail = str_replace("@", ">", $Email);
                $db->exec("INSERT INTO $tablename(Username, Password, Email) VALUES('$Username', '$SUPassword', '$SUEmail')");
                $cookie_bat = "UID";
                $cookie_indesk = $Username;
                setcookie($cookie_bat, $cookie_indesk, time() + (86400 * 30), "/");
                $cookie_pat = "SID";
                setcookie($cookie_pat, $SUPassword, time() + (86400 * 30), "/");
                $db->close();
                $this->state = "done";
                return $this->state;
            }

        } else{

            $this->state = "use signupmysql";
            return $this->state;

        }

    }


    function create($Database, $DataFile, $tablename)
    {
        if (!$Database == "sqlite"){

            echo "use createmysql for mysql";
            exit();

        }else {
            $db = new SQLite3('$DataFile');
            $db->exec("CREATE TABLE $tablename(Username TEXT INTEGER PRIMARY KEY, Password TEXT, Email TEXT)");
            $this->state = "state: done";
            return $this->state;

        }

    }
    function createmysql($Database, $tablename, $DatabaseN, $DataPW, $DataUM, $ip, $portop){
        if (!$Database == "mysql"){

            echo "use create for sqlite";
           exit();

        }else {

            if (!isset($portop['port'])){

                $ports = 3306;
            }else {

                $ports = $portop['port'];

            }

            $conn = mysqli_connect($ip, $DataUM, $DataPW, $DatabaseN, $ports);
            $conn->query("CREATE TABLE $tablename(Username TEXT INTEGER PRIMARY KEY, Password TEXT, Email TEXT)");
            $conn->close();
            $this->state = "done";
            return $this->state;
        }


    }


    function check($Database, $DataFile, $tablename){
        $db = new SQLite3('$DataFile');
        $results = $db->query("SELECT * FROM $tablename");

        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $unit = $row['Username'];
            $pw = $row['Password'];
            $eme = $row['Email'];
            $em = str_replace(">", "@", $eme);

        }
        $this->state = $unit. " | " . $pw . " | " . $em;
        return $this->state;
    }
    function signupmysql($Database, $Username, $Password, $Email, $tablename, $DatabaseN, $DataPW, $DataUM, $ip, $portop){
        if (!$Database == "mysql"){

            echo "use signup for sqlite";


        }
        if (!isset($Username)) {
            $this->state = "false";
            return $this->state;


        }
		$PW = stripslashes($Password);
        if (!isset($portop['port'])){

            $ports = 3306;
        }else {

            $ports = $portop['port'];

        }

        $conn = mysqli_connect($ip, $DataUM, $DataPW, $DatabaseN, $ports);
        $SUEmail = str_replace("@", ">", $Email);
        if ($conn) {

        }

        $results = $conn->query("SELECT * FROM $tablename");

        while ($row = $results->fetch_assoc()) {
            $ID = $row['Username'];
            $EMASSS = $row['Email'];


        }
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid Email";
            exit();
        }
        if ($Username == $ID) {
            echo "That Username Already Used";
            exit();

        } else if ($EMASSS == $SUEmail) {
            echo "That Email Already Used";

            exit();

        } else {

            $SUPassword = password_hash('$PW', PASSWORD_DEFAULT);
            $SUEmail = str_replace("@", ">", $Email);
            $conn->query("INSERT INTO $tablename(Username, Password, Email) VALUES('$Username', '$SUPassword', '$SUEmail')");
            $cookie_bat = "UID";
            $cookie_indesk = $Username;
            setcookie($cookie_bat, $cookie_indesk, time() + (86400 * 30), "/");
            $cookie_pat = "SID";
            setcookie($cookie_pat, $SUPassword, time() + (86400 * 30), "/");
            $this->state = "done";
            return $this->state;
        }



    }
   function login($Username, $Password, $Database, $DataFile, $tablename){
        if (!$Database == "sqlite"){

            $this->state = "use loginmysql";
            return $this->state;

        }else {
            $db = new SQLite3('$DataFile');

            if ($db) {

            }


            $myusername = stripslashes($Username);
			
            $PW = stripslashes($Password);
            
			
			
            $query = "SELECT COUNT(*) as count FROM $tablename WHERE Username='$myusername'";
            $resultes = $db->query("SELECT Password FROM $tablename WHERE Username='$myusername'");

        while ($row = $resultes->fetchArray(SQLITE3_ASSOC)) {
            
            $checkpw = $row['Password'];
			
			
        }
		$vm = password_verify('$PW', $checkpw);
		
        $result = $db->query($query);
         if ($vm == $checkpw) {
         $passc = 1;
		 
         } else {
         $passc = 0;
		 
        }
      $row=$result->fetchArray(SQLITE3_ASSOC);
    // check for empty result
     if ($row != false) {
      $numRows = 1;
    }else {
		$numRows = 0;
	}
	
            if ($numRows == 1 && $passc == 1){
               
			   $this->state = "true";
				   return $this->state;
			  
            }else {
                $this->state = "false";
                return $this->state;
            }
        }

   }
    function loginmysql($Username, $Password, $Database, $tablename, $DatabaseN, $DataPW, $DataUM, $ip, $portop){
        if (!$Database == "mysql"){

            $this->state = "use login for sqlite";
            return $this->state;

        }else {
            if (!isset($portop['port'])){

                $ports = 3306;
            }else {

                $ports = $portop['port'];

            }

            $conn = mysqli_connect($ip, $DataUM, $DataPW, $DatabaseN, $ports);




            $myusername = stripslashes($Username);
            $mypassword = stripslashes ($Password);

            $query = "SELECT * FROM $tablename WHERE Username='$myusername' AND Password='$mypassword'";
            $result = mysqli_query($query);
            $count = mysqli_num_rows($result);

            if ($count==1){
                $this->state = "true";
                return $this->state;
            }else {
                $this->state = "false";
                return $this->state;
            }
        }

    }
}
?>