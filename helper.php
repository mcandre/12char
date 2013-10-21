<?php
function isValid($POST) //checks that queries exist
{
    if(empty($POST['name']) || empty($POST['descr'])) //check for name and descr 
        {setError(' Form was incomplete'); return false;}
    if(empty($POST['field1'])) //check for at least 1 secret
        {setError(' Form was incomplete'); return false;}
    return true;
}
function clean($var)
{
    $var = (string) $var;
    $var = preg_replace('/[^(\x20-\x7F)]*/','', $var);
    $var = htmlspecialchars($var);
    //$var = mysql_real_escape_string($var);
    $var = strip_tags($var);
    return $var;
}
function getTags($string)
{
    preg_match_all("/(#\w+)/", $string, $matches);
    return $matches[0];
}
function stripTags($string)
{
    return preg_replace('/#([^ \r\n\t]+)/', '', $string);
}
function setError($error)
{
    session_start();
    $_SESSION['error'] = 
    "<div class='alert alert-error' id = 'alert'>
    <button onclick = 'javascript:closeError()' type='button' class='close'>&times;</button>
    <strong>ERROR</strong> ".$error."</div>
    <script>function closeError(){document.getElementById('alert').style.display = 'none';}</script>";
    header('Location: index.php');
}
function setSuccess($msg)
{
    session_start();
    $_SESSION['success'] =
    "<div class='alert alert-success' id = 'alert'>
    <button onclick = 'javascript:closeError()' type='button' class='close'>&times;</button>
    <strong>SUCCESS</strong> ".$msg."</div>
    <script>function closeError(){document.getElementById('alert').style.display = 'none';}</script>";
    header('Location: index.php');
}
?>
