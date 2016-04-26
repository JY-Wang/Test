
<html>
<meta charset="UTF-8">
<title>Search</title>

<body>
<form action="" method="post">
    <input type="text" name="key">
    <input type="submit"  value="Search">
</form>

<?php

include "config.php";
$conn = mysqli_connect($dbhost, $dbuser,$dbpass,$dbname);

if(isset($_POST['key']))
{
    $sql = "select * from qq WHERE username like $_POST[key]%'";
    if(strlen($_POST['key'])>4)
    {
        if (!$conn) {
            die('Could not connect: ');
        }
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                echo "<br> QQ: " . $row["username"] . " ------- 密码" . $row["password"];
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
        echo "“".$_POST['key']."”小于5个字符";
    }
}


?>


</body>
</html>
