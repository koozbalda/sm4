<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Kooz
 * Date: 01.02.2018
 * Time: 18:31
 */

function save_to_file($name,$email,$message){
    $date=date('d-m-Y H-i-s',time());
    $file=fopen('a.txt','a+t');
    fwrite($file,"{$name}/{$date}/{$email}/{$message};\n");
    fclose($file);

}

function forName($name)
{
    $name = trim($name);
    $arr = explode(' ', $name);
    if (count($arr) > 1) {
        $_SESSION['error']['name'] = "Поле Имя введено неверно. Допустимо только одно слово";
        return false;
    }
    if (strlen($name) < 4 || strlen($name) > 15) {
        $_SESSION['error']['name'] = "Поле Имя введено неверно, длинна должна быть больше 3х символов и менее 15";
        return false;
    }
    return true;
}
function forEmail($email)
{
    $email = trim($email);
    $arr = explode(' ', $email);
    if (strlen($email) < 6 || (count($arr) > 1)) {
        $_SESSION['error']['email'] = "Поле Email введено неверно";
        return false;
    }
    $arr = explode('@', $email);
    if (count($arr) != 2) {
        $_SESSION['error']['email'] = "Не забывай символ @";
        return false;
    }
    return true;
}
//Function from send correct data or error message in session
function session_prepared($index, $bool = true)
{
    if (!empty($_POST[$index]) && $bool) {
        $_SESSION[$index] = $_POST[$index];
        unset($_SESSION['error'][$index]);
    } else {
        if (empty($_SESSION['error'][$index])) {
            $_SESSION['error'][$index] = "Поле обязательно для заполнения";
        }
        unset($_SESSION[$index]);
    }
}

//part 1 check name
session_prepared('name', forName($_POST['name']));
//part 1 check email
session_prepared('email', forEmail($_POST['email']));

if (!empty($_POST['message'])) {
    $_SESSION['message'] = $_POST['message'];
    unset($_SESSION['error']['message']);
} else {
    $_SESSION['error']['message'] = "Поле обязательно для заполнения";
    unset($_SESSION['message']);
}

if (count($_SESSION['error']) == 0) {
    save_to_file($_SESSION['name'],$_SESSION['email'],$_SESSION['message']);
}


header('Location: /index.php');
exit();
?>

<br>
<br>
<br>
<br>
<a href="index.php">back</a>>

















