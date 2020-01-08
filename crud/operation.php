<?php

require_once("db.php");
require_once("component.php");

//Create button click

if(isset($_POST['add'])){
    createData();
}
if(isset($_POST['update'])) {
    updateData();
}
if(isset($_POST['delete'])) {
   deleteRecord();
}
if(isset($_POST['deleteall'])) {
  deleteAll();
}

//Create Data
function createData()
{
    $bookname=textboxValue("book_name");
    $isbn=textboxValue("isbn");
    $bookauthor=textboxValue("book_author");
    $publishedyear=textboxValue("published_year");
    $bookprice=textboxValue("book_price");
    $category=selectValue("category");

    if ($bookname && $isbn && $bookauthor && $publishedyear && $bookprice) {
        $sql = "INSERT INTO books(book_name,isbn,book_author,published_year,book_price)
              VALUES('$bookname','$isbn','$bookauthor','$publishedyear','$bookprice')
              ";

        if (mysqli_query($GLOBALS['con'], $sql)) {
            TextNode("success", "Record successfully created in books table");
        } else {
            echo "unable to create records in books table";
        }
    } else {
        TextNode("error", "Provide data in the Textbox");
    }

    if ($category && $isbn && $bookname) {
     $sql = "INSERT INTO categories(category,id,book_name)
            VALUES ('$category','$isbn','$bookname')";

     if (mysqli_query($GLOBALS['con'], $sql)) {
      TextNode("success", "Record successfully updated in categories table");
     } else {
    echo "unable to create records in books table";
    }
    } else {
      TextNode("error", "Provide data in the Textbox");
     }
    if ($bookauthor && $isbn) {
        $sql = "INSERT INTO authors(book_author,id)
            VALUES ('$bookauthor','$isbn')";

        if (mysqli_query($GLOBALS['con'], $sql)) {
            TextNode("success", "Record successfully updated in authors table");
        } else {
            echo "unable to create records in authors table";
        }
    } else {
        TextNode("error", "Provide data in the Textbox");
    }
}


function textboxValue($value){
    $textbox=mysqli_real_escape_string($GLOBALS['con'],$_POST[$value]);
    if(empty($textbox)){
        return false;
    }else{
    return $textbox;
    }
}

function selectValue($value){
    $select= mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if(empty($select)){
        return false;
    }else
    {
        return $select;
    }

}


//messages
function TextNode($classname,$msg){
    $element="<h6 class='$classname'>$msg</h6>";
    echo $element;
}

//get data from mysql database
function getData(){
    $sql="SELECT*FROM books";
    $con = connect_db();
    $result=mysqli_query($con,$sql);
      return $result;

   }

//get category
function getCategory()
{
    $sql = "SELECT*FROM categories";
    $con = connect_db();
    $result = mysqli_query($con, $sql);
    return $result;
}

//get author
    function getAuthor(){
        $sql="SELECT*FROM authors";
        $con = connect_db();
        $result=mysqli_query($con,$sql);
        return $result;

}
//update data
function updateData()
{
    $bookid = textboxValue("book_id");
    $bookname = textboxValue("book_name");
    $isbn = textboxValue("isbn");
    $bookauthor = textboxValue("book_author");
    $publishedyear = textboxValue("published_year");
    $bookprice = textboxValue("book_price");
    $category = selectValue("category");
    if ($bookname && $isbn && $bookauthor && $publishedyear && $bookprice) {
        $sql = "
    UPDATE books SET book_name='$bookname',isbn='$isbn',book_author='$bookauthor',published_year='$publishedyear',book_price='$bookprice' WHERE id='$bookid'";

        if (mysqli_query($GLOBALS['con'], $sql)) {
            TextNode("success", "Data successfully edited");
        } else
            TextNode("error", "Unable to edit data");

    } else
        TextNode("error", "Select Data using edit icon");


    if ($category && $isbn && $bookname) {
        $sql = "UPDATE categories SET category='$category',book_name='$bookname' WHERE id='$isbn'";

        if (mysqli_query($GLOBALS['con'], $sql)) {
            TextNode("success", "Record successfully updated");
        } else
            echo "Unable to update records in categories table";

    } else
        TextNode("error", "Provide data in the Textbox");

    if ($bookauthor && $isbn) {
        $sql = "UPDATE authors SET book_Author='$bookauthor' WHERE id='$isbn'";

        if (mysqli_query($GLOBALS['con'], $sql)) {
            TextNode("success", "Record successfully updated");
        } else
            echo "Unable to update records in authors table";

    } else
        TextNode("error", "Provide data in the Textbox");

}

//Delete Data
function deleteRecord()
{
    $bookid = (int)textboxvalue("book_id");

    $sql = "DELETE FROM books WHERE id=$bookid";
    if (mysqli_query($GLOBALS['con'], $sql)) {
        TextNode("success", "Record Deleted Successfully...");
    } else {
        TextNode("error", "Unable to delete Record");
    }
}


//Delete All Data
function deleteBtn()
{
    $result = getData();
    $i = 0;
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $i++;
            if ($i > 2) {
                buttonElement("btn-deleteall", "btn btn-danger", "DeleteAll", "deleteall", "");
                return;
            }
        }
    }
}

function deleteAll()
{
    $sql = "DROP TABLE books";

    if (mysqli_query($GLOBALS['con'], $sql)) {
        TextNode("success", "All Records Deleted Successfully...!");
        Createdb();
    } else {
        TextNode("error", "Something Went Wrong.Record cannot be deleted...!");
    }
}

//set id to txtbox
function setID()
{
    $getid = getData();
    $id = 0;
    if ($getid) {
        while ($row = mysqli_fetch_assoc($getid)) {
            $id = $row['id'];
        }
    }
    return ($id + 1);
}

