<?php
include_once('header.php');
?>
<div align = 'center'>
<h3 style = 'color: #006dcc;'>12char</h3>
<h5>Secrets</h5>
<?php
//NORMAL STUFF
require_once('dbhelper.php');
$sanitzeget = (string) $_GET['id'];
$object = findOne('_id', new MongoId($sanitzeget));
for($i = 1; $i <= $object['count']; $i++)
{
    $fieldname = "field".$i;
    echo "<block><b>".$object[$fieldname]."</b></block><br><br>";
}
session_start();
if(isset($_SESSION[$_GET['id']]))
{
	//DO NOTHING
}
else
{
	update(new MongoId($object['_id']), 'votes', ($object['votes'] + 1)); //updateHearts
	//REPORT
	if(isset($_POST['report']) && $_POST['report'] && !(isset($_SESSION['hasreported'])))
	{
		$newVotes = round($object['votes'] * .93) - 1;
		update(new MongoId($object['_id']), 'votes', $newVotes);
		$_SESSION['hasreported'] = true;
	}
	$_SESSION[$_GET['id']] = 'whee';
}	
?>
<div id = 'dw'><a href = 'javascript:doesntWork()'>Secrets Broken?</a></div><br>
<a href = 'javascript:window.close()'>Close<a/>
</div>
<script src="jquery.js"></script>
<script type="text/javascript">
function doesntWork()
{
    <?php
    $url = "getSecrets.php?id=".$_GET['id'];
    echo "$.post('".$url."', {report : true });";
    ?>
    $('#dw').html("<b>Thanks for letting us know. If these secrets don't work please try another post. Sorry.</b>");
}
</script>
</html>
