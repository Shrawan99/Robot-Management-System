<?php
/**
 * Basic Interface View
 *
 * The basic interface displays a camera feed and keyboard teleop.
 *
 * @author		Russell Toris - rctoris@wpi.edu
 * @copyright	2014 Worcester Polytechnic Institute
 * @link		https://github.com/WPI-RAIL/rms
 * @since		RMS v 2.0.0
 * @version		2.0.9
 * @package		app.View.BasicInterface
 */
?>

<?php
// setup the main ROS connection and any study information
if($environment['Rosbridge']['host']) {
	echo $this->Rms->ros($environment['Rosbridge']['uri'], $environment['Rosbridge']['rosauth']);
}
echo $this->Rms->initStudy();
?>

<script>
	RMS.logString('start', 'User has connected.');
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<section class="wrapper style4 container">
	<div class="content center">
		<section>
			<header>
 
				<p>Use the <strong>W, A, S, D, Q, E</strong> keys or<strong>Button </strong> to drive your robot.</p>
<button id="forward" class="button" style="border:none;" > <img src="http://www.clker.com/cliparts/3/f/4/a/1195423523162201924kuba_arrow_button_set_3.svg.med.png" width="60" height="60"> </button><br/>
              <script>
       document.getElementById("forward").addEventListener("click", function(){ this.style.backgroundColor = "red";});
                 </script>	

			<button id="left" class="button" style="border:none;"> <img src="http://www.wpclipart.com/signs_symbol/button/metal_buttons/arrow_button_metal_blue_left.png" width="60" height="60"> </button>
              <script>
                    document.getElementById("left").addEventListener("click", function(){this.style.backgroundColor = "red";});
                 </script>	
             <button id="right" class="button" style="border:none;"> <img src="http://www.wpclipart.com/signs_symbol/button/metal_buttons/arrow_button_metal_blue_right.png" width="60" height="60"></button></br>
               <script>
                     $("#right").click(function(){ var e = jQuery.Event("keypress"); 
						e.which = 65; 
						e.keyCode = 65; 
						$("input").trigger(e); });
                 </script>	


            <button id="down" class="button" style="border:none;"> <img src="http://www.clker.com/cliparts/1/e/f/1/11954239071227223603kuba_arrow_button_set_4.svg.med.png" width="60" height="60"> </button></br>
              	<script>
                     document.getElementById("down").addEventListener("click", function(){
    this.style.backgroundColor = "red";});

            </script>	  	
			</header>
			<div class="row">
				<section class="6u stream">
					<?php if($environment['Mjpeg']['host']): ?>
						<?php if(count($environment['Stream']) > 0): ?>
							<?php
							echo $this->Rms->mjpegStream(
								$environment['Mjpeg']['host'],
								$environment['Mjpeg']['port'],
								$environment['Stream'][0]['topic'],
								$environment['Stream'][0]
							);
							?>
						<?php else: ?>
							<h2>No Associated MJPEG Streams Found</h2>
						<?php endif; ?>
					<?php else: ?>
						<h2>No Associated MJPEG Server Found</h2>
					<?php endif; ?>
				</section>
				<section class="6u">
					<?php if($environment['Rosbridge']['host']): ?>
						<?php if(count($environment['Teleop']) > 0): ?>
							<?php echo $this->Rms->keyboardTeleop($environment['Teleop'][0]['topic']); ?>
							<pre class="rostopic"><code id="speed">Awaiting data...</code></pre>
							<script>
								var topic = new ROSLIB.Topic({
									ros : _ROS,
									name : '<?php echo h($environment['Teleop'][0]['topic']);?>'
								});
								topic.subscribe(function(message) {
									$('#speed').html(RMS.prettyJson(message));
								});
							</script>

							
						<?php else: ?>
							<h2>No Associated Telop Settings Found</h2>
						<?php endif; ?>
					<?php else: ?>
						<h2>No Associated rosbridge Server Found</h2>
					<?php endif; ?>
				</section>
			</div>
		</section>
	</div>
</section>
