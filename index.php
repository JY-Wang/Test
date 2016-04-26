<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<title>
Search
</title>
<form action="" method="post">
    <input type="text" name="key">
    <input type="submit"  name="key" value="Search">
</form>

<?php
include "config.php";
$sql = "select * from qq WHERE username like '$_POST[key]%'";
$conn = mysqli_connect($dbhost, $dbuser,$dbpass,$dbname);
if(strlen($_POST['key'])>5)
{
    if (!$conn)
    {
    die('Could not connect: ');
    }
    $result = $conn->query($sql);
 if ($result->num_rows>0)
      {
      while($row = $result->fetch_assoc())
          {
          echo "<br> QQ: ". $row["username"]." ------- 密码". $row["password"];
          }
      }
  else
      {
      echo "0 results";
      }
  $conn->close();
}
else
{
  echo "错误";
  echo $_POST['key'];
}
?>

</html>