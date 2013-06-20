<?php require("auth.inc.php"); ?>
<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MineNinja</title>

<?php require('stylesheets.inc.php'); ?>

<script type="text/javascript" src="scripts/jquery.min.js"></script>
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
        	<div class="templatemo_megacontent">
            	<h2>FAQ</h2>
				 
                <div class="cleaner h20"></div>

			<h4>Whats this ?</h4>
		MineNinja is a Beaglebone based device for managing USB-based bitcoin mining devices. MineNinja runs cgminer/or bfgminer as a service on the Beaglebone and uses Anubis as its web frontend.
	Anubis "watches" your hosts by connecting to the API Port of cgminer (or bfgminer). You can easily add additional hosts to manage your whole operation using a single MineNinja.
  <div class="cleaner h20"></div>		<h4>How Do I add more hosts?</h4>
			The Connection is very simple, just add "--api-listen" (and "--api-network") to the cgminer command line and cgminer's api is enabled. Then you can simply <a href="addhost.php">add a host here.</a></td>
  <div class="cleaner h20"></div>		<h4>Something is wrong/does not work as expected.</h4>
			MineNinja and the open source software it is built on is still under heavy development.  Please visit mineninja.com for release updates.
  <div class="cleaner h20"></div>		<h4>Installation?</h4>
			MineNinja is pre-configured, just plug in your USB-based ASIC or FPGA devices to the USB ports on the MineNinja device. MineNinja runs the Angrstrom Linux distribution and is optimized for low power performance.
			Some boards will require you to ssh to the MineNinja to modprobe the USB driver and restart the cgminer service.
     
        

                
                
                
                <div class="cleaner h20"></div>
<!--                 <a href="#" class="more float_r"></a> -->
            </div>

            <div class="cleaner"></div>
		</div>

        <div class="cleaner"></div>
        </div>
    </div>
    
    <div class="cleaner"></div>

<div id="templatemo_footer_wrapper">
    <div id="templatemo_footer">
        <?php include("footer.inc.php"); ?>
        <div class="cleaner"></div>
    </div>
</div> 
  
</body>
</html>
