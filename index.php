<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Notebook | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <?php
     /* Initialize Session */
        session_start();

        if($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            /* Connection Variables */
            $servername = "localhost";
            $username = "root";
            $password = "";

            
            /* Connect to MySQL Server */
            $conn = new mysqli($servername, $username, $password);

            /* Check connection */
            
            if ($conn->connect_error) 
            {
                die("Connection failed: " . $conn->connect_error);
            }
            else
            {
                
                /* selecting database */
                mysqli_select_db($conn,"notebook");
                
                /* Select queries return a resultset */
                
                if ($result = mysqli_query( $conn, "SELECT * FROM OUSR WHERE userid='".$_POST['php_user']."' AND password='".$_POST['php_password']."'", MYSQLI_STORE_RESULT)) {
                   
                    
                    if(mysqli_num_rows($result) >0)
                    {
                        
                        /* getting the record */
                        foreach($result as $rows)
                        {
                            $_SESSION["fullname"] = $rows["fullname"];
                            $_SESSION["position"] = $rows["position"];
                        }

                        $_SESSION["userid"] = $_POST['php_user'];
                        
                        /* free result set */
                        $result->close();
                        
                        /* disconnect mysql connection */
                        mysqli_close($conn);
                        
                        header('location:main.php');
                        
                        
                    }
                    else
                    {
                        /* free result set */
                        $result->close();
                        header('location:500.html');
                    }
                }
            }
               
        }
    ?>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">N+</h1>

            </div>
            <h3>Welcome to Notebook+</h3>
           <form class="m-t" role="form" method="post" action="<?php  echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>">
                <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" id="php_user" name="php_user" required="">
                </div>
                <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password"  id="php_password" name="php_password" required="">
                </div>
                <input type="submit" class="btn btn-primary block full-width m-b" value="Login"></input>
            </form>
            <p class="m-t"> <small>E.C. Daughson Inc. &copy; 2016</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
