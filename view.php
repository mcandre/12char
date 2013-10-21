<?php
include_once('header.php');
?>
<body>
<div class = 'container'>

    <!-- NAV !-->
    <?php $var = false; include_once('nav.php'); ?>
    <!-- SINGLE !-->
    <h5>A Single BitTorrent Sync</h5>
    <div class = 'row'>
    <?php
    require_once('dbhelper.php');
    $sanitizeget = (string) $_GET['id'];
    $object = findOne('_id', new MongoId($sanitizeget));
    createObject($object['_id'],$object['name'], $object['descr'], $object[0], $object['votes']);
    echo "</div>Link to share: <p class='text-error'>http://12char.com/view?id=".$object['_id']."</p>";
    //Notice row tag is closed above!
    echo"
    <div style = 'width:500px;' id='disqus_thread'></div>
    <script type='text/javascript'>
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = '12char'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href='http://disqus.com/?ref_noscript'>comments powered by Disqus.</a></noscript>
    <a href='http://disqus.com' class='dsq-brlink'>comments powered by <span class='logo-disqus'>Disqus</span></a>
    ";
    ?>
</div>
<?php include_once('footer.php'); ?>
</body>
<script src = 'jquery.js'></script>
<script type = 'text/javascript'>
	 $(document).ready(function() {
            $("gs").click(function(event) {
                window.open("getSecrets?id=" + event.target.id, "_blank", "toolbar=no,location=no,status=no,menubar=no,scrollbars=0,resizable=yes,width=360,height=480");
            });
        });

</script>
</html>

