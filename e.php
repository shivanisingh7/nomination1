<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$host = "localhost";
$username = "root";
$password = ""; // Set your database password
$dbname = "nomination_db"; // Ensure the database exists

// Connect to the database
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data for "Nominating Yourself"
$sql_self = "SELECT * FROM nominations WHERE nomination = 'yourself'";
$result_self = mysqli_query($conn, $sql_self);
if (!$result_self) {
    // Debugging information for the query error
    die("Error in SQL query for 'Nominating Yourself': " . mysqli_error($conn));
}

// Fetch data for "Nominating Someone Else"
$sql_someone = "SELECT * FROM nominations WHERE nomination = 'someone_else'";
$result_someone = mysqli_query($conn, $sql_someone);
if (!$result_someone) {
    // Debugging information for the query error
    die("Error in SQL query for 'Nominating Someone Else': " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bifurcated Nominations Data</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-top: 20px;
        }
        h2 {
            color: #34495e;
            margin-bottom: 15px;
            border-bottom: 2px solid #eaeaea;
            padding-bottom: 10px;
        }
        

        /* Tab Buttons */
        .tab-buttons {
            display: flex;
            justify-content: center;
            margin: 20px 0;
            
        }
        .tab-button {
            background-color: #22b3c1;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            margin: 0 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .tab-button.active {
            background-color: #22b3c1;
        }
        .tab-button:hover {
            background-color: #1e6f99;
        }

        /* Containers */
        .container {
            max-width: 1200px;
            margin: 0 auto 30px auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: none; /* Initially hidden */
        }
        .container.active {
            display: block;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            text-align: left;
            padding: 15px;
            font-size: 14px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #22b3c1;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            th, td {
                font-size: 12px;
                padding: 10px;
            }
        }

        /* Scrollable Table */
        .scrollable {
            overflow-x: auto;
        }

        /* Message Styling */
        .no-data {
            text-align: center;
            font-size: 18px;
            color: #888;
            margin: 20px 0;
        }

        /* Links */
        a {
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .export-button {
            text-align: center;
            margin-bottom: 20px;
        }
        .export-button a {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #22b3c1;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .export-button a:hover {
            background-color: #2980b9;
        }
    </style>
    <script>
        function toggleTab(tabId) {
            // Hide all containers
            const containers = document.querySelectorAll('.container');
            containers.forEach(container => container.classList.remove('active'));

            // Remove active class from all buttons
            const buttons = document.querySelectorAll('.tab-button');
            buttons.forEach(button => button.classList.remove('active'));

            // Show the selected container and activate the corresponding button
            document.getElementById(tabId).classList.add('active');
            document.querySelector(`[data-tab="${tabId}"]`).classList.add('active');
        }
    </script>
</head>
<body>

    <div class="banner" style="text-align: center; margin-top: 20px;">
        <img src="hw.png" alt="IIIT Delhi Foundation Day Banner" style="height: 100px; width: auto;" >
    </div> 
    <h1>Alumni Nomination Form Details List</h1>

     <!-- Export to CSV Button -->
     <div class="export-button">
        <a href="export.php?type=self">Export "Nominating Yourself" to CSV</a>
        <a href="export.php?type=someone">Export "Nominating Someone Else" to CSV</a>
    </div>

    <!-- Toggle Buttons -->
    <div class="tab-buttons">
        <button class="tab-button active" data-tab="self-container" onclick="toggleTab('self-container')">Nominating Yourself</button>
        <button class="tab-button" data-tab="someone-container" onclick="toggleTab('someone-container')">Nominating Someone Else</button>
    </div>

    <!-- Nominating Yourself Section -->
    <div id="self-container" class="container active">
        <h2>Nominating Yourself</h2>
        <?php if (mysqli_num_rows($result_self) > 0): ?>
            <div class="scrollable">
                <table>
                    <thead>
                        <tr>
                            <th>Your Title</th>
                            <th>Your Name</th>
                            <th>Your Email</th>
                            <th>Your Phone</th>
                            <!-- <th>Your Role</th> -->
                            <th>Program</th>
                            <th>Graduation Year</th>
                            <th>Organisation</th>
                            <th>Designation</th>
                            <th>LinkedIn</th>
                            <th>Criteria</th>
                            <th>Testimonies File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result_self)): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['your_title']) ?></td>
                                <td><?= htmlspecialchars($row['your_name']) ?></td>
                                <td><?= htmlspecialchars($row['your_email']) ?></td>
                                <td><?= htmlspecialchars($row['your_phone']) ?></td>
                                <td><?= htmlspecialchars($row['program']) ?></td>
                                <td><?= htmlspecialchars($row['graduation_year']) ?></td>
                                <td><?= htmlspecialchars($row['organisation']) ?></td>
                                <td><?= htmlspecialchars($row['designation']) ?></td>
                                <td>
                                    <?php if (!empty($row['linkedin'])): ?>
                                        <a href="<?= htmlspecialchars($row['linkedin']) ?>" target="_blank">Click Here</a>
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    if (!empty($row['criteria'])) {
                                        $criteria_list = explode(", ", $row['criteria']);
                                        foreach ($criteria_list as $criterion) {
                                            // Optionally, map the criterion value to a user-friendly label
                                            echo htmlspecialchars($criterion) . "<br>";
                                        }
                                    } else {
                                        echo "N/A";
                                    }
                                    ?>
                                </td>
                                <td><?= htmlspecialchars($row['testimonies_file']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="no-data">No data found for self nominations.</p>
        <?php endif; ?>
    </div>

    <!-- Nominating Someone Else Section -->
    <div id="someone-container" class="container">
        <h2>Nominating Someone Else</h2>
        <?php if (mysqli_num_rows($result_someone) > 0): ?>
            <div class="scrollable">
                <table>
                    <thead>
                        <tr>
                            <th>Your Title</th>
                            <th>Your Name</th>
                            <th>Your Email</th>
                            <th>Your Phone</th>
                            <th>Your Role</th>
                            <th>Nominee Title</th>
                            <th>Nominee Name</th>
                            <th>Nominee Email</th>
                            <th>Nominee Phone</th>
                            <th>Program</th>
                            <th>Graduation Year</th>
                            <th>Organisation</th>
                            <th>Designation</th>
                            <th>LinkedIn</th>
                            <th>Nominee Documents</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result_someone)): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['your_title']) ?></td>
                                <td><?= htmlspecialchars($row['your_name']) ?></td>
                                <td><?= htmlspecialchars($row['your_email']) ?></td>
                                <td><?= htmlspecialchars($row['your_phone']) ?></td>
                                <td><?= htmlspecialchars($row['your_role']) ?></td>
                                <td><?= htmlspecialchars($row['nominee_title']) ?></td>
                                <td><?= htmlspecialchars($row['nominee_name']) ?></td>
                                <td><?= htmlspecialchars($row['nominee_email']) ?></td>
                                <td><?= htmlspecialchars($row['nominee_phone']) ?></td>
                                <td><?= htmlspecialchars($row['program']) ?></td>
                                <td><?= htmlspecialchars($row['graduation_year']) ?></td>
                                <td><?= htmlspecialchars($row['organisation']) ?></td>
                                <td><?= htmlspecialchars($row['designation']) ?></td>
                                <td>
                                    <?php if (!empty($row['linkedin'])): ?>
                                        <a href="<?= htmlspecialchars($row['linkedin']) ?>" target="_blank">Click Here</a>
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($row['nominee_documents_file']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="no-data">No data found for someone else nominations.</p>
        <?php endif; ?>
    </div>

    <?php mysqli_close($conn); ?>
</body>
</html>
