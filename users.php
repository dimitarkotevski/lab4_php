<?php
class User{
    private $name;
    private $surname;
    private $tel;
    private $email;
    private $address;
    private $validate;

    function __construct($name,$surname,$tel,$email,$address,$validate=0) {
        $this->name = $name;
        $this->surname = $surname;
        $this->tel = $tel;
        $this->email = $email;
        $this->address = $address;
        $this->validate=0;
    }

    // Methods
    function set_name($name) {
        $this->name = $name;
    }
    function get_name() {
        return $this->name;
    }
    function set_surname($surname) {
        $this->surname = $surname;
    }
    function get_surname() {
        return $this->surname;
    }
    function set_tel($tel) {
        $this->tel = $tel;
    }
    function get_tel() {
        return $this->tel;
    }
    function set_email($email) {
        $this->email = $email;
    }
    function get_email() {
        return $this->email;
    }
    function set_address($address) {
        $this->address = $address;
    }
    function get_address() {
        return $this->address;
    }

    function set_validate($validate) {
        $this->validate = $validate;
    }
    function get_validate() {
        return $this->validate;
    }
}



$log=fopen("log.txt","w") or die("Unable to open log.txt");
if(isset($_POST["submit"])) {
    if ($_FILES["file"]["error"] > 0) {
        fwrite($log, "Error: " . $_FILES["file"]["error"] . "<br />");
        echo "Error: " . $_FILES["file"]["error"] . "<br />";
    } elseif ($_FILES["file"]["type"] !== "text/plain") {
        fwrite($log, "File must be a .txt");
        echo "File must be a .txt";
    } else {

        $btns=fopen("btns.txt","w") or die("Unable to open btns.txt");
        $fp = fopen($_FILES['file']['tmp_name'], 'rb');
        while (($line = fgets($fp)) !== false) {
            fwrite($btns,$line);
        }







    }

}

?>
<!DOCTYPE html>
<html lang="en">
<body>

<form action="" method="post">

   <input type="submit" value="Users" name="btn_1" id="btn_1"  >
   <input type="submit" value="Validate users" name="btn_2" id="btn_2">


</form>



</body>
</html>
<?php

$btns=fopen("btns.txt","r") or die("Unable to open btns.txt");
global $users;
$users=array();
while (($line = fgets($btns)) !== false) {
    $us = explode(";", $line);
    $newUser = new User($us[0], $us[1], $us[2], $us[3], $us[4]);


    array_push($users, $newUser);


}
if (isset($_POST["btn_1"])) {
    $str = '<table>
        <thead>
        <td>Name:</td>
        <td>Surname:</td>
        <td>Phone:</td>
        <td>Email:</td>
        <td>Address:</td>
        </thead>
        <tbody>';
    foreach ($users as $user) {
        $str .= '<tr> <td>' . $user->get_name() . '</td><td>' . $user->get_surname() . '</td><td>' . $user->get_tel() . '</td><td>' . $user->get_email() . '</td><td>' . $user->get_address() . '</td></tr>';
    }
    $str .= '  </tbody>
    </table>';
    echo $str;

}
if (isset($_POST["btn_2"])) {

    foreach ($users as $user) {
        $user->set_validate(1);
        echo "Validated user with name: " . $user->get_name()."</br>";


    }

}









?>