<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="common/js/bootstrap.min.js"></script>

	
	<script type="text/javascript" src="common/js/form/jquery.validate.min.js"></script>
	<!--<script type="text/javascript" src="recherche.js"></script>-->
	<script type="text/javascript" src="common/js/form/additional-methods.min.js"></script>
	
	<?php if($page == "maps" ): ?>
		<script src="https://maps.googleapis.com/maps/api/js?sensor=false"  type="text/javascript">    </script> 
		<!-- Google Maps -->
 </script>
		<script src="https://www.google.com/jsapi"></script>
		<script src="common/js/points.json"></script>
		<script src="common/js/maps.js"></script>
	<?php endif; ?>
	
	<script src="common/js/script.js"></script>

  </body>
</html>
