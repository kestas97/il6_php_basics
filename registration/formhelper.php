<?php
// <input type="text" name="kazkaz" placeholder="">
// <input type="password" name="password" placeholder="****">
//[
//    'type' => 'text',
//    'name' => 'name',
//    'placeholder' => 'Vardas'
//],
function generateInput($data){
    $input = '';
    $input .= '<input ';
    // <input type="text" name="name" placeholder="Vardas" >
    foreach ($data as $key => $value){
        $input .= $key.'="'.$value.'" ';
    }
    $input .= '>';
    return $input;
}
////[
////    'type' => 'select',
////    'name' => 'childrens_number',
////    'options' => [0,1,2,3, '4+']
//]
function generateSelect($data){
    $select = '';
    $select .= '<select name="'.$data['name'].'">';
    foreach ($data['options'] as $option){
        $select .= '<option value="'.$option.'">'.$option.'</option>';
    }

    $select .= '</select> ';
    return $select;
}


//<select name="childrens_count">
// <option value="0">0</option>
//</select>
