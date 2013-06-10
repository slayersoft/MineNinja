<?php
require("auth.inc.php");
require("config.inc.php");
require("func.inc.php");


$dbh = anubis_db_connect();

$result = $dbh->query($show_tables);
db_error();

while ($row = $result->fetch(PDO::FETCH_NUM))
{
    if ($row[0] == "configuration")
    	$gotconfigtbl = 1;
    if ($row[0] == "hosts")
    	$gothoststbl = 1;    	
}

if (!isset($gotconfigtbl))
	include("configtbl.sql.php");

if (!isset($gothoststbl))
	include("hoststbl.sql.php");


$config = get_config_data();

?>
<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MineNinja</title>

<?php require('stylesheets.inc.php'); ?>

<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/gauge.min.js"></script>
<script type="text/javascript" src="scripts/ddsmoothmenu.js">


/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>


<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "templatemo_menu", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})


</script>

</head>
<body>

<div id="templatemo_wrapper">

<?php include ('header.inc.php'); ?>
    
    <div id="templatemo_main">
	<div class="col_fw">
        <div id="theticker" style="float:left;">
        <h3>MtGox USD/BTC</h3>
        <h2><span style="color:#242424" id="result"></span></h2></div>
        <div id="thegauges">
    	<canvas id="gauge1" width="250" height="250"
		data-type="canv-gauge"
		data-title="Speed"
		data-min-value="0"
		data-max-value="10"
		data-major-ticks="0 1 2 3 4 5 6 7 8 9 10"
		data-minor-ticks="2"
		data-stroke-ticks="true"
		data-units="GH/s"
		data-value-format="2.2"
		data-glow="true"
		data-animation-delay="10"
		data-animation-duration="200"
		data-animation-fn="bounce"
		data-colors-needle="#000 #f00"
		data-highlights="0 3 #E90e00, 3 7 #ffee00, 7 10 #53df00"
                data-value="800"
		data-onready="setInterval( function() { Gauge.Collection.get('gauge1').setValue( parseInt(document.getElementById('Speed').innerHTML)/1000);}, 1000);"
		data-colors-plate= "#242424"
			data-colors-majorTicks= "#f5f5f5"
			data-colors-minorTicks= "#ddd"
			data-colors-title= "#fff"
			data-colors-units= "#ccc"
			data-colors-numbers="#eee"
				></canvas></div>

  <div class="cleaner h20"></div>
		<h2>Hosts</h2>
					 <a href="allgpus.php"><span class="button">Expand All</span></a>
			<div class="cleaner h20"></div>

	<?php


	$result = $dbh->query("SELECT * FROM hosts ORDER BY name ASC");
	if ($result)
	{
	    echo "<table id=\"hostsummary\" summary=\"Hostsummary\" class=\"acuity\">";
	    echo create_host_header();
		while ($host_data = $result->fetch(PDO::FETCH_ASSOC)) {
		echo get_host_summary($host_data);
	}
    echo create_totals();
    echo "</table>";
}
else 
{
	echo "No Hosts found, you might like to <a href=\"addhost.php\">add a host</a> ?<BR>";
}

?>

                <div style="text-align:center"><a href="addhost.php"><span class="button">Add host</span></a></div>

                
                <div class="cleaner h20"></div>
<!--                 <a href="#" class="more float_r"></a> -->
            </div>

		</div>

        </div>
    </div>

<div id="templatemo_footer_wrapper">
        <?php include("footer.inc.php"); ?>
        <div class="cleaner"></div>
</div> 

<script>
$(function() {
  setInterval(update, 1000 * <?php echo $config->updatetime ?>);
});

function update() {
	$('#hostsummary').load('refresh_hosts.php');
}

var result = document.querySelector('#result'),
    socket = new WebSocket('ws://websocket.mtgox.com:80/mtgox?Channel=ticker'),
    json;

socket.onmessage = function(event) {
  json = JSON.parse(event.data);
  result.innerText = json.ticker.last.display;
};
</script>
  
</body>
</html>
