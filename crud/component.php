<?php
//input function
function inputElement($icon,$placeholder,$name,$value){
    $ele="<div class=\"input-group mb-2\">
                            <div class=\"input-group-prepend\">
                                <div class=\"input-group-text bg-primary\">$icon</i></div>
                            </div>
                            <input type=\"text\" name='$name' value='$value' autocomplete=\"off\" placeholder='$placeholder' class=\"form-control\" id=\"inlineFormInputGroup\" placeholder=\"Username\">
  </div>
   ";
    echo $ele;
}
//button function
function buttonElement($btnid,$styleclass,$text,$name,$attr){
    $btn="
    <button name='$name''$attr' class='$styleclass' id='$btnid'>$text</button>
    ";
    echo $btn;
}
//selection function
function selectElement($name){

    $ele="<select name='$name' class='select' >
            <option value=\"science\">Science</option>
            <option value=\"classics\">Classics</option>
            <option value=\"crime\">Crime</option>
            <option value=\"horror\">Horror</option>
            <option value=\"adventure\">Adventure</option>
        </select>";
    echo $ele;
}