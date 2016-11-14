
<?php 
include "head.php";


?>
<?php
	if (isset($_POST["submit"])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$human = intval($_POST['human']);
		$from = 'GEM DB Contact Form'; 
		$to = 'ola.aboamer@cern.ch'; 
		$subject = "GEM_GUI_".$_POST['subject'];;
		
		$body ="From: $name\n E-Mail: $email\n Message:\n $message";
		// Check if name has been entered
		if (!$_POST['name']) {
			$errName = 'Please enter your name';
		}
		
		// Check if email has been entered and is valid
		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Please enter a valid email address';
		}
                
                // Check if email has been entered and is valid
		if (!$_POST['subject'] ) {
			$errSubject = 'Please enter a subject';
		}
		
		//Check if message has been entered
		if (!$_POST['message']) {
			$errMessage = 'Please enter your message';
		}
		//Check if simple anti-bot test is correct
		if ($human !== 5) {
			$errHuman = 'Your anti-spam is incorrect';
		}
// If there are no errors, send the email
if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
	if (mail ($to, $subject, $body, $from)) {
		$resultc='<div class="alert alert-success">Thank You! I will be in touch</div>';
	} else {
		$resultc='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
	}
}
	}
?>


  	<div class="container">
  		<div class="row">
  			<div class="col-md-6 col-md-offset-3">
  				<h3 class="page-header text-center">Hello <?php echo $userInfo['firstname']; ?>, Got any question, or problem to report?</h3>
				<form class="form-horizontal" role="form" method="post" action="contact.php">
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo $userInfo['firstname']." ".$userInfo['lastname']; ?> <?php /*echo htmlspecialchars($_POST['name']);*/ ?>">
							<?php echo "<p class='text-danger'>$errName</p>";?>
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo $userInfo['email']; ?><?php /*echo htmlspecialchars($_POST['email']);*/ ?>">
							<?php echo "<p class='text-danger'>$errEmail</p>";?>
						</div>
					</div>
                                        <div class="form-group">
						<label for="subject" class="col-sm-2 control-label">Subject</label>
						<div class="col-sm-10">
							<input class="form-control" id="subject" name="subject" style=" display: none;" >
                                                        <select onchange="$(this).prev().val($(this).val());">
                                                            <option>Choose Subject</option>
                                                            <option>Report Problem</option>
                                                            <option>Request Feature</option>
                                                            <option>General Question</option>
                                                          
                                                        </select>
							<?php echo "<p class='text-danger'>$errSubject</p>";?>
						</div>
					</div>
					<div class="form-group">
						<label for="message" class="col-sm-2 control-label">Message</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
							<?php echo "<p class='text-danger'>$errMessage</p>";?>
						</div>
					</div>
					<div class="form-group">
						<label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
							<?php echo "<p class='text-danger'>$errHuman</p>";?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<?php echo $resultc; ?>	
						</div>
					</div>
				</form> 
			</div>
		</div>
	</div>   


<?php 
include "foot.php";


?>