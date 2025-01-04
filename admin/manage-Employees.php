<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Employees</h1>
        <br>
        <?php 
        if(isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['user-not-found']))
        {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }
        ?>
        <br>
        <br>

        <a href="add-employee.php" class="btn-primary">Add Employee</a>
        <br>
        <br>

        <table class="tbl-full">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Salary</th>
                <th>Schedule</th>
               
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_employees";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                // COUNT ROWS TO CHECK IF WE HAVE DATA 
                $rows = mysqli_num_rows($res);

                if ($rows > 0) {
                    $count = 1;
                    // Fetch and display data
                    while ($row = mysqli_fetch_assoc($res)) {
                        // Define variables for each column
                        $id = $row['id'];
                        $Name = $row['Name'];
                        $Role = $row['Role'];
                        $Salary = $row['Salary'];
                        $schedule=$row['schedule'];
                       


                        echo "<tr>";
                        echo "<td>{$count}</td>";
                        echo "<td>{$Name}</td>";
                        echo "<td>{$Role}</td>";
                        echo "<td>{$Salary}</td>";
                        echo "<td>{$schedule}</td>";

                        echo "<td>
                                <a href='update-employee.php?id={$id}' class='btn-secondary'>Update Employee</a>
                                <a href='delete-employee.php?id={$id}' class='btn-Danger'>Delete Employee</a>
                               
                              </td>";
                        echo "</tr>";

                        $count++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Error executing query: " . mysqli_error($conn) . "</td></tr>";
            }
            ?>
        </table>
    </div>
</div>
<style>
    .btn {
        display: inline-block;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        background-color: #4CAF50;
        color: white;
        text-align: center;
        font-size: 16px;
        margin-right: 10px;
        margin-bottom: 10px;
        transition: all 0.3s;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #45a049;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .table-container {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .tbl-full {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .tbl-full th, .tbl-full td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .tbl-full th {
        background-color: #f2f2f2;
    }

    .tbl-full tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>