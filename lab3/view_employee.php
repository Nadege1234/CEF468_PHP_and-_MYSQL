<?php
$conn = new mysqli('localhost', 'root', '', 'EmployeeDB');
$result = $conn->query("
    SELECT e.emp_id, e.emp_name, e.emp_salary, d.dept_name, d.dept_location
    FROM Employee e
    INNER JOIN Department d ON e.emp_dept_id = d.dept_id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
    <style>
        body {
            background-color: #d3d3d3;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        table {
            margin: auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 2px 2px 12px gray;
        }
        th, td {
            padding: 12px 20px;
            border: 1px solid #999;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            margin-top: 20px;
            display: inline-block;
            color: blue;
        }
    </style>
</head>
<body>
    <h2>Employee List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Salary</th>
            <th>Department</th>
            <th>Location</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['emp_id'] ?></td>
            <td><?= htmlspecialchars($row['emp_name']) ?></td>
            <td><?= $row['emp_salary'] ?></td>
            <td><?= htmlspecialchars($row['dept_name']) ?></td>
            <td><?= htmlspecialchars($row['dept_location']) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="add_employee.php">Add New Employee</a>
</body>
</html>