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
<meta charset="utf-8" />
    
    <script src="http://cdn.robotwebtools.org/threejs/current/three.min.js"></script>
    <script src="http://cdn.robotwebtools.org/threejs/current/ColladaLoader.min.js"></script>
    <script src="http://cdn.robotwebtools.org/ColladaAnimationCompress/current/ColladaLoader2.min.js"></script>
    <script src="http://cdn.robotwebtools.org/EventEmitter2/current/eventemitter2.min.js"></script>
   <script src="http://cdn.robotwebtools.org/roslibjs/current/roslib.min.js"></script>
   <script src="http://cdn.robotwebtools.org/ros3djs/current/ros3d.min.js"></script>

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

<?php echo $this->Rms->ros($environment['Rosbridge']['uri']); ?>
<script>
   var topic = new ROSLIB.Topic({
		   ros : _ROS,
		   name : '/echo',
		   messageType : 'std_msgs/String'
   });
</script>


<section class="wrapper style4 container">
	<div class="content center">
		<section>
			<header>
				<p>Use the <strong> W, A, S, D, Q, E </strong> or <strong>Button</strong> to drive your robot.</p>
			</header>
			
			<div class="row" >

			<section class="6u stream">
						 <script>
						 /**
						  * Setup all visualization elements when the page is loaded.
						  */
						 function init() {
						   // Connect to ROS.
						   var ros = new ROSLIB.Ros({
							 url : 'ws://www.projectcosys.duckdns.org:9090'
						   });
					   
						   // Create the main viewer.
						   var viewer = new ROS3D.Viewer({
							 divID : 'urdf',
							 width : 700,
							 height : 550,
							 antialias : true
						   });
					   
						   // Add a grid.
						   viewer.addObject(new ROS3D.Grid());
					   
						   // Setup a client to listen to TFs.
						   var tfClient = new ROSLIB.TFClient({
							 ros : ros,
							 angularThres : 0.01,
							 transThres : 0.01,
							 rate : 10.0
						   });
					   
						   // Setup the URDF client.
						  var urdfClient = new ROS3D.UrdfClient({
							 ros : ros,
							 tfClient : tfClient,
							 path : 'http://resources.robotwebtools.org/',
							 rootObject : viewer.scene,
							 loader : ROS3D.COLLADA_LOADER
						   });
						 }
					   </script>
			   </head>
			   
			  <body onload="init()">
				<div id="urdf"></div>
			   </body>
			  </html>
			</section>
   
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
</div>
</section>
