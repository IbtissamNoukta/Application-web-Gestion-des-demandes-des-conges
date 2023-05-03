<html>
<script type="text/javascript">
	function myFunction(){
		document.getElementById('form_').submit();
	}
  
</script>
		<form id="form_" action="test.php" method="get">
				<select name="select"  id="select" onchange="myFunction()">
                	<option <?php if (isset($_GET['select']) && $_GET['select']=='Newest') {echo"selected";} ?> value="Newest" id="Newest">Newest</option>
                    <option <?php if (isset($_GET['select']) && $_GET['select']=='Popular') {echo"selected";} ?> value="Popular" id="Popular">Popular</option>
                </select>
        </form>
                                    

                                    <?php
                                    	if (isset($_GET['select'])) {
                                    		if ($_GET['select']=='Newest') {
                                    			echo"newest";
                                    		}else{
                                    			echo"popular";
                                    		}
                                    	}
                                    	$a="";
                                    	echo strlen($a);
                                    ?>


</html>