<?php
// function to check if a domain is available
function checkDomain($domain) {
    // initialize a curl session
    $ch = curl_init();
    // set the url to check the domain availability
    curl_setopt($ch, CURLOPT_URL, "https://www.whoisxmlapi.com/whoisserver/WhoisService?domainName=$domain&outputFormat=JSON");
    // set options for curl
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    // execute the curl session
    $result = curl_exec($ch);
    // decode the json response
    $result = json_decode($result, true);
    // check if the domain is available
    if ($result['ErrorMessage']) {
        return $result['ErrorMessage']['msg'];
    } else {
        return $result['WhoisRecord']['status'];
    }
}
// test the function
$domain = "example.com";
$status = checkDomain($domain);
echo $status;
