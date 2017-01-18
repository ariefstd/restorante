
<?php

	if(isset($current_page))
	{
		if($current_page != "login" && $current_page != "logout" && $current_page != "expired" && $current_page != "popup")
		{
			?>
           	 	<footer>
                	<div class="wrapper"><!--<a href="">footer note</a> 2012 &copy; copyrighted--></div>
                </footer>
            <?php
		}
	}
?>


</body>
</html>