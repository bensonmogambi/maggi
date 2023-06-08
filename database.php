<?php
// Read the variables sent via POST from the USSD gateway
$sessionId = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text = $_POST["text"];

// Variables to store collected data
$customerName = "";
$contact = "";
$ageRange = "";
$gender = "";
$seasoningCube = "";
$maggiAwareness = "";
$recentMaggiUsage = "";
$dishesWithMaggi = "";
$dishesToday = "";
$maggiUsageFrequency = "";
$interestedInTryingMaggi = "";
$likelihoodOfRecommendation = "";

// Check the value of the text parameter to determine the stage and collect data
switch ($text) {
    case "1":
        // Collect Customer Name
        $response = "CON Enter Customer Name:";
        break;
    case "2":
        // Collect Contact
        $response = "CON Enter Contact Number:";
        break;
    case "3":
        // Collect Age Range
        $response = "CON Choose Age Range:\n";
        $response .= "1. 21-34\n";
        $response .= "2. 35-49\n";
        $response .= "3. 50-60\n";
        $response .= "4. Above 60";
        break;
    case "4":
        // Collect Gender
        $response = "CON Choose Gender:\n";
        $response .= "1. Male\n";
        $response .= "2. Female";
        break;
    case "5":
        // Collect Seasoning Cube Usage
        $response = "CON Which Seasoning Cube do you use?\n";
        $response .= "1. MAGGI\n";
        $response .= "2. Other";
        break;
    case "6":
        // Collect MAGGI Awareness
        $response = "CON Have you heard of or seen MAGGI cube?\n";
        $response .= "1. Yes\n";
        $response .= "2. No\n";
        $response .= "3. N/A";
        break;
    case "7":
        // Collect Recent MAGGI Usage
        $response = "CON In the recent past, have you used MAGGI?\n";
        $response .= "1. Yes\n";
        $response .= "2. No\n";
        $response .= "3. N/A";
        break;
    case "8":
        // Collect Dishes with MAGGI
        $response = "CON Which dishes do you use MAGGI on?\n";
        $response .= "1. Meat\n";
        $response .= "2. Chicken\n";
        $response .= "3. Fish\n";
        $response .= "4. Not Used\n";
        $response .= "5. Other";
        break;
    case "9":
        // Collect Dishes Today
        $response = "CON Which dishes have/will you use today?\n";
        $response .= "1. Meat\n";
        $response .= "2. Chicken\n";
        $response .= "3. Fish\n";
        $response .= "4. Vegetables\n";
        $response .= "5. None\n";
        $response .= "6. Other";
        break;
    case "10":
        // Collect MAGGI Usage Frequency
        $response = "CON How frequently do you use MAGGI?\n";
        $response .= "1. Daily\n";
        $response .= "2. Weekly\n";
        $response .= "3. Monthly\n";
        $response .= "4. Not Used";
        break;
    case "11":
        // Collect Interest in Trying MAGGI
        $response = "CON If you don't use MAGGI, would you be interested in trying it?\n";
        $response .= "1. Yes\n";
        $response .= "2. No\n";
        $response .= "3. N/A";
        break;
    case "12":
        // Collect Likelihood of Recommendation
        $response = "CON How likely is it that you would recommend our brand to friends?\n";
        $response .= "1. Not Likely\n";
        $response .= "2. 1\n";
        $response .= "3. 2\n";
        $response .= "4. 3\n";
        $response .= "5. 4\n";
        $response .= "6. 5\n";
        $response .= "7. 6\n";
        $response .= "8. 7\n";
        $response .= "9. 8\n";
        $response .= "10. 9\n";
        $response .= "11. Very Likely";
        break;
    default:
        // Store the collected data
        $customerName = $text; // Assuming customer name is collected in the first stage
        $contact = $text; // Assuming contact is collected in the second stage
        
        // You can continue storing the data for each stage in the corresponding variables
        
        // End the USSD session
        $response = "END Thank you for providing the information.";
        break;
}

// Send the response back to the USSD gateway
header('Content-type: text/plain');
echo $response;

// You can now process the collected data as per your requirement,
// such as storing it in variables or a database.
?>
