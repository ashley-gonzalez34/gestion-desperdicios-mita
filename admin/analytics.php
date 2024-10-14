<?php
// Start output buffering and session
ob_start();
session_start();

// Include the database connection file
include("connect.php");

// Check if the user is logged in
if (empty($_SESSION['name'])) {
    header("Location: signin.php");
    exit();
}

// Ensure the database connection is established
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!-- External Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-Sf1D9yKTT5gOT1UBOZPCqPg1XqkJHG2llbjwZ7jHfRM+Oz2mLX0ZsYwrBfy6qYdMraIepOe4ECKCbtKjZ4umkQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="admin.css">

    <?php
    // Select the database
    if (!mysqli_select_db($connection, 'demo')) {
        die("Database selection failed: " . mysqli_error($connection));
    }
    ?>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <!-- <img src="images/logo.png" alt="Logo"> -->
            </div>
            <span class="logo_name">ADMIN</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li>
                    <a href="admin.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Panel de Control</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Análisis</span>
                    </a>
                </li>
                <li>
                    <a href="donate.php">
                        <i class="uil uil-heart"></i>
                        <span class="link-name">Donaciones</span>
                    </a>
                </li>
                <li>
                    <a href="feedback.php">
                        <i class="uil uil-comments"></i>
                        <span class="link-name">Comentarios</span>
                    </a>
                </li>
                <li>
                    <a href="adminprofile.php">
                        <i class="uil uil-user"></i>
                        <span class="link-name">Perfil</span>
                    </a>
                </li>
            </ul>

            <ul class="logout-mode">
                <li>
                    <a href="../logout.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Cerrar Sesión</span>
                    </a>
                </li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Modo Oscuro</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <p class="logo">Donación de <b style="color: #06C167;">Comida</b></p>
            <p class="user"></p>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-chart"></i>
                    <span class="text">Análisis</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-user"></i>
                        <span class="text">Total de usuarios</span>
                        <?php
                        $query = "SELECT COUNT(*) AS count FROM login";
                        $result = mysqli_query($connection, $query);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $userCount = htmlspecialchars($row['count'], ENT_QUOTES, 'UTF-8');
                            echo "<span class=\"number\">{$userCount}</span>";
                        } else {
                            echo "<span class=\"number\">Error</span>";
                        }
                        ?>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-comments"></i>
                        <span class="text">Comentarios</span>
                        <?php
                        $query = "SELECT COUNT(*) AS count FROM user_feedback";
                        $result = mysqli_query($connection, $query);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $feedbackCount = htmlspecialchars($row['count'], ENT_QUOTES, 'UTF-8');
                            echo "<span class=\"number\">{$feedbackCount}</span>";
                        } else {
                            echo "<span class=\"number\">Error</span>";
                        }
                        ?>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-heart"></i>
                        <span class="text">Total de donaciones</span>
                        <?php
                        $query = "SELECT COUNT(*) AS count FROM food_donations";
                        $result = mysqli_query($connection, $query);

                        if ($result) {
                            $row = mysqli_fetch_assoc($result);
                            $donationCount = htmlspecialchars($row['count'], ENT_QUOTES, 'UTF-8');
                            echo "<span class=\"number\">{$donationCount}</span>";
                        } else {
                            echo "<span class=\"number\">Error</span>";
                        }
                        ?>
                    </div>
                </div>

                <br><br>

                <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                <br>
                <canvas id="donateChart" style="width:100%;max-width:600px"></canvas>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        <?php
                        // Fetch gender counts
                        $genderQuery = "SELECT gender, COUNT(*) AS count FROM login GROUP BY gender";
                        $genderResult = mysqli_query($connection, $genderQuery);
                        $genders = ['male' => 0, 'female' => 0];
                        if ($genderResult) {
                            while ($g = mysqli_fetch_assoc($genderResult)) {
                                if (isset($genders[$g['gender']])) {
                                    $genders[$g['gender']] = (int) $g['count'];
                                }
                            }
                        }

                        // Fetch donation locations counts
                        $locations = [
                            'aguas finas' => 0,
                            'asunción mita' => 0,
                            'anguiatú' => 0,
                            'asunción grande' => 0,
                            'asuncioncita' => 0,
                            'buenos aires las crucitas' => 0,
                            'cantiada' => 0,
                            'cola de pava' => 0,
                            'el cerro blanco' => 0,
                            'el cerrón' => 0,
                            'el ciprés' => 0,
                            'el guayabo' => 0,
                            'el izote' => 0,
                            'el jicaral' => 0,
                            'el manguito' => 0,
                            'el nuevo pajonal' => 0,
                            'el pito' => 0,
                            'el platanar' => 0,
                            'el pretil' => 0,
                            'el rosario' => 0,
                            'el sauce' => 0,
                            'el sitio de las flores' => 0,
                            'el tablón san bartolo' => 0,
                            'el tamarindo' => 0,
                            'el trapiche abajo' => 0,
                            'el trapiche vargas' => 0,
                            'el tule' => 0,
                            'el ujushte' => 0,
                            'estanzuela' => 0,
                            'girones' => 0,
                            'guevara' => 0,
                            'la lagunilla' => 0,
                            'la playa del coyol' => 0,
                            'la reforma' => 0,
                            'las animas' => 0,
                            'las ceibitas' => 0,
                            'las crucitas' => 0,
                            'las fincas' => 0,
                            'las moritas' => 0,
                            'las posas' => 0,
                            'loma de chavarría' => 0,
                            'loma larga' => 0,
                            'los amates' => 0,
                            'los cerritos' => 0,
                            'los chavarría' => 0,
                            'los grijalva' => 0,
                            'los llanitos' => 0,
                            'los llanitos el tamarindo' => 0,
                            'los umaña' => 0,
                            'nueva estanzuela' => 0,
                            'paso de herrera' => 0,
                            'quebrada honda' => 0,
                            'san benito' => 0,
                            'san francisco el tamarindo' => 0,
                            'san jerónimo' => 0,
                            'san joaquín' => 0,
                            'san josé de las flores' => 0,
                            'san juan la isla' => 0,
                            'san juan las minas' => 0,
                            'san lorenzo' => 0,
                            'san matías' => 0,
                            'san miguelito' => 0,
                            'san rafael cerro blanco' => 0,
                            'san rafael el rosario' => 0,
                            'santa cruz' => 0,
                            'santa elena' => 0,
                            'shanshuh' => 0,
                            'sitio del niño' => 0,
                            'tiucal abajo' => 0,
                            'tiucal arriba' => 0,
                            'trapichito' => 0,
                            'valle nuevo' => 0
                        ];
                        
                        $locationQuery = "SELECT location, COUNT(*) AS count FROM food_donations WHERE location IN ('" . implode("','", array_keys($locations)) . "') GROUP BY location";
                        $locationResult = mysqli_query($connection, $locationQuery);
                        if ($locationResult) {
                            while ($loc = mysqli_fetch_assoc($locationResult)) {
                                $locLower = strtolower($loc['location']);
                                if (isset($locations[$locLower])) {
                                    $locations[$locLower] = (int) $loc['count'];
                                }
                            }
                        }
                        ?>

                        // Data for User Chart
                        const userLabels = ["Hombre", "Mujer"];
                        const userData = [<?php echo json_encode($genders['male']); ?>, <?php echo json_encode($genders['female']); ?>];
                        const userColors = ["#06C167", "blue"];

                        // Data for Donation Chart
                        const locationLabels = <?php echo json_encode(array_map('ucfirst', array_keys($locations))); ?>;
                        const donationData = <?php echo json_encode(array_values($locations)); ?>;
                        const donationColors = [
                            "#06C167", "blue", "red", "green", "purple", "orange", "yellow", "pink",
                            "brown", "gray", "cyan", "magenta", "lime", "teal", "indigo", "violet",
                            "maroon", "navy", "olive", "silver", "gold", "coral"
                        ];

                        // User Chart
                        new Chart("myChart", {
                            type: "bar",
                            data: {
                                labels: userLabels,
                                datasets: [{
                                    backgroundColor: userColors,
                                    data: userData
                                }]
                            },
                            options: {
                                legend: { display: false },
                                title: {
                                    display: true,
                                    text: "Detalles de usuarios"
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            callback: function(value) {if (value % 1 === 0) {return value;}}
                                        }
                                    }]
                                }
                            }
                        });

                        // Donation Chart
                        new Chart("donateChart", {
                            type: "bar",
                            data: {
                                labels: locationLabels,
                                datasets: [{
                                    backgroundColor: donationColors,
                                    data: donationData
                                }]
                            },
                            options: {
                                legend: { display: false },
                                title: {
                                    display: true,
                                    text: "Detalles de donaciones de comida por departamento"
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true,
                                            callback: function(value) {if (value % 1 === 0) {return value;}}
                                        }
                                    }]
                                }
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </section>

    <script src="admin.js" defer></script>
</body>

</html>