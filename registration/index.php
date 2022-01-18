<?php
include 'formHelper.php';
$inputs = [
    [
        'type' => 'text',
        'name' => 'name',
        'placeholder' => 'Vardas'
    ],
    [
        'type' => 'text',
        'name' => 'last_name',
        'placeholder' => 'Pavarde'
    ],
    [
        'type' => 'password',
        'name' => 'password',
        'placeholder' => '*******'
    ],
    [
        'type' => 'password',
        'name' => 'password2',
        'placeholder' => '*******'
    ],
    [
        'type' => 'submit',
        'name' => 'register',
        'value' => 'Registruotis'
    ],
    [
        'type' => 'select',
        'name' => 'childrens_number',
        'options' => [0,1,2,3, '4+']
    ],
    ['type' => 'textarea',
        'name' => 'comment'

    ]

];

echo '<form action="registration.php" method="post">';

foreach ($inputs as $input){
    if($input['type'] !== 'select'){
        echo generateInput($input).'<br>';
    }else{
        echo generateSelect($input);
    }


}
echo '<textarea name="comment" rows="5" cols="40"></textarea>';
echo '</form>';
