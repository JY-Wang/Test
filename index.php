
<html>
<head>
    <title>Search</title>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <style type="text/css">
        *{font-family:Tahoma, Arial, Helvetica, Sans-serif,"宋体";}
        table
        {
            margin:0px auto;
            font:Georgia 11px;
            font-size:12px;
            color:#333333;
            text-align:center;
            border-collapse:collapse;/*细线表格代码*/
        }
        table td
        {
            border:1px solid #999;/*细线表格线条颜色*/
            height:22px;
        }
        caption{text-align:center;font-size:12px;font-weight:bold;margin:0 auto;}
        tr.t1 td {background-color:#fff;}
        tr.t2 td {background-color:#eee;}
        tr.t3 td {background-color:#ccc;}
        th,tfoot tr td{font-weight:bold;text-align:center;background:#c5c5c5;}
        th{line-height:30px;height:30px;}
        tfoot tr td{background:#fff;line-height:26px;height:26px;}
        thead{border:1px solid #999;}
        thead tr td{text-align:center;}
        #page{text-align:center;float:right;}
        #page a,#page a:visited{width:60px;height:22px;line-height:22px;border:1px black solid;display:block;float:left;margin:0 3px;background:#c9c9c9;
            text-decoration:none;}
        #page a:hover{background:#c1c1c1;text-decoration:none;}
        .grayr {padding:2px;font-size:11px;background:#fff;float:right;}
        .grayr a {padding:2px 5px;margin:2px;color:#000;text-decoration:none;;border:1px #c0c0c0 solid;}
        .grayr a:hover {color:#000;border:1px orange solid;}
        .grayr a:active {color:#000;background: #99ffff}
        .grayr span.current {padding:2px 5px;font-weight:bold; margin:2px; color: #303030;background:#fff;border:1px orange solid;}
        .grayr span.disabled {padding:2px 5px;margin:2px;color:#797979;background: #c1c1c1;border:1px #c1c1c1 solid;}
        body,td,th {
            color: #000;
        }
        body {
            color: #000;
        }
    </style>
</head>
<body>
<br />
<center>
<form action="" method="post" >
    <select name="choose">
        <option value="username" selected="selected" >Query username</option>
        <option value="password">Query password</option>
        <option value="userorpass">Query both</option>
    </select>
    <input type="text" name="key" >
    <input type="submit"  value="Search">
</form>
</center>
<?php
include "config.php";
if(isset($_POST['key']))
{
    switch ($_POST['choose'])
    {
        case "username":
            $sql = "SELECT * FROM qq WHERE username LIKE '$_POST[key]%'";
            break;
        case "password":
            $sql = "SELECT * FROM qq WHERE password LIKE '$_POST[key]%'";
            break;
        case "userorpass":
            $sql = "SELECT * FROM qq WHERE username LIKE '$_POST[key]%'OR password LIKE '$_POST[key]%'";
            break;
        default:
            $sql = "SELECT * FROM qq WHERE password LIKE '$_POST[key]%'";
    }
    $conn = mysqli_connect($dbhost, $dbuser,$dbpass,$dbname);
    if(strlen($_POST['key'])>4)
    {
        if (!$conn)
        {
            die('Could not connect databases. ');
        }
        $result = $conn->query($sql);
        if (mysqli_num_rows($result)> 0)
        {
            echo "<p align='center'>Found " .mysqli_num_rows($result) ." results for <font color=red>$_POST[key]</font>.</p>";
            echo "<table border=1px solid #999; width='343'>";
            echo "<tr><th>USERNAME</th><th>PASSWORD</th><th>DATASOUCE</th></tr>";
            while ($row = $result->fetch_assoc())
            {
                $source = $conn->query("SELECT * FROM data_info WHERE endid > $row[id] AND startid < $row[id] ")->fetch_assoc();
                echo "<tr><td>" . $row["username"] ."</td><td> " . $row["password"]."</td><td>" . $source["source"] ."</td>";
            }
            echo "</table>";
        }
        else
        {
            echo "<p align='center'>Found 0 results.</p>";
        }
    }
    else
    {
        echo "<p align='center'>[".$_POST['key']."] less than 5 words.<p>";
    }
    $conn->close();
}
?>

</body>
</html>
