<?php
$metayes = true;
include_once('header.php');
?>
<body>
<div class = 'container'>
    <!-- NAV !-->
    <?php $var = false; include_once('nav.php'); ?>
    <!-- STUFF !-->
    <h5>Popular</h5>
    <div class = 'row'>
        <?php
        include_once('dbhelper.php');
        if(!isset($_GET['num']))
            feed(-1, 15 ,'votes');
        else
            feed(-1, $_GET['num'], 'votes');
        echo "</div>"; //END ROW TAG HERE
        if(isset($_GET['num']))
            echo "<center><a class = 'btn btn-primary' href = 'popular?num=".($_GET['num'] + 15)."'>Load More</a></center><br>";
        else
            echo "<center><a class = 'btn btn-primary' href = 'popular?num=30'>Load More</a></center><br>";
        ?>
    <!-- STUFF STOP !-->
    <?php include_once('footer.php')?>
</div>
<script src="disqus.js"></script>
</body>
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
</html>
