<?php
session_start();
//setcookie('a','zzz',time()+100);
/**
 * Created by PhpStorm.
 * User: Kooz
 * Date: 01.02.2018
 * Time: 18:31
 */


echo '<h2 align="center" style="color: #ff245c">Занятие №10.GET. </h2><br/><br/>';
//var_dump($_COOKIE['a']);

//$file=fopen('a.txt','a+t');
//fwrite($file,"hello\nhello");
//fclose($file);

//$file=fopen('a.txt','r+t');
//while(!feof($file)){
//    echo fread($file,1).'<br>';
//}
//fseek( $file,3);
//echo fread($file,1).'<br>';
//fclose($file);
//
//

function getFileData()
{
    $result = array();
    if (file_exists('a.txt')) {
        $str = file_get_contents('a.txt');
        if (filesize('a.txt') != 0) {
            $arr = explode(';', $str);
        }

        foreach ($arr as $value) {
            $arrr = explode('/', $value);
            if (!empty($arrr[1])) {

                $result[] = $arrr;
            }
//                   $result[]['name']= $arrr[0];
//                   $result[]['email']= $arrr[1];
//                   $result[]['date']= $arrr[2];
//                   $result[]['message']= $arrr[3];
        }
        array_reverse($result);
        return array_reverse($result);
    }
}

;

//function mysort($data){
//    for($i=0;$i<a)$data as $value)
//}
//file_put_contents('c.txt',"hello\r\nhello");
//
//echo file_get_contents('c.txt');
//
//echo file_exists('c.txt');
//
//echo filesize('c.txt');
//
//rename('c.txt','b.txt');// rename and remove
//
//unlink('b.txt');
//
//var_dump(__DIR__);


//var_dump($_SESSION);

?>

<form action="/form.php" method="post">
    <br>
    <label>Name</label>
    <br>
    <input class="form-control" id="name" type="text" name="name" placeholder="Name" required
           value="<?= !empty($_SESSION['name']) ? $_SESSION['name'] : ''; ?>"/>
    <br>
    <?php
    if (!empty($_SESSION['error']['name'])) {
        echo '<span style="color:red;">' . $_SESSION['error']['name'] . '</span>';
    }
    ?>
    <br>
    <label>Email</label>
    <br>
    <input class="form-control" id="email" type="text" name="email" placeholder="email" required
           value="<?= !empty($_SESSION['email']) ? $_SESSION['email'] : ''; ?>"/>
    <br>
    <?php
    if (!empty($_SESSION['error']['email'])) {
        echo '<span style="color:red;">' . $_SESSION['error']['email'] . '</span>';
    }
    ?>

    <br>
    <label for="message">Message</label>
    <br>
    <textarea class="form-control" id="message"
              name="message"><?= !empty($_SESSION['message']) ? $_SESSION['message'] : 'THis is first comment' ?></textarea>
    <br>
    <?php
    if (!empty($_SESSION['error']['message'])) {
        echo '<span style="color:red;">' . $_SESSION['error']['message'] . '</span>';
    }
    ?>

    <br>
    <input id="my_s" class="btn btn-block btn-success " type="submit" value="Send"/><br/>
</form>
<style>
    #my_table {
        border: 3px solid #000000;

    }

    #my_table td {
        border: 3px solid #4758ff;
    }
</style>
<?php
if(count(getFileData())>0){
?>
<table cellspacing="0" id="my_table">
    <caption>Коментарии</caption>
    <tbody>


    <tr style="background-color: forestgreen">
        <td>Дата/время создания</td>
        <td>Имя</td>
        <td>Емейл</td>
        <td>Коментарий</td>
    </tr>
    <?php
        foreach (getFileData() as $value) {
        echo "<tr>";
        echo '<td>' . $value[1], '</td>';
        echo '<td>' . $value[0], '</td>';
        echo '<td>' . $value[2], '</td>';
        echo '<td>' . $value[3], '</td>';
        echo "</tr>";
    }
    }?>
    </tbody>
</table>


