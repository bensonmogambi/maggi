<?php

// Function to sanitize user input
function sanitizeInput($input) {
    $sanitizedInput = trim($input);
    $sanitizedInput = stripslashes($sanitizedInput);
    $sanitizedInput = htmlspecialchars($sanitizedInput);
    return $sanitizedInput;
}

// Establish database connection (Replace with your own credentials)
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user's phone number from the USSD request
$phoneNumber = ""; // Replace with the actual method of retrieving the phone number

// Initialize variables
$accept = "";
$salesRep = "";
$age = "";
$gender = "";
$seasoningCube = "";
$maggiUsed = "";
$maggiDishes = "";
$dishesUsed = "";
$frequency = "";
$interested = "";
$recommendation = "";

// USSD survey loop
while (true) {
    // Check if all the questions have been answered
    if (!empty($accept) && !empty($salesRep) && !empty($age) && !empty($gender) && !empty($seasoningCube) && !empty($maggiUsed) && !empty($maggiDishes) && !empty($dishesUsed) && !empty($frequency) && !empty($interested) && !empty($recommendation)) {
        break;
    }

    // USSD menu
    if (empty($accept)) {
        echo "CON This informs you that NESTLE KENYA will only use whatever information disclosed for internal use.\n";
        echo "1: Accept\n";
        echo "2: Decline\n";
    } elseif (empty($salesRep)) {
        echo "CON SALES REPRESENTATIVE?\n";
    } elseif (empty($age)) {
        echo "CON AGE\n";
        echo "1. 21-34\n";
        echo "2. 35-49\n";
        echo "3. 50-60\n";
        echo "4. Above - 60\n";
    } elseif (empty($gender)) {
        echo "CON GENDER\n";
        echo "1: Male\n";
        echo "2: Female\n";
    } elseif (empty($seasoningCube)) {
        echo "CON WHICH SEASONING CUBE DO YOU USE?\n";
        echo "1: Knorr\n";
        echo "2: Royco\n";
        echo "3: Maggi\n";
        echo "4: Kent\n";
        echo "5: Jumbo\n";
        echo "6: Others\n";
    } elseif (empty($maggiUsed)) {
        echo "CON IN THE RECENT PAST HAVE YOU USED MAGGI?\n";
        echo "1: YES\n";
        echo "2: NO\n";
    } elseif (empty($maggiDishes)) {
        echo "CON Which dishes do you use MAGGI on?\n";
        echo "1: Meat\n";
        echo "2: Fish\n";
        echo "3: Chicken\n";
        echo "4: Other\n";
        echo "5: Not Used\n";
    } elseif (empty($dishesUsed)) {
        echo "CON WHICH DISHES HAVE/WILL YOU USE TODAY?\n";
        echo "1: Meat\n";
        echo "2: Chicken\n";
        echo "3: Vegetables\n";
        echo "4: Fish\n";
        echo "5: None\n";
        echo "6: Other\n";
    } elseif (empty($frequency)) {
        echo "CON How frequently do you use MAGGI\n";
        echo "1: Daily\n";
        echo "2: Weekly\n";
        echo "3: Monthly\n";
        echo "4: Not Used\n";
    } elseif (empty($interested)) {
        echo "CON If you don't use it, would you be interested to try MAGGI?\n";
        echo "1: YES\n";
        echo "2: NO\n";
    } elseif (empty($recommendation)) {
        echo "CON HOW LIKELY WOULD YOU RECOMMEND OUR BRAND TO YOUR FRIENDS?\n";
        echo "1: Very Likely\n";
        echo "2: Not Likely\n";
    }

    // Process user input
    $input = sanitizeInput($_GET['input']);
    
    switch ($input) {
        case "1":
            if (empty($accept)) {
                $accept = $input;
            } elseif (empty($age)) {
                $age = $input;
            } elseif (empty($gender)) {
                $gender = $input;
            } elseif (empty($seasoningCube)) {
                $seasoningCube = $input;
            } elseif (empty($maggiUsed)) {
                $maggiUsed = $input;
            } elseif (empty($maggiDishes)) {
                $maggiDishes = $input;
            } elseif (empty($dishesUsed)) {
                $dishesUsed = $input;
            } elseif (empty($frequency)) {
                $frequency = $input;
            } elseif (empty($interested)) {
                $interested = $input;
            } elseif (empty($recommendation)) {
                $recommendation = $input;
            }
            break;

        case "2":
            if (empty($accept)) {
                // End the survey
                echo "END Thank you for your response.";
                exit();
            } elseif (empty($maggiUsed)) {
                $maggiUsed = $input;
            } elseif (empty($dishesUsed)) {
                $dishesUsed = $input;
            } elseif (empty($frequency)) {
                $frequency = $input;
            } elseif (empty($interested)) {
                $interested = $input;
            } elseif (empty($recommendation)) {
                $recommendation = $input;
            }
            break;

        default:
            // Repeat the question if the input is not valid
            break;
    }
}

// Store the collected data in the database
$stmt = $conn->prepare("INSERT INTO survey_responses (phone_number, sales_rep, age, gender, seasoning_cube, maggi_used, maggi_dishes, dishes_used, frequency, interested, recommendation) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssss", $phoneNumber, $salesRep, $age, $gender, $seasoningCube, $maggiUsed, $maggiDishes, $dishesUsed, $frequency, $interested, $recommendation);
$stmt->execute();
$stmt->close();

// Thank you message
echo "END Thank you for completing the survey.";

// Close the database connection
$conn->close();

?>
