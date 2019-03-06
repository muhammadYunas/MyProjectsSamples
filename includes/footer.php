<hr>
<footer>
    <div class="container text-center text-center-xs">
        <div class="row">
        	<div class="col-md-2">
        		<a class="navbar-brand text-muted pd-left-0" href="<?= ROOT_URL; ?>">Donation</a>
        	</div>
            <div class="col-md-8 text-center">
                <ul class="nav navbar-nav nav-center" id="footer-menu">
                    <li><a href="#">ABOUT</a></li>
                    <li><a href="#">SUPPORT</a></li>
                    <li><a href="#">TERMS OF CONDITIONS</a></li>
                    <li><a href="#">PRIVACY</a></li>
                    <li><a href="#">JOIN US</a></li>
                </ul>
            </div>
            <div class="col-md-2">
            	<div class="footer-icons navbar-right">
	                <a href="#"><i class="fa fa-facebook"></i></a>
	                <a href="#"><i class="fa fa-twitter"></i></a>
	                <a href="#"><i class="fa fa-google-plus"></i></a>
	            </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div>
                <p class="copyright text-muted"> Copyright &copy; Muhammad Younas <?= date('Y'); ?></p>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script>
	$("#registerlink").click(function(){
	    $("#loginform").slideUp();
	    $("#registerationform").slideDown();
	});

	$("#loginlink").click(function(){
	    $("#loginform").slideDown();
	    $("#registerationform").slideUp();

	});

	$("#rg").click(function(){
	    $("#loginform").slideUp();
	    $("#registerationform").slideDown();
	});
	
</script>
</body>
</html>