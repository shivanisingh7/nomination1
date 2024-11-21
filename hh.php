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
    // $conn = new mysqli($host, $username, $password, $dbname);
    $conn = mysqli_connect($host, $username, $password, $dbname);
    
    // Check connection
    // if ($conn->connect_error) {
    //     die("Database connection failed: " . $conn->connect_error);
    // }
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
        // Sanitize and retrieve form inputs
        $nomination = $_POST['nomination'] ?? null;
        $your_title = $_POST['your_title'] ?? null;
        $your_name = $_POST['your_name'] ?? null;
        $your_email = $_POST['your_email'] ?? null;
        $your_phone = $_POST['your_phone'] ?? null;
        $your_role = $_POST['your_role'] ?? null;
    
        // Nominee details
        $nominee_title = $_POST['nominee_title'] ?? null;
        $nominee_name = $_POST['nominee_name'] ?? null;
        $nominee_email = $_POST['nominee_email'] ?? null;
        $nominee_phone = $_POST['nominee_phone'] ?? null;
    
        // Shared fields
        $program = $_POST['program'] ?? null;
        $graduation_year = $_POST['nomineeYear'] ?? null;
        $organisation = $_POST['organisation'] ?? null;
        $designation = $_POST['designation'] ?? null;
        $linkedin = $_POST['linkedin'] ?? null;
    
        // Self nomination fields
        $self_reason = $_POST['self_reason'] ?? null;
    
        // Criteria checkboxes
        // $criteria = isset($_POST['criteria']) ? implode(", ", (array) $_POST['criteria']) : null;
        $criteria = isset($_POST['criteria']) ? implode(", ", (array) $_POST['criteria']) : null;


        // $criteria = isset($_POST['criteria']) ? implode(", ", $_POST['criteria']) : null;
    
        // Criteria-specific inputs
        $accomplishments = $_POST['accomplishments'] ?? null;
        $projects = $_POST['projects'] ?? null;
        $publications = $_POST['publications'] ?? null;
        $talks = $_POST['talks'] ?? null;
        $awards = $_POST['awards'] ?? null;
        $services = $_POST['services'] ?? null;
    
        $patents = $_POST['patents'] ?? null;
        $research_projects = $_POST['research_projects'] ?? null;
        $innovation_awards = $_POST['innovation_awards'] ?? null;
    
        $impact_projects = $_POST['impact_projects'] ?? null;
        $community_work = $_POST['community_work'] ?? null;
        $alma_mater_contribution = $_POST['alma_mater_contribution'] ?? null;
        $community_awards = $_POST['community_awards'] ?? null;
    
        $leadership_initiatives = $_POST['leadership_initiatives'] ?? null;
        $ventures = $_POST['ventures'] ?? null;
        $business_usp = $_POST['business_usp'] ?? null;
        $startup_valuation = $_POST['startup_valuation'] ?? null;
        $startup_investments = $_POST['startup_investments'] ?? null;
    
        // File uploads
        $testimonies_file = null;
        if (isset($_FILES['testimonies']) && $_FILES['testimonies']['error'] == 0) {
            $testimonies_file = "uploads/" . basename($_FILES['testimonies']['name']);
            move_uploaded_file($_FILES['testimonies']['tmp_name'], $testimonies_file);
        }
    
        $nominee_documents_file = null;
        if (isset($_FILES['nominee_documents']) && $_FILES['nominee_documents']['error'] == 0) {
            $nominee_documents_file = "uploads/" . basename($_FILES['nominee_documents']['name']);
            move_uploaded_file($_FILES['nominee_documents']['tmp_name'], $nominee_documents_file);
        }
    
        // Insert into the database
        // $stmt = $conn->prepare("
        //     INSERT INTO nominations (
        //         nomination, your_title, your_name, your_email, your_phone, your_role,
        //         nominee_title, nominee_name, nominee_email, nominee_phone,
        //         program, graduation_year, organisation, designation, linkedin,
        //         self_reason, criteria,
        //         accomplishments, projects, publications, talks, awards, services,
        //         patents, research_projects, innovation_awards,
        //         impact_projects, community_work, alma_mater_contribution, community_awards,
        //         leadership_initiatives, ventures, business_usp, startup_valuation, startup_investments,
        //         testimonies_file, nominee_documents_file
        //     ) VALUES (
        //         ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        //     )
        // ");
        $sql = " INSERT INTO nominations (
                nomination, your_title, your_name, your_email, your_phone, your_role,
                nominee_title, nominee_name, nominee_email, nominee_phone,
                program, graduation_year, organisation, designation, linkedin,
                self_reason, criteria,
                accomplishments, projects, publications, talks, awards, services,
                patents, research_projects, innovation_awards,
                impact_projects, community_work, alma_mater_contribution, community_awards,
                leadership_initiatives, ventures, business_usp, startup_valuation, startup_investments,
                testimonies_file, nominee_documents_file
            ) VALUES (
                ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )
        ";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die(mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt,"sssssssssssisssssssssssssssssssssssss",
            $nomination, 
            $your_title, 
            $your_name, 
            $your_email, 
            $your_phone, 
            $your_role,
            $nominee_title, 
            $nominee_name, 
            $nominee_email, 
            $nominee_phone,
            $program, 
            $graduation_year, 
            $organisation, 
            $designation, 
            $linkedin,
            $self_reason, 
            $criteria,
            $accomplishments, 
            $projects, 
            $publications, 
            $talks, 
            $awards, 
            $services,
            $patents, 
            $research_projects, 
            $innovation_awards,
            $impact_projects, 
            $community_work, 
            $alma_mater_contribution, 
            $community_awards,
            $leadership_initiatives, 
            $ventures, 
            $business_usp, 
            $startup_valuation, 
            $startup_investments,
            $testimonies_file, 
            $nominee_documents_file
        );
        mysqli_stmt_execute($stmt);
        echo "Record saved";
    
        // $stmt->bind_param(
        //     "sssssssssssisssssssssssssssssssssssss",
        //     $nomination, 
        //     $your_title, 
        //     $your_name, 
        //     $your_email, 
        //     $your_phone, 
        //     $your_role,
        //     $nominee_title, 
        //     $nominee_name, 
        //     $nominee_email, 
        //     $nominee_phone,
        //     $program, 
        //     $graduation_year, 
        //     $organisation, 
        //     $designation, 
        //     $linkedin,
        //     $self_reason, 
        //     $criteria,
        //     $accomplishments, 
        //     $projects, 
        //     $publications, 
        //     $talks, 
        //     $awards, 
        //     $services,
        //     $patents, 
        //     $research_projects, 
        //     $innovation_awards,
        //     $impact_projects, 
        //     $community_work, 
        //     $alma_mater_contribution, 
        //     $community_awards,
        //     $leadership_initiatives, 
        //     $ventures, 
        //     $business_usp, 
        //     $startup_valuation, 
        //     $startup_investments,
        //     $testimonies_file, 
        //     $nominee_documents_file
        // );
    
        // if ($stmt->execute()) {
        //     echo "Nomination submitted successfully.";
        // } else {
        //     echo "Error: " . $stmt->error;
        // }
    
        $stmt->close();
    }
    
    // Close database connection
    $conn->close();

    
// $nomination = $_POST['nomination'] ?? null;
// // $nomination=filter_input(INPUT_POST,'nomination',FILTER_VALIDATE_INT);
// $your_title = $_POST['your_title'] ?? null;
// $your_name = $_POST['your_name'] ?? null;
// $your_email = $_POST['your_email'] ?? null;
// $your_phone = $_POST['your_phone'] ?? null;
// $your_role = $_POST['your_role'] ?? null;
// $nominee_title = $_POST['nominee_title'] ?? null;
// $nominee_name = $_POST['nominee_name'] ?? null;
// $nominee_email = $_POST['nominee_email'] ?? null;
// $nominee_phone = $_POST['nominee_phone'] ?? null;
// $program = $_POST['program'] ?? null;
// $graduation_year = $_POST['graduation_year'] ?? null;
// $organisation = $_POST['organisation'] ?? null;
// $designation = $_POST['designation'] ?? null;
// $linkedin = $_POST['linkedin'] ?? null;
// $self_reason = $_POST['self_reason'] ?? null;
// $criteria = $_POST['criteria'] ?? null;
// $accomplishments = $_POST['accomplishments'] ?? null;
// $projects = $_POST['projects'] ?? null;
// $publications = $_POST['publications'] ?? null;
// $talks = $_POST['talks'] ?? null;
// $awards = $_POST['awards'] ?? null;
// $services = $_POST['services'] ?? null;
// $patents = $_POST['patents'] ?? null;
// $research_projects = $_POST['research_projects'] ?? null;
// $innovation_awards = $_POST['innovation_awards'] ?? null;
// $impact_projects = $_POST['impact_projects'] ?? null;
// $community_work = $_POST['community_work'] ?? null;
// $alma_mater_contribution = $_POST['alma_mater_contribution'] ?? null;
// $community_awards = $_POST['community_awards'] ?? null;
// $leadership_initiatives = $_POST['leadership_initiatives'] ?? null;
// $ventures = $_POST['ventures'] ?? null;
// $business_usp = $_POST['business_usp'] ?? null;
// $startup_valuation = $_POST['startup_valuation'] ?? null;
// $startup_investments = $_POST['startup_investments'] ?? null;
// $testimonies_file = $_FILES['testimonies_file']['name'] ?? null;
// $nominee_documents_file = $_FILES['nominee_documents_file']['name'] ?? null;

// var_dump([
//     "nomination" => $nomination,
//     "your_title" => $your_title,
//     "your_name" => $your_name,
//     "your_email" => $your_email,
//     "your_phone" => $your_phone,
//     "your_role" => $your_role,
//     "nominee_title" => $nominee_title,
//     "nominee_name" => $nominee_name,
//     "nominee_email" => $nominee_email,
//     "nominee_phone" => $nominee_phone,
//     "program" => $program,
//     "graduation_year" => $graduation_year,
//     "organisation" => $organisation,
//     "designation" => $designation,
//     "linkedin" => $linkedin,
//     "self_reason" => $self_reason,
//     "criteria" => $criteria,
//     "accomplishments" => $accomplishments,
//     "projects" => $projects,
//     "publications" => $publications,
//     "talks" => $talks,
//     "awards" => $awards,
//     "services" => $services,
//     "patents" => $patents,
//     "research_projects" => $research_projects,
//     "innovation_awards" => $innovation_awards,
//     "impact_projects" => $impact_projects,
//     "community_work" => $community_work,
//     "alma_mater_contribution" => $alma_mater_contribution,
//     "community_awards" => $community_awards,
//     "leadership_initiatives" => $leadership_initiatives,
//     "ventures" => $ventures,
//     "business_usp" => $business_usp,
//     "startup_valuation" => $startup_valuation,
//     "startup_investments" => $startup_investments,
//     "testimonies_file" => $testimonies_file,
//     "nominee_documents_file" => $nominee_documents_file,
// ]);
?>



