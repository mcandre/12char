<?php
echo "
    <div class='masthead'>
        <ul class='nav nav-pills pull-right'>
          <li class = 'active'><a href = 'javascript:showSubmit()'>Submit</a></li>
          <li><a href='index'>New</a></li>
          <li><a href='popular'>Popular</a></li>
          <li><a href='explore'>Explore</a></li>
          <script>function showSubmit(){document.getElementById('submitform').style.display = 'block';}</script>
        </ul>
        <h3><a href = 'index' style = 'color: #006dcc;'>12char</a>
	&nbsp;<small class = 'muted'>Share your BitTorrent Syncs</small></h3>
    </div>
    ";
?>
