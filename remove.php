<?php
include_once('helper.php');
if(empty($_GET['id']))
{
	setError("Deletion failed because no key was supplied");
}
else
{
	$m = new MongoClient(); // connect
	$db = $m->bitbei;
	$col = $db->posts;
	$result = $col->remove(array('deletekey' => clean($_GET['id'])), array("justOne" => true));
	if($result[n] == 0)
		setError("Your key to delete is invalid. Check your deletion url again");
	else
		setSuccess("Your post has been deleted");
}
?>