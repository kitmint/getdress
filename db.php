<!-- 
    $servername = "sql104.infinityfree.com";
    $username = "if0_36009817";
    $password = "skdjF6kRCxCajJ";
    $dbname = "if0_36009817_user";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    
    } -->

    <?php
    $severname = "localhost";
    $dbname = "users";
    $username = "root";
    $password = "";

    $dsn = "mysql:host=$severname; dbname=$dbname; charset=utf8";

    try{
        $conn = new PDO($dsn, $username, $password, ); //data set
        // echo "connected successfully!";
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch(PDOException $e){
        // echo "<pre>";
        // print_r ($e);
        // echo "</pre>";
        echo "failed to connected" . $e->getMessage();
    }


?>