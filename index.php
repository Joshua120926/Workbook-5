<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Sales Data - Table</title>
        <link rel="icon" type="image/x-icon" href="https://static.wikia.nocookie.net/rain-world-game/images/f/f2/Slugcat.jpg">
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Header-->
        <header style="background: url(https://static.miraheze.org/rainworldwiki/b/bc/RW_SH_region_art.png); background-repeat: no-repeat; background-attachment: fixed; background-size: cover; background-position: center; image-rendering: auto; image-rendering: crisp-edges; image-rendering: pixelated; background-color:black"; class="masthead text-center text-white">
            <div class="masthead-content">
                <div class="container px-5">
                    <h1 class="masthead-heading mb-0">Sales Data</h1>
                    <br><br>

                    <!--   -->

                    <table class="table table-dark table-striped table-hover" id="scroll">
                        <form class="border border-light p-5" action="index.php#scroll" method="POST">
                            <p class="h4 mb-4 text-center">Enter Region</p>
                            <input type="region" id="region" name="region" class="form-control mb-4" placeholder="Region">
                            <p style="color: #FF0000">
                            <?php
                                if (isset($_SESSION["errorMessage"]))
                                {
                                    echo($_SESSION["errorMessage"]);
                                    ?>
                                    <br>
                                    <?php
                                }
                                unset($_SESSION["errorMessage"]);
                            ?>
                            </p>
                            <input type="submit" value="Submit">
                            <br><br>
                        </form>
                      <thead>
                        <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Region</th>
                          <th scope="col">Value</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            function getDBConnection() {
                                // get connection to local MySQL database
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "Joshua";

                                // Create connection
                                $conn = mysqli_connect($servername, $username, $password, $dbname);

                                // Check connection
                                if (!$conn) {
                                  die("Connection failed: " . mysqli_connect_error());
                                }
                                return $conn;
                            }

                            function getData() {
                                $conn = getDBConnection();
                                if ((isset($_POST['region'])) && $_POST['region'] != "") {
                                    $region = $_POST['region'];
                                    echo nl2br("Region: " . $region . "\n");
                                    $sql = "SELECT * FROM sales WHERE region='$region'";
                                } else {
                                    $sql = "SELECT * FROM sales";
                                }
                                $result = mysqli_query($conn,$sql);

                                if (mysqli_num_rows($result) > 0) {    
                                        while($row = mysqli_fetch_array($result)) {
                                            echo "<tr> ";
                                            echo " <td>" . $row["ID"] . "</td>";
                                            echo " <td>" . $row["Name"] . "</td>";
                                            echo " <td>" . $row["Region"] . "</td>";
                                            echo " <td>" . $row["Valued"] . "</td>";
                                            echo "</tr>\n";       // Add a newline at the end
                                        }
                                    } else {
                                        echo nl2br("0 results");
                                    }
                                mysqli_close($conn);    // remember to close db connection
                            }

                            getData()
                        ?>
                      </tbody>
                    </table>

                    <!--   -->

                </div>
            </div>
        </header>
        <!-- Footer-->
        <footer class="py-5 bg-black">
            <div class="container px-5"><p class="m-0 text-center text-white small">Copyright &copy; Joshua Rhodes 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
