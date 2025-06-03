<?php
$conn = new mysqli('localhost', 'root', '', 'EmployeeDB');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['emp_name']);
    $salary = trim($_POST['emp_salary']);
    $dept_id = $_POST['emp_dept_id'];

    if ($name && $salary && $dept_id) {
        $stmt = $conn->prepare("INSERT INTO Employee (emp_name, emp_salary, emp_dept_id) VALUES (?, ?, ?)");
        $stmt->bind_param("sdi", $name, $salary, $dept_id);
        if ($stmt->execute()) {
            echo "<p>Employee added successfully.</p>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>All fields are required.</p>";
    }
}
?>
<a href="add_employee.php">Add Another Employee</a> | 
<a href="view_employees.php">View Employees</a>