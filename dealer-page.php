<?php
include 'authenticate.php';
checkUser("dealer");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0"
		/>
		<title>East Coast Railway CUG Dealer Page</title>
		<link
			rel="icon"
			type="image/webp"
			href="logo.webp"
		/>
		<link
			rel="stylesheet"
			href="base.css"
		/>
		<link
			rel="stylesheet"
			href="admin-page.css"
		/>
		<style>
			body {
				display: flex;
				flex-direction: column;
			}

			.content {
				flex: 1;
			}

			footer {
				text-align: center;
				padding: 1rem;
				background-color: black;
			}

			.logout-button {
				background-color: rgb(200, 45, 45);
				color: white;
				border: none;
				padding: 10px 20px;
				cursor: pointer;
				font-size: 1em;
				position: absolute;
				right: 20px;
				top: 20px;
                padding-right: 2%;border-radius: 10%;
			}


		</style>
	</head>
	<body>
		<div class="content">
			<header>
				<div class="header-top">
					<a href="./">
						<h1>East Coast Railway</h1>
						<h1>Closed User Group</h1>
					</a>
					<button
					class="logout-button"
					onclick="location.href='login.php'"
				>
					Logout
				</button>
				</div>
			</header>

			<section id="admin-services">
				<h2>Dealer Services</h2>
				<div class="services-container">
					<div class="service">
						<a href="add-cug.php">
							<img
								src="icon/add_cug1.webp"
								alt="Add New CUG"
							/>
							<h3>Add New CUG</h3>
							<p>Add new CUG numbers to the system.</p>
						</a>
					</div>
					<div class="service">
						<a href="./upload-cug.php">
							<img
								src="icon/upload_cug.webp"
								alt="Add New CUG"
							/>
							<h3>Upload CUG Numbers</h3>
							<p>Upload new CUG numbers to the system.</p>
						</a>
					</div>
					<div class="service">
						<a href="deactivate-cug.php">
							<img
								src="icon/de-activate_cug.webp"
								alt="De-Active CUG"
							/>
							<h3>De-Active CUG</h3>
							<p>Deactive a CUG number from the system.</p>
						</a>
					</div>
					<div class="service">
						<a href="allocation-report.php">
							<img
								src="icon/allocation_report.webp"
								alt="Allocation-Wise Report"
							/>
							<h3>Allocation-Wise Report</h3>
							<p>Generate reports based on CUG allocations.</p>
						</a>
					</div>
					<div class="service">
						<a href="plan-wise-billing.php">
							<img
								src="icon/plan-wise_billing.webp"
								alt="Plan-Wise Billing Report"
							/>
							<h3>Plan-Wise Billing Report</h3>
							<p>
								Generate billing reports based on different
								service plans.
							</p>
						</a>
					</div>
				</div>
			</section>
		</div>

		<footer>
			<p>&copy; 2024 East Coast Railway. All rights reserved.</p>
			<div class="footer-links">
				<a href="#">Privacy Policy</a>
				<a href="#">Terms of Service</a>
			</div>
		</footer>
	</body>
</html>