<?php
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header('WWW-Authenticate: Basic realm="Admin Login"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Unauthorized access';
        exit;
    } else {
        $username = $_SERVER['PHP_AUTH_USER'];
        $password = $_SERVER['PHP_AUTH_PW'];

        if (!($username === 'admin' && $password === 'admin')) {
            header('WWW-Authenticate: Basic realm="Admin Login"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Unauthorized access';
            exit;
        }
    }
?>

<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
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
        if(isset($_SESSION['password-not-match']))
        {
            echo $_SESSION['password-not-match'];
            unset($_SESSION['password-not-match']);
        }
        if(isset($_SESSION['change-password']))
        {
            echo $_SESSION['change-password'];
            unset($_SESSION['change-password']);
        }
        ?>
        <br>
        <br>

        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br>
        <br>

        <table class="tbl-full">
            <tr>
                <th>S.H</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_admin";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                // COUNT ROWS TO CHECK IF WE HAVE DATA 
                $rows = mysqli_num_rows($res);

                if ($rows > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $full_name = $row['full_name'];
                        $username = $row['username'];
                        echo "<tr>";
                        echo "<td>{$count}</td>";
                        echo "<td>{$full_name}</td>";
                        echo "<td>{$username}</td>";
                        echo "<td>
                                <a href='update-admin.php?id={$id}' class='btn-secondary'>Update Admin</a>
                                <a href='delete-admin.php?id={$id}' class='btn-Danger'>Delete Admin</a>
                                <a href='update-password.php?id={$id}' class='btn-primary'>Change Password</a>
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
        margin: 4px 2px;
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

    .tbl-full {
        width: 100%;
        border-collapse: collapse;
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
