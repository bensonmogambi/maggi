<?php
// Read the variables sent via POST from the USSD gateway
$sessionId = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text = $_POST["text"];

if ($text == "") {    
    // This is the first request. Note how we start the response with "CON"
    $response = "CON Welcome! Please provide the following information:\n";
    $response .= "1. Customer Name\n";
    $response .= "2. Contact\n";
    $response .= "3. Age Range\n";
    $response .= "4. Gender";
} else if ($text == "1") {
    // Business logic for capturing customer name
    // You can store the customer name in a variable/database here
    $response = "CON Enter Customer Name:";
} else if ($text == "2") {
    // Business logic for capturing contact information
    // You can store the contact information in a variable/database here
    $response = "CON Enter Contact Number:";
} else if ($text == "3") {
    // Business logic for capturing age range
    $response = "CON Choose Age Range:\n";
    $response .= "1. 21-34\n";
    $response .= "2. 35-49\n";
    $response .= "3. 50-60\n";
    $response .= "4. Above 60";
} else if ($text == "4") {
    // Business logic for capturing gender
    $response = "CON Choose Gender:\n";
    $response .= "1. Male\n";
    $response .= "2. Female";
} else if ($text == "5") {
    // Business logic for capturing seasoning cube usage
    $response = "CON Which Seasoning Cube do you use?\n";
    $response .= "1. MAGGI\n";
    $response .= "2. Other";
} else if ($text == "6") {
    // Business logic for capturing awareness of MAGGI cube
    $response = "CON Have you heard of or seen MAGGI cube?\n";
    $response .= "1. Yes\n";
    $response .= "2. No\n";
    $response .= "3. N/A";
} else if ($text == "7") {
    // Business logic for capturing recent MAGGI usage
    $response = "CON In the recent past, have you used MAGGI?\n";
    $response .= "1. Yes\n";
    $response .= "2. No\n";
    $response .= "3. N/A";
} else if ($text == "8") {
    // Business logic for capturing dishes used with MAGGI
    $response = "CON Which dishes do you use MAGGI on?\n";
    $response .= "1. Meat\n";
    $response .= "2. Chicken\n";
    $response .= "3. Fish\n";
    $response .= "4. Not Used\n";
    $response .= "5. Other";
} else if ($text == "9") {
    // Business logic for capturing dishes used/will be used today
    $response = "CON Which dishes have/will you use today?\n";
    $response .= "1. Meat\n";
    $response .= "2. Chicken\n";
    $response .= "3. Fish\n";
    $response .= "4. Vegetables\n";
    $response .= "5. None\n";
    $response .= "6. Other";
} else if ($text == "10") {
    // Business logic for capturing MAGGI usage frequency
    $response = "CON How frequently do you use MAGGI?\n";
    $response .= "1. Daily\n";
    $response .= "2. Weekly\n";
    $response .= "3. Monthly\n";
    $response .= "4. Not Used";
} else if ($text == "11") {
    // Business logic for capturing interest in trying MAGGI
    $response = "CON If you don't use MAGGI, would you be interested in trying it?\n";
    $response .= "1. Yes\n";
    $response .= "2. No\n";
    $response .= "3. N/A";
} else if ($text == "12") {
    // Business logic for capturing likelihood of recommending the brand
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
}

// Send the response back to the USSD gateway
header('Content-type: text/plain');
echo $response;
?>
