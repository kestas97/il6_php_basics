<?php

$text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sodales dictum urna sit amet mattis. Ut et dui euismod, placerat lacus eget, consectetur leo. Nulla vel semper turpis, ut tempus nisi. Nunc pulvinar nisl magna. In vehicula leo at sapien iaculis, et efficitur turpis aliquam. Proin finibus finibus consequat. Nam auctor tincidunt nunc, sit amet molestie dui consequat ut. Curabitur convallis augue vel consequat sagittis. Mauris ut aliquam neque. Aliquam ultrices placerat nibh nec efficitur. Vestibulum tristique, urna ac semper ullamcorper, nunc eros viverra leo, non ultrices lectus massa sed purus. Nam ut tempus nisl.
Integer nec eleifend arcu, et feugiat eros. Morbi porttitor commodo quam, bibendum commodo est dapibus sit amet. Fusce sit amet placerat nibh. Pellentesque non orci pharetra, tempor magna non, tincidunt velit. Maecenas laoreet nulla vel quam finibus tempus. Vivamus ornare mollis ex tempor imperdiet. Nulla iaculis semper posuere. Nam vitae sapien nec nisl pellentesque tempus eget vel magna. Proin tempus gravida felis, vitae laoreet libero rutrum vel.
Suspendisse sit amet placerat neque. Cras sodales metus nec ante aliquet placerat. Integer at nibh vitae felis gravida dapibus. Maecenas orci libero, tincidunt vel maximus vitae, laoreet id metus. Suspendisse potenti. Sed in tortor vitae tellus egestas mattis. Aliquam scelerisque sed massa ut facilisis. Integer dapibus dui mauris, id scelerisque sem facilisis sit amet. Curabitur mattis purus id orci eleifend posuere. Aliquam condimentum vehicula ex. Nulla ornare consequat mattis. Donec sit amet cursus augue. Vivamus finibus volutpat elit, in bibendum justo egestas ac. In vitae dictum orci.
Suspendisse potenti. Etiam sit amet libero justo. Maecenas et euismod sapien. Duis nibh metus, gravida at placerat a, porta a magna. Cras turpis mi, euismod quis placerat in, mattis sed sapien. Duis vel elementum velit, non tincidunt massa. Etiam sed ex vel velit molestie condimentum ut blandit enim. Pellentesque magna neque, aliquet sit amet tincidunt porttitor, porta sit amet purus. Donec accumsan nisi ex. Sed vitae ullamcorper metus. Integer sagittis fermentum nunc. Nam quam ex, semper quis sem ac, vehicula iaculis ex. Aliquam eget nunc venenatis, lobortis mi et, posuere erat.
Praesent ac ante quis ipsum cursus vehicula et in est. Vestibulum vitae justo et metus placerat aliquet vitae eu leo. Sed faucibus elit posuere nunc vulputate, id semper odio volutpat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vitae ultricies dui. Etiam volutpat magna nec nisi hendrerit, ut interdum risus tincidunt. Donec vel urna metus. Nunc tincidunt vehicula malesuada. Cras scelerisque augue massa, at facilisis felis posuere sed. Sed blandit urna non lectus mattis, ut posuere ex dictum. Donec sed eleifend erat, congue tempus enim. Nullam nunc urna, tempor in mi eu, porttitor euismod mauris. Etiam vestibulum erat ipsum, eu consequat odio lacinia et. Fusce ligula massa, pulvinar vel magna et, posuere malesuada erat.';

$text = strtolower($text);
$text = str_replace([',','.',''], '', $text);
$textArray = str_split($text);
$lettersArray = [];
foreach ($textArray as $letter){
    if (isset($lettersArray[$letter])){
        $lettersArray[$letter] ++;

    }else{
        $lettersArray[$letter] = 1;
    }

}

$maxLetterCount = '';
$minLetterCount = '';
$max = 0;
$min = 9999;
echo '<pre>';
print_r($lettersArray);

foreach ($lettersArray as $key => $value) {
    if ($value > $max){
        $max = $value;
        $maxLetterCount = $key;
    }
    if ($value < $min){
        $min = $value;
        $minLetterCount = $key;
    }
}
echo $maxLetterCount;
echo $minLetterCount;