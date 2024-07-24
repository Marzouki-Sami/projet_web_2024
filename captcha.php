<?php
//creat a function that genarate a captcha and inserted into the textbox with the name captcha in login.php
function captcha(){
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    $str = "";
    for($i=0;$i<8;$i++){
        $str .= $chars[rand(0,$size-1)];
    }
    return $str;
}
echo'<div><form name="fcaptcha" method="post" action="captcha.php"><label for="captcha">Captcha:</label><br><input type="text" name="captcha" id="captcha" value="'.captcha().'"/><br><button type="button" name="submit" value="refresh" onclick="'.captcha().'"</button></form></div>';
?>