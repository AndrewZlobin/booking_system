<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=hotel', 'user', 'user');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
//    print_r($_POST['data']);
    $personal_data = strip_tags(trim($_POST['data'][0]['value']));
    $contacts = strip_tags(trim($_POST['data'][1]['value']));
    $comment = strip_tags(trim($_POST['data'][2]['value']));
    addNewBookingRequest($dbh, $personal_data, $contacts, $comment);
}

function addNewBookingRequest($dbh, $personal_data, $contacts, $comment){
    $sql = 'INSERT INTO requests (personal_data, contacts, comment) VALUES (:personal_data, :contacts, :comment)';
    $statement = $dbh->prepare($sql);
    $statement->bindValue(':personal_data', $personal_data, PDO::PARAM_STR);
    $statement->bindValue(':contacts', $contacts, PDO::PARAM_STR);
    $statement->bindValue(':comment', $comment, PDO::PARAM_STR);
    $statement->execute();
}

function getAllRequests($dbh){
    $data = $dbh->query("SELECT * FROM requests")->fetchAll(PDO::FETCH_ASSOC);

    /* Извлечение всех оставшихся строк результирующего набора */
//    print("Извлечение всех оставшихся строк результирующего набора:\n");
//    $results = $sth->fetchAll();
//    foreach ($data as $key=>$value){
//        return $key.' + '.$value;
//    }
    return $data;
}

if($_SERVER['REQUEST_URI'] ==='/contacts.php'){
    getAllRequests($dbh);
}