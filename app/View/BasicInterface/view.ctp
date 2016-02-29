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

<section class="wrapper style4 container">
	<header>
		<p>Drive around in a smart home. Use the <strong>W, A, S, D, Q, E</strong> keys to drive around the home.</p>
	</header>

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

<script>
   var topic = new ROSLIB.Topic({
		   ros : _ROS,
		   name : '/echo',
		   messageType : 'std_msgs/String'
   });
</script>


<section class="6u">
           <div style="float:right; width:50%;">
                   
                   <button id="forward" class="button" >Forward</button><br />
                   <script>
                           $('#forward').click(function() {
                                 var msg = new ROSLIB.Message({
                                          data : 'w'
                                  });
                                   topic.publish(msg);
								 });
                   </script>

		 			 <button id="backward" class="button">Backward</button><br />
						<script>
                           $('#backward').click(function() {
                                 var msg = new ROSLIB.Message({
                                          data : 's'
                                  });
                                   topic.publish(msg);
								 });
                  		 </script>

					 <button id="right" class="button">Right</button><br />
						<script>
                           $('#right').click(function() {
                                 var msg = new ROSLIB.Message({
                                          data : 'd'
                                  });
                                   topic.publish(msg);
								 });
                   	</script>

					 <button id="left" class="button">Left</button><br />
						<script>
                           $('#left').click(function() {
                                 var msg = new ROSLIB.Message({
                                          data : 'a'
                                  });
                                   topic.publish(msg);
								 });
                   </script>

					 <button id="stop" class="button">Stop</button><br /><br />
						<script>
                           $('#stop').click(function() {
                                 var msg = new ROSLIB.Message({
                                          data : 'x'
                                 });
                                   topic.publish(msg);
								 });
                  		 </script>
					  </div>


	</section>

<script>
	RMS.logString('start', 'User has connected.');
</script>

<!--<header class="special container">
	<span class="icon fa-cloud"></span>
	<h2>Basic Interface</h2>
</header>
-->

		
	
