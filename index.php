<?php
$metayes = true;
include_once('header.php');
?>
<body>
<div class = 'container'>
    <!-- ERRORS !-->
    <?php
    session_start();
    if(isset($_SESSION['error'])) //Print any failures
    {   
        echo $_SESSION['error']; 
    }
    if(isset($_SESSION['success'])) //Print any successes
    {   
        echo $_SESSION['success'];  
    }
    unset($_SESSION['error']);
    unset($_SESSION['success']);
    ?>
    <!-- NAV !-->
    <?php $var = true; include_once('nav.php'); ?>
    
    <!-- FORM !-->
    <form id = 'submitform' <?php if(!isset($_GET['show'])){echo "style = 'display:none;'";}?> action = 'verify' method = 'POST'>
        <div class = 'row' align = 'center'>
            <div class="control-group" id="fields">
                   <input type="hidden" id = 'count' name="count" value="1" />
                   <input type="hidden" id = 'votes' name="votes" value="-1" />
                   <br>
                   <label><b>Name</b></label>
                   <input placeholder = 'Required' class="span4" type = 'text' name = 'name' maxlength = '36'></input>
                   <label><b>Description</b></label>
                   <textarea name = 'descr' placeholder = 'Tag with #. Include at least one tag or a description.' class = 'span4' rows = '4' maxlength = '150'></textarea>
                   <label class="control-label" for="field1"><b>Secrets</b></label>
                   <div class="controls" id="profs"> 
                     <div class="input-append">
                       <input maxlength = '33' placeholder = '+ to add more than one' autocomplete="off" class="span4" id="field1" name="field1" type="text" data-provide="typeahead" data-items="8" data-source='["Aardvark","Beatlejuice","Capricorn","Deathmaul","Epic"]'/><button id="b1" onClick="addFormField()" class="btn btn-info" type="button">+</button>
                     </div>
                     <!-- CAPTCHA !-->
                     <?php 
                     require_once('recaptchalib.php');
                     $publickey = "6LfKpeASAAAAADcCWbAIKHWIgkprJNCAaUim7dgh"; 
                     echo recaptcha_get_html($publickey);
                     ?>
                   </div>
            </div>    
            <input value = 'submit' type = 'submit' class = 'btn btn-primary'></input>
        </div>
    </form>
    <!-- STUFF !-->
    <h5>Recent Submissions</h5>
    <div class = 'row'>
        <?php
        include_once('dbhelper.php');
        if(!isset($_GET['num']))
            feed(-1);
        else
            feed(-1, $_GET['num']);
        echo "</div>"; //END ROW TAG HERE
        if(isset($_GET['num']))
            echo "<center><a class = 'btn btn-primary' href = 'index?num=".($_GET['num'] + 15)."'>Load More</a></center><br>";
        else
            echo "<center><a class = 'btn btn-primary' href = 'index?num=30'>Load More</a></center><br>";
        ?>
    <!-- STUFF STOP !-->
    <?php include_once('footer.php')?>
</div>
<script src="disqus.js"></script>
</body>
<script src="jquery.js"></script>
<script type="text/javascript">
        var next = 1;
        function addFormField(){
            
            var addto = "#field" + next;
	        next = next + 1;
            if(next > 10)
                return;
            var newIn = '<br /><br /><input autocomplete="off" class="span4" id="field' + next + '" name="field' + next + '" type="text" data-provide="typeahead" data-items="8">';
            var newInput = $(newIn);
	        $(addto).after(newInput);
            $("#field" + next).attr('data-source',$(addto).attr('data-source'));
            $("#count").val(next);  
        }
        $(document).ready(function() {
            $("gs").click(function(event) {
                window.open("getSecrets?id=" + event.target.id, "_blank", "toolbar=no,location=no,status=no,menubar=no,scrollbars=0,resizable=yes,width=360,height=480");
            });
        });
</script>
</html>
