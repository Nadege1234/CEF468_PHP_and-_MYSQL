<?php
$conn = new mysqli('localhost', 'root', '', 'EmployeeDB');
$departments = $conn->query("SELECT dept_id, dept_name FROM Department");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <style>
        body {
            background-color: #d3d3d3;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        form {
            display: inline-block;
            background: white;
            padding: 30px;
            margin-top: 50px;
            border-radius: 10px;
            box-shadow: 2px 2px 12px gray;
        }
        input, select {
            width: 250px;
            padding: 8px;
            margin: 10px 0;
        }
        a {
            margin: 10px;
            display: inline-block;
            color: blue;
        }
    </style>
</head>
<body>
    <h2>Add New Employee</h2>
    <form action="process_employee.php" method="POST">
        <input type="text" name="emp_name" placeholder="Employee Name" required><br>
        <input type="number" name="emp_salary" step="0.01" placeholder="Salary" required><br>
        <select name="emp_dept_id" required>
            <option value="">Select Department</option>
            <?php while ($dept = $departments->fetch_assoc()): ?>
                <option value="<?= $dept['dept_id'] ?>"><?= htmlspecialchars($dept['dept_name']) ?></option>
            <?php endwhile; ?>
        </select><br>
        <input type="submit" value="Add Employee"><br><br>
        <a href="view_employees.php">View Employees</a>
    </form>
</body>
</html>