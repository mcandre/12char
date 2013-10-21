<?php
$m = new MongoClient(); // connect
$db = $m->bitbei;
$col = $db->posts;
//ABOVE IS CONNECTION ONLY!!!
function findOne($field, $parameter)
{
    global $col;
    return $col->findOne(array($field => $parameter));
}
function create($POST)
{
    global $col;
    unset($POST['recaptcha_challenge_field']);
    unset($POST['recaptcha_response_field']);
    $col->insert($POST);
    update(new MongoId($POST['_id']), 'votes', 0);
}
function update($id, $field, $new)
{
    global $col;
    $newdata = array('$set' => array($field => $new));
    $col->update(array('_id' => $id), $newdata);
}
function feed($dir, $num = 15, $parameter = "_id") //Default should be 1, unset
{
    global $col;
    $cursor = $col->find()->limit($num)->sort(array($parameter => $dir));
    foreach($cursor as $object)
    {
        createObject($object['_id'],$object['name'], $object['descr'], $object[0], $object['votes']);
    }
}
function createObject($id, $name, $descr, $tags, $score)
{
include_once('helper.php');
    //Cleaning
    $id = clean($id); $name = clean($name); $descr = clean($descr); $score = clean($score);  
    //Rest
	if(empty($descr))
		$descr = "<i>No Description</i>";
    $alltags = ""; //This upper part deals with turning tags into links
    foreach($tags as $tag)
    {
        $linktag = str_replace("#","%23",$tag);
        $alltags = $alltags." <a href = 'explore?q=".$linktag."'>".$tag."</a>";
    }
    echo"
    <div class = 'span4 well'>
            <strong>".$name."</strong>
            <p>
            ".$descr.$alltags."
            </p>
            <div style = 'position:absolute; bottom:4px;'>
                ".$score."   &#x2665;
                <gs><button id = '".$id."' class = 'btn btn-small btn-link' href = '#'>Get Secret(s)</button></gs>
                <a class = 'btn btn-small btn-link' href = 'view?id=".$id."#disqus_thread'></a>
            </div>
            
    </div>
    ";
}
function getTrending()
{
    global $col;
    $trending = array();
    $cursor = $col->find()->limit(17)->sort(array('_id' => -1));
    foreach($cursor as $object)
    {
        foreach($object[0] as $tag)
        {
            array_push($trending, $tag);
        }
    }
    $trending = array_unique($trending);
    $alltags = "<div class = 'span11' style = 'word-wrap: break-word;'><h5>";
    foreach($trending as $tag)
    {
        $linktag = str_replace("#","%23",$tag);
        $alltags = $alltags."&nbsp;&nbsp;<a href = 'explore?q=".$linktag."'>".$tag."</a>";
    }
    $alltags = $alltags."</div></h5>";
    return $alltags;
}
function search($q)
{
    if(empty($q))
        return array();
    include_once('helper.php');
    $alltags = getTags($q);
    if(empty($alltags))
        return array();
    global $col;
    $cursor = $col->find()->sort(array('_id' => -1));
    $matches = array();
    foreach($cursor as $obj) //going through objects
    {
        if(count($matches) > 9)    
            break;
        foreach($obj[0] as $tag) //going through objects tags
        {
			$found = false;
            foreach($alltags as $qtag)
            {
                if( strcasecmp($tag,$qtag) == 0)
				{
					array_push($matches, $obj);
					$found = true;
				}
			}
			if($found)
				break;
        }
    }
    return $matches;
}
?>
