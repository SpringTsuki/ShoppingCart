<?PHP
function generate_code($length = 4) {
    return rand(pow(10,($length-1)), pow(10,$length)-1);
}
    $test = generate_code();
    echo $test;
?>

