<?php 
    include 'layouts/session.php';
    
    // Get filter parameters
    $selectedDate = isset($_GET['selectdate']) ? $_GET['selectdate'] : 'All';
    $selectedYear = isset($_GET['selectyear']) ? $_GET['selectyear'] : 'All';
    $selectedMonth = isset($_GET['selectmonth']) ? $_GET['selectmonth'] : 0; // Default to 'All'
    
    $trash = 0;
    $unverified = 0;
    $ready = 0;
    $active = 0;
    $settled = 0;
    $delete = 0;
    
    // Base SQL query
    $sql = "
        SELECT 
            registration_status, 
            COUNT(*) AS user_count 
        FROM 
            bnr_user 
        WHERE 
            1=1"; // This ensures we can easily append additional conditions
    
    $params = [];
    $paramTypes = '';
    
    // Add date filters
    if ($selectedDate !== 'All') {
        $sql .= " AND DATE(created_date) = ?";
        $params[] = $selectedDate;
        $paramTypes .= "s";
    } else {
        if ($selectedYear !== 'All') {
            $sql .= " AND YEAR(created_date) = ?";
            $params[] = $selectedYear;
            $paramTypes .= "i";

            if ($selectedMonth != 0) { // 0 means 'All' in our context
                $sql .= " AND MONTH(created_date) = ?";
                $params[] = $selectedMonth;
                $paramTypes .= "i";
            }
        }
    }
    
    $sql .= " GROUP BY registration_status";
    
    // Prepare and execute the SQL statement
    $stmt = mysqli_prepare($link, $sql);
    
    // Bind parameters based on the selected date, year, and month
    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);
    }
    
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            if($row["registration_status"] == 'Trash') {
                $trash = $row["user_count"];
            }
            if($row["registration_status"] == 'Unverified') {
                $unverified = $row["user_count"];
            }
            if($row["registration_status"] == 'Ready') {
                $ready = $row["user_count"];
            }
            if($row["registration_status"] == 'Active') {
                $active = $row["user_count"];
            }
            if($row["registration_status"] == 'Settled') {
                $settled = $row["user_count"];
            }
            if($row["registration_status"] == 'Delete') {
                $delete = $row["user_count"];
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../assets1/img/bnr-fav.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets1/bootstrap-5.0.2/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="../assets1/css/bootstrap-datepicker.min.css"> -->
    <link rel="stylesheet" href="../assets1/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets1/css/custom.css">
</head>
<body>
    <!-- Main Container -->
    <div class="admin main-container">
        <div class="dashboardContainer-space">
            <?php include 'layouts/menu.php'; ?>
              
              <!-- =================== Dashboard Information ========================-->
              <div class="dash_container">
                <!--Section header Section -->
                <div class="item-right">
                    <div class="menus">
                        <div class="d-flex userName">
                            <a href="">Admin 
                                <span><img src="../assets1/img/logout-icon.svg" alt=""></span>
                            </a>
                        </div>
                        <div class="logout">
                            <a href="logout.php">Logout 
                                <span><i class="fa fa-sign-out" aria-hidden="true"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Section header Section -->
                <div class="dash_content">
                    <h1>User Status</h1>
                    <div class="space-between mt_30">
                        <div class="selectYear form-field">
                            <label for="yearSelect">Select by Year :</label>
                            <select id="yearSelect" class="form-select">
                            </select>
                        </div>
                        <div class="selectYear form-field">
                            <label for="monthSelect">Select by Month :</label>
                            <select id="monthSelect" class="form-select">
                            </select>
                        </div>
                        
                        <div class="selectYear form-field">
                            <label for="selectdate">Select by Date:</label>
                            <input type="date" id="selectdate" name="selectdate" class="form-select datepic" value="<?php echo $selectedDate; ?>">
                        </div>
                    </div>
                    <div class="ptb_30">
                        <div class="row w_100 m-0">
                            <div class="col-12 col-md-4 col-lg-4 p_12">
                                <div class="card-item item-1">
                                    <div class="card-content">
                                        <h6>Active</h6>
                                        <h5><?php echo $active; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4 p_12">
                                <div class="card-item item-2">
                                    <div class="card-content">
                                        <h6>Ready</h6>
                                        <h5><?php echo $ready; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4 p_12">
                                <div class="card-item item-3">
                                    <div class="card-content">
                                        <h6>Unverified</h6>
                                        <h5><?php echo $unverified; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4 p_12">
                                <div class="card-item item-4">
                                    <div class="card-content">
                                        <h6>Drop</h6>
                                        <h5><?php echo $trash; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4 p_12">
                                <div class="card-item item-5">
                                    <div class="card-content">
                                        <h6>Settled</h6>
                                        <h5><?php echo $settled; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4 p_12">
                                <div class="card-item item-6">
                                    <div class="card-content">
                                        <h6>Delete</h6>
                                        <h5><?php echo $delete; ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- User Count Status End -->

                    <!-- Chart -->
                    <div class="chart-container" style="display:none;">
                        <canvas id="myChart"></canvas>
                    </div>
                    <!-- Chart -->
                </div>
              </div>
              <!-- =================== Dashboard Information ========================-->
        </div>
    </div>
    <script src="../assets1/js/jquery-3.7.1.min.js"></script>
    <script src="../assets1/bootstrap-5.0.2/js/bootstrap.min.js"></script>
    <!-- <script src="../assets1/js/bootstrap-datepicker.min.js"></script>-->
    <script src="../assets1/js/jquery.validate.min.js"></script>
    <script src="../assets1/js/chart.min.js"></script>

    <!--<script src="../assets1/js/custom.js"></script>-->
    <script>
    $(document).on('click', function(event) {
        if (!$(event.target).closest('.userName').length && !$(event.target).closest('.logout').length) {
            $('.logout').hide();
        }
    });

    $('.userName').click(function(event){
        event.preventDefault();
        $('.logout').toggle();
    });

    //Side Nav
    let btn = document.querySelector("#menu-btn");
    let sidebar = document.querySelector(".sidebar");
    let menu_title = document.querySelector("#menu_title");

    btn.onclick = () => {
        sidebar.classList.toggle('active');

        // Toggle between fa-bars and fa-times
        if (btn.classList.contains('fa-bars')) {
            btn.classList.remove('fa-bars');
            btn.classList.add('fa-times');
            $(menu_title).text("Close")
        } else {
            btn.classList.remove('fa-times');
            btn.classList.add('fa-bars');
            $(menu_title).text("Menu")
        }
    };

    // Set minimum date to the current date
    var currentDate = new Date();
    currentDate.setFullYear(currentDate.getFullYear()); // Set to the current year
    var formattedCurrentDate = currentDate.toISOString().substr(0, 10);
    document.getElementById('selectdate').setAttribute('max', formattedCurrentDate);

    $('#selectdate').change(function() {
        var selectedDate = $('#selectdate').val();
        resetYearAndMonth();
        window.location.href = '?selectdate=' + selectedDate;
    });

    function resetYearAndMonth() {
        $('#yearSelect').val('All');
        $('#monthSelect').val(0).trigger('change'); // Trigger change event to hide months
    }

    function resetDatePicker() {
        $('#selectdate').val('');
    }

    function populateYears() {
        var currentYear = new Date().getFullYear();
        var startYear = currentYear - 10; // Adjust as needed
        var yearSelect = $('#yearSelect');

        // Add the "All" option
        yearSelect.append($('<option>', {
            value: 'All',
            text: 'All'
        }));

        for (var year = currentYear; year >= startYear; year--) {
            yearSelect.append($('<option>', {
                value: year,
                text: year
            }));
        }

        // Set the default value to "All"
        yearSelect.val('<?php echo $selectedYear; ?>');
    }

    function populateMonths() {
        var monthNames = [
            "All", "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        var monthSelect = $('#monthSelect');

        for (var month = 0; month < monthNames.length; month++) {
            monthSelect.append($('<option>', {
                value: month, // Adjust the value to make "All" option's value 0 and months 1-12
                text: monthNames[month]
            }));
        }

        // Set the default value to "All"
        monthSelect.val('<?php echo $selectedMonth; ?>');
    }

    function handleYearChange() {
        $('#yearSelect').change(function() {
            var selectedYear = $(this).val();
            var selectedMonth = $('#monthSelect').val();
            if (selectedYear === 'All') {
                $('#monthSelect').val(0);
                $('#monthSelect').find('option').not(':first').hide();
            } else {
                $('#monthSelect').find('option').show();
            }
            resetDatePicker();
            window.location.href = '?selectyear=' + selectedYear + '&selectmonth=' + selectedMonth;
        });
    }

    function handleMonthChange() {
        $('#monthSelect').change(function() {
            var selectedYear = $('#yearSelect').val();
            var selectedMonth = $(this).val();
            resetDatePicker();
            window.location.href = '?selectyear=' + selectedYear + '&selectmonth=' + selectedMonth;
        });
    }

    populateYears();
    populateMonths();
    handleYearChange();
    handleMonthChange();

    // Hide the month dropdown options except for "All" by default
    if ($('#yearSelect').val() === 'All') {
        $('#monthSelect').find('option').not(':first').hide();
    } else {
        $('#monthSelect').find('option').show();
    }

    // Chart js Code
    const Utils = {
        CHART_COLORS: {
            green: 'rgb(75, 192, 192)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            red: 'rgb(255, 99, 132)',
        }
    };

    const dataValues = [<?php echo $active; ?>, <?php echo $ready; ?>, <?php echo $unverified; ?>, <?php echo $trash; ?>, <?php echo $settled; ?>, <?php echo $delete; ?>];

    const data = {
        labels: ['Active', 'Ready', 'Unverified', 'Trash', 'Settled', 'Delete'],
        datasets: [
            {
                label: 'User',
                data: dataValues,
                backgroundColor: Object.values(Utils.CHART_COLORS),
            }
        ]
    };

    const config = {
        type: 'pie',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Registered Counts'
                }
            }
        },
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
    </script>
</body>
</html>
