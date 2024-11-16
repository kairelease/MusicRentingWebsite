<?php

# get all instrument function

function get_all_instrument($con) {
    $sql = "SELECT * FROM instrument ORDER BY id DESC";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $instrument = $stmt->fetchAll();
    } else {
        $instrument = 0;
    }

    return $instrument;
}

# get instrument by id function

function get_instrument($con, $id) {
    $sql = "SELECT * FROM instrument WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        $eachInstrument = $stmt->fetch();
    } else {
        $eachInstrument = 0;
    }

    return $eachInstrument;
}

# search instrument function

function search_instrument($con, $key) {
    # create simple search algorithm
    $key = "%{$key}%";

    $sql = "SELECT * FROM instrument WHERE title LIKE ? OR description LIKE ?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$key, $key]);

    if ($stmt->rowCount() > 0) {
        $instrument = $stmt->fetchAll();
    } else {
        $instrument = 0;
    }

    return $instrument;
}

function get_instrument_by_category($con, $id){
    $sql  = "SELECT * FROM instrument WHERE category_id=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$id]);
 
    if ($stmt->rowCount() > 0) {
        $instrument = $stmt->fetchAll();
    }else {
        $instrument = 0;
    }
 
    return $instrument;
}

function get_instrument_by_owner($con, $id){
    $sql  = "SELECT * FROM instrument WHERE owner_id=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$id]);
 
    if ($stmt->rowCount() > 0) {
         $instrument = $stmt->fetchAll();
    }else {
       $instrument = 0;
    }
 
    return $instrument;
 }