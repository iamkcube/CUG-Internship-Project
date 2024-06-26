<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "raildb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['NAME'];
    $cug_no = $_POST['CUG_NO'];
    $emp_no = $_POST['EMP_NO'];
    $designation = $_POST['DESIGNATION'];
    $department = $_POST['department'];
    $bill_unit = $_POST['BILL_UNIT'];
    $allocation = $_POST['ALLOCATION'];
    $operator = $_POST['operator'];
    $plan = $_POST['plan'];
    $status = "Active";


    if (empty($name) || empty($cug_no) || empty($emp_no) || empty($designation) || $department == "default" || empty($bill_unit) || empty($allocation) || $operator == "default" || empty($plan)) {
        echo "All fields are required.";
    } else {

        $allowed_plans = ['Plan A', 'Plan B', 'Plan C'];
        if (!in_array($plan, $allowed_plans)) {
            echo "Invalid plan selected.";
            exit;
        }


        $plan_value = '';
        switch ($plan) {
            case 'Plan A':
                $plan_value = 'A';
                break;
            case 'Plan B':
                $plan_value = 'B';
                break;
            case 'Plan C':
                $plan_value = 'C';
                break;
            default:
                echo "Invalid plan selected.";
                exit;
        }


        $stmt = $conn->prepare("INSERT INTO CUGDetails (cug_number, emp_number, empname, designation, department, bill_unit, allocation, operator, plan, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt === false) {

            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }


        $stmt->bind_param("isssssssss", $cug_no, $emp_no, $name, $designation, $department, $bill_unit, $allocation, $operator, $plan_value, $status);


        if ($stmt->execute()) {
            unset($_SESSION['message']);
            $_SESSION['message'] = "CUG is successfully allotted to $name";
        } else {
            $_SESSION['message'] = "Error: " . $stmt->error;
        }


        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add CUG</title>
    <link rel="stylesheet" href="base.css" />
    <link rel="stylesheet" href="add-cug.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: "#eef2ff",
                            100: "#e0e7ff",
                            200: "#c7d2fe",
                            300: "#a5b4fc",
                            400: "#818cf8",
                            500: "#6366f1",
                            600: "#4f46e5",
                            700: "#4338ca",
                            800: "#3730a3",
                            900: "#312e81",
                            950: "#1e1b4b",
                        },
                        "accent-color": "var(--accent-color)",
                        "accent-color-hover": "var(--accent-color-hover)",
                    },
                },
                fontFamily: {
                    body: [
                        "Raleway",
                        "ui-sans-serif",
                        "system-ui",
                        "-apple-system",
                        "system-ui",
                        "Segoe UI",
                        "Roboto",
                        "Helvetica Neue",
                        "Arial",
                        "Noto Sans",
                        "sans-serif",
                        "Apple Color Emoji",
                        "Segoe UI Emoji",
                        "Segoe UI Symbol",
                        "Noto Color Emoji",
                    ],
                    sans: [
                        "Raleway",
                        "ui-sans-serif",
                        "system-ui",
                        "-apple-system",
                        "system-ui",
                        "Segoe UI",
                        "Roboto",
                        "Helvetica Neue",
                        "Arial",
                        "Noto Sans",
                        "sans-serif",
                        "Apple Color Emoji",
                        "Segoe UI Emoji",
                        "Segoe UI Symbol",
                        "Noto Color Emoji",
                    ],
                },
            },
        };
    </script>
</head>

<body>
    <!-- <div
            class="nav_bar"
            id="nav_bar"
        >
            <a href="https://fontawesome.com/icons/bars?f=classic&s=solid"></a>
        </div> -->
    <main id="main">
        <div class="heading-container">
            <button class="back-btn" onclick="window.location.href = './admin-page.html'"><img
                    src="https://img.icons8.com/ios/32/long-arrow-left.png" alt="back button"></button>
            <h2 class="heading">ALLOTMENT OF NEW CUG</h2>
        </div>
        <?php
        if (isset($_SESSION['message'])) {
            echo "<p class='session-message'>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']);
        }
        ?>
        <form class="form_container" action="add-cug.php" method="post">
            <div class="input_box long-input">
                <label for="name">Name</label>
                <input class="py-2 px-3" type="text" placeholder="Enter Name" name="NAME" required />
            </div>
            <div class="input_box">
                <label for="cugno">CUG No</label>
                <input class="py-2 px-3" type="number" placeholder="Enter CUG no." name="CUG NO" required />
            </div>
            <div class="input_box">
                <label for="empno">Employee No.</label>
                <input class="py-2 px-3" type="number" placeholder="Enter Employee no." name="EMP NO" required />
            </div>
            <div class="input_box">
                <label for="designation">Designation</label>
                <input class="py-2 px-3" type="text" placeholder="Enter Designation" name="DESIGNATION" required />
            </div>
            <div class="input_box">
                <label for="department">Department</label>
                <select class="py-2 px-2" id="department" name="department">
                    <option value="default">Select an Option</option>
                    <option value="maintenance">Maintenance</option>
                    <option value="infrastructure">Infrastructure</option>
                    <option value="safety">Safety</option>
                    <option value="engineering">Engineering</option>
                    <option value="hr">Human Resources</option>
                    <option value="finance">Finance</option>
                    <option value="it">Information Technology</option>
                    <option value="procurement">Procurement</option>
                    <option value="marketing">Marketing</option>
                    <option value="training">
                        Training and Development
                    </option>
                </select>
            </div>
            <div class="input_box">
                <label for="BILL_UNIT">Bill Unit</label>
                <input class="py-2 px-3" type="number" placeholder="Enter Bill Unit" name="BILL UNIT" required />
            </div>
            <div class="input_box">
                <label for="allocation">Allocation</label>
                <input class="py-2 px-3" type="text,number" placeholder="Enter Allocation" name="ALLOCATION" required />
            </div>
            <div class="input_box">
                <label for="operator">Operator</label>
                <select class="py-2 px-2" id="operator" name="operator">
                    <option value="default">Select an Option</option>
                    <option value="jio">Jio</option>
                    <option value="airtel">Airtel</option>
                    <option value="vi">VI</option>
                </select>
            </div>
            <div class="input_box">
                <label for="plan">Plan:</label>
                <input class="py-2 px-3" type="text" id="selectedPlan" name="plan" readonly required />
            </div>
            <section>
                <div class="py-4 px-4 mx-auto max-w-screen-xl lg:px-6">
                    <div class="mx-auto max-w-screen-md text-center mb-2 lg:mb-6">
                        <h2 class="text-2xl tracking-tight font-extrabold text-white">
                            Choose a Plan
                        </h2>
                    </div>
                    <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
                        <!-- Pricing Card -->
                        <div
                            class="flex flex-col w-full p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                            <div class="flex justify-center items-baseline my-8">
                                <span class="mr-2 text-5xl font-extrabold">₹74.61</span>
                            </div>
                            <h3 class="mb-4 text-xl font-semibold">
                                Validity: 84days
                            </h3>
                            <p class="font-medium text-sm text-gray-800 sm:text-lg dark:text-gray-400">
                                Data: 2.0GB/day
                            </p>
                            <p class="font-light text-gray-800 sm:text-lg dark:text-gray-400">
                                Talktime: Unlimited
                            </p>
                            <button type="button" data-plan="Plan A"
                                class="plan-option text-white bg-accent-color hover:bg-accent-color-hover focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm mt-4 px-5 py-2.5 text-center dark:text-white dark:focus:ring-primary-900">
                                Select A
                            </button>
                        </div>
                        <!-- Pricing Card -->
                        <div
                            class="flex flex-col w-full p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                            <div class="flex justify-center items-baseline my-8">
                                <span class="mr-2 text-5xl font-extrabold">₹59.05</span>
                            </div>
                            <h3 class="mb-4 text-xl font-semibold">
                                Validity: 56days
                            </h3>
                            <p class="font-medium text-sm text-gray-800 sm:text-lg dark:text-gray-400">
                                Data: 1.5GB/day
                            </p>
                            <p class="font-light text-gray-800 sm:text-lg dark:text-gray-400">
                                Talktime: Unlimited
                            </p>
                            <button type="button" data-plan="Plan B"
                                class="plan-option text-white bg-accent-color hover:bg-accent-color-hover focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm mt-4 px-5 py-2.5 text-center dark:text-white dark:focus:ring-primary-900">
                                Select B
                            </button>
                        </div>
                        <!-- Pricing Card -->
                        <div
                            class="flex flex-col w-full p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                            <div class="flex justify-center items-baseline my-8">
                                <span class="mr-2 text-5xl font-extrabold">₹39.9</span>
                            </div>
                            <h3 class="mb-4 text-xl font-semibold">
                                Validity: 28days
                            </h3>
                            <p class="font-medium text-sm text-gray-800 sm:text-lg dark:text-gray-400">
                                Data: 1.0GB/day
                            </p>
                            <p class="font-light text-gray-800 sm:text-lg dark:text-gray-400">
                                Talktime: Unlimited
                            </p>
                            <button type="button" data-plan="Plan C"
                                class="plan-option text-white bg-accent-color hover:bg-accent-color-hover focus:ring-4 focus:ring-primary-200 font-medium rounded-lg text-sm mt-4 px-5 py-2.5 text-center dark:text-white dark:focus:ring-primary-900">
                                Select C
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <button class="submit-button" type="submit">Activate</button>
        </form>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function ()
        {
            const planOptions = document.querySelectorAll(".plan-option");

            planOptions.forEach((option) =>
            {
                option.addEventListener("click", function ()
                {
                    document.getElementById("selectedPlan").value =
                        this.dataset.plan;
                });
            });
        });
    </script>
</body>

</html>