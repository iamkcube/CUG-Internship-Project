<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>East Coast Railway CUG</title>
	<link rel="icon" type="image/webp" href="logo.webp" />
	<link rel="stylesheet" href="base.css" />
	<link rel="stylesheet" href="styles.css" />
</head>

<body>
	<header>
		<nav>
			<ul>
				<li><a href="#home">Home</a></li>
				<li><a href="#about">About</a></li>
				<li><a href="#services">Services</a></li>
				<li><a href="#contact">Contact</a></li>
				<li class="dropdown">
					<a href="login.php" class="dropbtn">Login</a>
				</li>
			</ul>
		</nav>
	</header>

	<section id="hero">
		<div class="hero-overlay">
			<p>Welcome to</p>
			<h1>East Coast Railway Closed User Group</h1>
			<p>Secure and efficient communication for East Coast Railway personnel.</p>
			<div class="hero-buttons">
				<a href="login.php" class="btn">Login</a>
			</div>
		</div>
	</section>

	<section id="about">
		<div class="about-container">
			<h2>About Us</h2>
			<p>
				The East Coast Railway Closed User Group (CUG) is a dedicated platform designed to facilitate secure and
				efficient communication among East Coast Railway personnel.
				Established with the vision of fostering seamless collaboration and enhancing operational efficiency,
				our CUG system provides a robust framework for internal communication and coordination.
			</p>
			<br>
			<!-- <p>
				At East Coast Railway, we recognize the critical importance of effective communication within our
				organization. The CUG platform serves as a centralized hub where employees, managers, and stakeholders
				can securely exchange information, collaborate on projects, and streamline decision-making processes.
			</p> -->
			<!-- <p>
				Our mission is to empower East Coast Railway personnel with a comprehensive suite of communication tools
				tailored to their specific needs. Whether it's sharing important updates, coordinating schedules, or
				disseminating critical information during emergencies, our CUG platform is designed to meet the evolving
				communication needs of our organization.
			</p>
			<p>
				With a focus on security, reliability, and user-friendliness, the East Coast Railway CUG platform offers
				a range of features, including secure messaging, voice communication, group calls, file sharing, event
				scheduling, user management, emergency alerts, and location tracking.
			</p> -->
			<!-- <p>
				Join us in embracing the future of communication at East Coast Railway. Together, we can strengthen
				collaboration, streamline operations, and ensure the seamless delivery of our services.
			</p> -->

			<!-- Summary Table -->
			<h3>Summary</h3>
			<br>
			<?php
			include 'db_connect.php';


			// Queries to get the required data
			$totalEmployeesQuery = "SELECT COUNT(*) as total FROM cugdetails";
			$activeCUGQuery = "SELECT COUNT(*) as active FROM cugdetails WHERE status = 'Active'";
			$inactiveCUGQuery = "SELECT COUNT(*) as inactive FROM cugdetails_transaction WHERE status = 'Inactive'";
			$allocationNumbersQuery = "SELECT COUNT(DISTINCT allocation) as allocations FROM cugdetails";
			$billNumbersQuery = "SELECT COUNT(*) as bills FROM bills";
			$plansQuery = "SELECT COUNT(*) as plans FROM plans";
			$planNamesQuery = "SELECT GROUP_CONCAT(plan_name SEPARATOR ', ') as plan_names FROM plans";

			// Execute queries and fetch data
			$totalEmployeesResult = $conn->query($totalEmployeesQuery);
			$activeCUGResult = $conn->query($activeCUGQuery);
			$inactiveCUGResult = $conn->query($inactiveCUGQuery);
			$allocationNumbersResult = $conn->query($allocationNumbersQuery);
			$billNumbersResult = $conn->query($billNumbersQuery);
			$plansResult = $conn->query($plansQuery);
			$planNamesResult = $conn->query($planNamesQuery);

			$totalEmployees = $totalEmployeesResult->fetch_assoc()['total'];
			$activeCUG = $activeCUGResult->fetch_assoc()['active'];
			$inactiveCUG = $inactiveCUGResult->fetch_assoc()['inactive'];
			$allocationNumbers = $allocationNumbersResult->fetch_assoc()['allocations'];
			$billNumbers = $billNumbersResult->fetch_assoc()['bills'];
			$plans = $plansResult->fetch_assoc()['plans'];
			$planNames = $planNamesResult->fetch_assoc()['plan_names'];

			// Close connection
			$conn->close();
			?>
			<table>
				<tr>
					<th>Total Number of Employees</th>
					<td><?php echo $totalEmployees; ?></td>
				</tr>
				<tr>
					<th>Number of Active CUG</th>
					<td><?php echo $activeCUG; ?></td>
				</tr>
				<tr>
					<th>Number Of Inactive CUG</th>
					<td><?php echo $inactiveCUG; ?></td>
				</tr>
				<tr>
					<th>Number of Allocation Numbers</th>
					<td><?php echo $allocationNumbers; ?></td>
				</tr>
				<tr>
					<th>Number of Bill Numbers</th>
					<td><?php echo $billNumbers; ?></td>
				</tr>
				<tr>
					<th>Number of Plans</th>
					<td><?php echo $plans; ?></td>
				</tr>
				<tr>
					<th>Plan Names</th>
					<td><?php echo $planNames; ?></td>
				</tr>
			</table>
		</div>
	</section>

	<section id="services">
		<h2>Our Services</h2>
		<div class="services-container">
			<div class="service">
				<img src="icon/secure_messaging.webp" alt="Secure Messaging" />
				<h3>Secure Messaging</h3>
				<p>Send and receive messages securely within the CUG network.</p>
			</div>
			<div class="service">
				<img src="icon/voice_communication.webp" alt="Voice Communication" />
				<h3>Voice Communication</h3>
				<p>Conduct voice calls with other members of the CUG.</p>
			</div>
			<div class="service">
				<img src="icon/group_calls3.webp" alt="Group Calls" />
				<h3>Group Calls</h3>
				<p>Initiate group calls for team discussions and meetings.</p>
			</div>
			<div class="service">
				<img src="icon/file_sharing.webp" alt="File Sharing" />
				<h3>File Sharing</h3>
				<p>Share files securely within the CUG network.</p>
			</div>
			<div class="service">
				<img src="icon/event_scheduling.webp" alt="Event Scheduling" />
				<h3>Event Scheduling</h3>
				<p>Schedule events and meetings with ease.</p>
			</div>
			<div class="service">
				<img src="icon/user_management.webp" alt="User Management" />
				<h3>User Management</h3>
				<p>Manage user profiles and access within the CUG.</p>
			</div>
			<div class="service">
				<img src="icon/emergency_alerts.webp" alt="Emergency Alerts" />
				<h3>Emergency Alerts</h3>
				<p>Receive and send emergency alerts promptly.</p>
			</div>
			<div class="service">
				<img src="icon/location_tracking.webp" alt="Location Tracking" />
				<h3>Location Tracking</h3>
				<p>Track the location of CUG members for coordination.</p>
			</div>
		</div>
	</section>

	<section id="gallery">
		<h2>Gallery</h2>
		<div class="gallery">
			<img src="images/photo1.webp" alt="Photo 1" />
			<img src="images/photo2.webp" alt="Photo 2" />
			<img src="images/photo3.webp" alt="Photo 3" />
		</div>
	</section>

	<section id="contact">
		<div class="contact-form">
			<h2>Contact Us</h2>
			<form action="#" method="post">
				<label for="name">Name:</label>
				<input type="text" id="name" name="name" required />
				<label for="email">Email:</label>
				<input type="email" id="email" name="email" required />
				<label for="message">Message:</label>
				<textarea id="message" name="message" rows="4" required></textarea>
				<button class="btn" type="submit">
					Submit
				</button>
			</form>
		</div>
		<div class="map">
			<iframe
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3744.2906878678466!2d85.81673161439164!3d20.318957183946517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a1909a4ecf78691%3A0xdaa17307a6072601!2sRail%20Sadan%2C%20East%20Coast%20Railway%20Headquarters!5e0!3m2!1sen!2sin!4v1623495793082!5m2!1sen!2sin"
				width="400" height="300" style="border: 0" allowfullscreen="" loading="lazy"></iframe>
		</div>
	</section>


    <footer>
        <p>&copy; 2024 East Coast Railway. All rights reserved.</p>
        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
        </div>
    </footer>
</body>

</html>