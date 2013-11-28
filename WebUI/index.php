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

<?php 
$result = $dbh->query("SELECT SUM(mhash_desired) AS maxhash FROM hosts");
$desmhash = $result->fetch(PDO::FETCH_ASSOC);
$ghashmax = $desmhash['maxhash']/1000 * 1.1;
$ghash10 = intval($ghashmax * .1);
$ghash20 = intval($ghashmax * .2);
$ghash30 = intval($ghashmax * .3);
$ghash40 = intval($ghashmax * .4);
$ghash50 = intval($ghashmax * .5);
$ghash60 = intval($ghashmax * .6);
$ghash70 = intval($ghashmax * .7);
$ghash80 = intval($ghashmax * .8);
$ghash90 = intval($ghashmax * .9);




$ticks = "0 $ghash10 $ghash20 $ghash30 $ghash40 $ghash50 $ghash60 $ghash70 $ghash80 $ghash90 $ghashmax";
$highlights = "0 $ghash30 #E90e00, $ghash30 $ghash70 #ffee00, $ghash70 $ghashmax #53df00";

echo <<<END



<canvas id="gauge1" width="250" height="250"
                data-type="canv-gauge"
                data-title="Speed"
                data-min-value="0"
                data-max-value="$ghashmax"
                data-major-ticks="$ticks"
                data-minor-ticks="2"
                data-stroke-ticks="true"
                data-units="GH/s"
                data-value-format="2.2"
                data-glow="true"
                data-animation-delay="10"
                data-animation-duration="200"
                data-animation-fn="bounce"
                data-colors-needle="#000 #f00"
                data-highlights="$highlights"
                data-value="800"
                data-onready="setInterval( function() { Gauge.Collection.get('gauge1').setValue( parseInt(document.getElementById('Speed').innerHTML)/1000);}, 1000);"
                data-colors-plate= "#242424"
                        data-colors-majorTicks= "#f5f5f5"
                        data-colors-minorTicks= "#ddd"
                        data-colors-title= "#fff"
                        data-colors-units= "#ccc"
                        data-colors-numbers="#eee"
                                ></canvas>



END;
        







?>

				</div>

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
