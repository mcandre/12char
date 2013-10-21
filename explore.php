<?php
$metayes = true;
include_once('header.php');
?>
<body>
<div class = 'container'>
    <!-- NAV !-->
    <?php $var = false; include_once('nav.php'); ?>
    <!-- STUFF !-->
    <?php
    echo"
    <br>
        <div class = 'row' align = 'center'>
            <form class='form-search' method = 'GET' action = 'explore'>
              <input type='text' placeholder = 'Add # before every search term' name = 'q' class='span8 input-medium search-query'>
              <button type='submit' class='btn'>Search</button>
            </form>
        </div>
    ";
    if(!isset($_GET['q']))
    {
        include_once('dbhelper.php');
        $trending = getTrending();
        echo"
        <h5>Trending Hashtags</h5>
        <div class = 'row'>".$trending."
        </div>
        ";
    }
    else
    {
        include_once('dbhelper.php');
        $results = search($_GET['q']);
        echo "<h5>Your results for ".$_GET['q']."</h5><div class = 'row'>";
        $var = 0;
        foreach($results as $object)
        {
            createObject($object['_id'],$object['name'], $object['descr'], $object[0], $object['votes']);
            $var++;
        }
        echo "</div>";
        if($var < 3)
        {
            if($var == 0)
                echo "<p class = 'text-error'>No Results Found!</p>";
            echo "<p class = 'alert alert-text span8'>Tip: For more results try checking 
            your spelling or picking a more popular variation of your search term. <br>
            Also remember you must add a <b>#</b> before each of your search terms.</p>";
        }
    }
    ?>
</div>
<script src="jquery.js"></script>
<script type="text/javascript">
        function showSubmit()
        {
            window.location.href = 'index.php?show=1';
        }
        $(document).ready(function() {
            $("gs").click(function(event) {
                window.open("getSecrets?id=" + event.target.id, "_blank", "toolbar=no,location=no,status=no,menubar=no,scrollbars=0,resizable=yes,width=360,height=480");
            });
        });   
</script>
<?php include_once('footer.php'); ?>
<script src="disqus.js"></script>
</body>
</html>
