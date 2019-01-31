<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$query ="SELECT * FROM country";
$results = $db_handle->runQuery($query);
?>
<html>
<head>

<head>
<style>


.demoInputBox {padding: 10px;border: #bdbdbd 1px solid;border-radius: 4px;background-color: #FFF;width: 20%;}

</style>
<script src="jquery-3.2.1.min.js" type="text/javascript"></script>
<script>
function getState(val) {
	$.ajax({
	type: "POST",
	url: "getState.php",
	data:'country_id='+val,
	success: function(data){
		$("#state-list").html(data);
		getCity();
	}
	});
}


function getCity(val) {
	$.ajax({
	type: "POST",
	url: "getCity.php",
	data:'state_id='+val,
	success: function(data){
		$("#city-list").html(data);
	}
	});
}

</script>
</head>
<body>
<div class="frmDronpDown">
<div class="row">
<label>Country:</label><br/>
<select name="country" id="country-list" class="demoInputBox" onChange="getState(this.value);">
<option value disabled selected>Select Country</option>
<?php
foreach($results as $country) {
?>
<option value="<?php echo $country["cid"]; ?>"><?php echo $country["cname"]; ?></option>
<?php
}
?>
</select>
</div>
<div class="row">
<label>State:</label><br/>
<select name="state" id="state-list" class="demoInputBox" onChange="getCity(this.value);">
<option value="">Select State</option>
</select>
</div>
<div class="row">
<label>City:</label><br/>
<select name="city" id="city-list" class="demoInputBox">
<option value="">Select City</option>
</select>
</div>
</div>
</body>
</html>