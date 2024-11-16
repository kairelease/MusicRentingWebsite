<?php

# get all owner function

function get_all_owner($con) {
    $sql = "SELECT * FROM owner";
    $stmt = $con->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $owner = $stmt->fetchAll();
    } else {
        $owner = 0;
    }

    return $owner;
}

# get owner by id function

function get_owner($con, $id) {
    $sql = "SELECT * FROM owner WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        $eachOwner = $stmt->fetch();
    } else {
        $eachOwner = 0;
    }

    return $eachOwner;
}