<?php
/**
 * Created by PhpStorm.
 * User: ge
 * Date: 2015/10/14
 * Time: 16:19
 */
$host = 'localhost';
$user_name = 'root';
$password = 'root';
$conn = mysql_connect($host, $user_name, $password);
if (!$conn) {
    die("���ݿ�����ʧ��".mysql_error());
}
echo "���ݿ����ӳɹ�";
echo "<br>";
mysql_select_db('chat');
$sql='SELECT ID,USER_NAME FROM user_information';
$result = mysql_query($sql) OR die("ERROR��".mysql_error()."<br>"."����SQL���:".$sql);
?>
<html>
<head>
    <title>
        HTML����ǶPHP����.php
    </title>
</head>
<center>
    <body>
    <table width="75%" border="0" cellpadding="1" bgcolor="#faebd7">
        <tr bgcolor="#7fffd4">
            <td height="33"><div align="center"><strong>�û�ID</strong></div></td>
            <td><div align="center"><strong>�û�����</strong></div> </td>
        </tr>
        <?php
        if ($num = mysql_num_rows($result)) {
            while ($row = mysql_fetch_array($result)) {
                ?>
        <tr bgcolor="#f0ffff">
            <td height="22" align="right"><?php echo $row['ID'];?></td>
            <td height="22" ALIGN="center"><?php echo $row['USER_NAME'] ?></td>
        </tr>
        <?php
            }
        }
        mysql_close($conn);
        ?>

    </table>
    </body>
</center>
</html>
