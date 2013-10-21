<?php
  require_once('recaptchalib.php');
  require_once('helper.php');
  $privatekey = "Your secret key";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    setError("Recaptcha was incorrect");
  } else {
    /* Your code here to handle a successful verification
    setError(" Sorry we're doing some maintenance. Should be back up soon!");
    */$post = $_POST;
    if(isValid($post)) //valid?
    {
        foreach($post as $input) //sanitization
        {
            $input = clean($input);
        }
        array_push($post, getTags($post['descr'])); //Adding Tags
		$post['ip'] = getRealIpAddr(); //Get IP
        $post['descr'] = stripTags($post['descr']); //Remove Tags
		$scramble = substr(str_shuffle(MD5(microtime())), 0, 12); //Adding a delete Key
		$post['deletekey'] = $scramble; 
        include_once('dbhelper.php'); //Ready for DB insert
        create($post);
        setSuccess("Thanks for submitting. Delete Link: <b>http://12char.com/remove?id=".$scramble."</b>");
    }
    else
    {
        setError(" Form was incomplete");
    }
  }
  //IP ADDRESS FINDER ONLY NEEDED HERE!!!
  function getRealIpAddr()
	{
	  if (!empty($_SERVER['HTTP_CLIENT_IP']))
	  //check ip from share internet
	  {
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	  }
	  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	  //to check ip is pass from proxy
	  {
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	  }
	  else
	  {
		$ip=$_SERVER['REMOTE_ADDR'];
	  }
	  return $ip;
	}
?>
