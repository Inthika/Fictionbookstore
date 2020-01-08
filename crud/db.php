<?php

// Database credentials.


function connect_db(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bookstore";

    /* Attempt to connect to MySQL database */
    $con = mysqli_connect($servername, $username, $password, $dbname);


    return $con;
}

$GLOBALS['con'] = connect_db();




function Createdb()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bookstore";

    //create connection
    $con = mysqli_connect($servername, $username, $password);

    //Check Connection
    if (!$con) {
        die("Connection Failed:" . mysqli_connect_error());
    }
//Create Database
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if (mysqli_query($con, $sql)) {
        $con = mysqli_connect($servername, $username, $password);

        //Create books table
        if (mysqli_query($con, $sql)) {
            $con = mysqli_connect($servername, $username, $password, $dbname);
            $sql1 = "CREATE TABLE IF NOT EXISTS books(
                    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    book_name VARCHAR(30)NOT NULL,
                    isbn VARCHAR(100) UNIQUE ,
                    book_author VARCHAR(30) NOT NULL,
                    published_year INT(50) ,
                    book_price FLOAT 
                    );
                    ";
        }

        if (mysqli_query($con, $sql1)) {
             return[$con];
        } else {
            echo "Cannot Create book table";
        }

//Create user Table
        if (mysqli_query($con, $sql)) {
            $con = mysqli_connect($servername, $username, $password, $dbname);
            $sql2 = "CREATE TABLE IF NOT EXISTS users (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                username VARCHAR(50) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            ); ";
        }

        if (mysqli_query($con, $sql2)) {
            return[$con];
        } else {
            echo "Cannot Create user table";
        }

// Create Categories Table
        if (mysqli_query($con, $sql)) {
            $con = mysqli_connect($servername, $username, $password, $dbname);
            $sql3 = "CREATE TABLE IF NOT EXISTS categories(
                     category VARCHAR(50) NOT NULL,
                     id VARCHAR(100) NOT NULL,  
                     book_name VARCHAR(30)NOT NULL
                     
                    );
                    ";

        }

        if (mysqli_query($con, $sql3)) {
            return[$con];
        } else {
            echo "Cannot Create catgry table";

        }


//Create Authors Table
        if (mysqli_query($con, $sql)) {
            $con = mysqli_connect($servername, $username, $password, $dbname);
            $sql4 = "CREATE TABLE IF NOT EXISTS authors(
                     book_Author VARCHAR(30) NOT NULL,
                     id VARCHAR(100) NOT NULL  
                    );
                    ";
        }

        if (mysqli_query($con, $sql4)) {
            return[$con];
        } else {
            echo "Cannot Create AUTHOR table";
        }
    }

    else {
        echo "error while creating database" . mysqli_error($con);
    }


}

