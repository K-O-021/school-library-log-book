<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Library System</title>
    <style>
body {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    background-color: #fff0f5;
    color: #333;
}

header {
    background-color: rgb(255, 176, 209);
    color: white;
    padding: 40px;
    text-align: center;
    font-size: 24px;
    font-weight: bold;
}

.container {
    max-width: 1200px;  /* Increased the max width */
    margin: 30px auto;
    padding: 20px;
    background-color: white;
    border-radius: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.form-container {
    background-color: #ffe6f0;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.form-container input,
.form-container button {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    border-radius: 6px;
    border: 1px solid #d63384;
    font-size: 16px;
    color: #555;
    text-align: center;
}

.form-container button {
    background-color: #ff69b4;
    color: white;
    border: none;
    cursor: pointer;
}

.form-container button:hover {
    background-color: #d63384;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

th, td {
    padding: 12px;  /* Increased padding for better spacing */
    text-align: center;
    border: 1px solid #ffb6c1;
    background-color: rgb(255, 255, 255);
    font-size: 14px;  /* Increased font size for readability */
}

th {
    background-color: #ff69b4;
    color: white;
    font-size: 16px;
}

tr:hover {
    background-color: #ffe6f0;
}

.action-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;  /* Increased space between buttons */
}

.action-buttons button {
    padding: 10px 20px;  /* Added more padding for a more comfortable size */
    border-radius: 50px;  /* Rounded buttons for a smoother look */
    font-size: 16px;  /* Slightly increased font size for better visibility */
    font-weight: bold;  /* Make the text bold */
    color: white;
    background-color: #ff69b4;  /* Soft pink background */
    border: none;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  /* Soft shadow to make buttons pop */
    transition: all 0.3s ease;  /* Smooth transition for hover effect */
}

.action-buttons button:hover {
    background-color: #d63384;  /* Darker pink on hover */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);  /* Stronger shadow on hover */
    transform: translateY(-2px);  /* Slight lift effect on hover */
}

.action-buttons button:active {
    transform: translateY(0);  /* Reset lift effect when the button is clicked */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  /* Subtle shadow on click */
}

.modal {
    display: none;
    position: fixed;
    z-index: 100;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
    transition: all 0.3s ease;  /* Smooth transition for modals */
}

.modal-content {
    background-color: #fff0f5;
    margin: 10% auto;
    padding: 30px;
    border: 1px solid #d63384;
    width: 60%;  /* Adjusted width for better modal size */
    max-width: 900px;  /* Max-width for responsiveness */
    border-radius: 10px;
    text-align: center;
}

.modal-content input,
.modal-content button {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    border-radius: 6px;
    border: 1px solid #d63384;
    font-size: 14px;
}

.modal-content button {
    background-color: #ff69b4;
    color: white;
    border: none;
}

.modal-content button:hover {
    background-color: #d63384;
}

.close {
    color: #d63384;
    font-size: 24px;
    cursor: pointer;
    float: right;
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    .modal-content {
        width: 90%;  /* Modal becomes more responsive on small screens */
    }

    table {
        font-size: 12px;
    }

    .action-buttons {
        flex-direction: column;  /* Stack buttons on smaller screens */
        gap: 10px;  /* Reduce space between stacked buttons */
    }
}

    </style>
</head>
<body>
    <header>
        Library Log-Book 
    </header>

    <div class="container">
        <div class="form-container">
            <form action="" method="post">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="text" name="course" placeholder="Course" required>
                <input type="tel" name="phone" placeholder="Phone" required><br>
                <input type="text" name="genre" placeholder="Book Genre">
                <input type="text" name="author" placeholder="Book Author"><br>
                <input type="text" name="title" placeholder="Book Title"><br><br>
                <label for="borrow_date">Borrow Date:</label><br>
                <input type="date" id="borrow_date" name="borrow_date"><br><br>
                <label for="return_date">Return Date:</label><br>
                <input type="date" id="return_date" name="return_date"><br><br>
                <button type="submit" name="submit">SUBMIT</button>
            </form>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            $stmt = $conn->prepare("INSERT INTO library_records (name, course, email, phone, genre, author, title, borrow_date, return_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $_POST['name'], $_POST['course'], $_POST['email'], $_POST['phone'], $_POST['genre'], $_POST['author'], $_POST['title'], $_POST['borrow_date'], $_POST['return_date']);
            $stmt->execute();
            echo "<script>window.location.href = window.location.href;</script>";
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Genre</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Borrow Date</th>
                    <th>Return Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM library_records");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['course']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['genre']}</td>
                        <td>{$row['author']}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['borrow_date']}</td>
                        <td>{$row['return_date']}</td>
                        <td class='action-buttons'>
                            <button onclick='openModal(\"viewModal{$row['id']}\")'>View</button>
                            <button onclick='openModal(\"editModal{$row['id']}\")'>Update</button>
                            <button onclick='openModal(\"deleteModal{$row['id']}\")'>Delete</button>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Modals -->
        <?php
        $result = $conn->query("SELECT * FROM library_records");
        while ($row = $result->fetch_assoc()) {
        ?>
        <div id="viewModal<?php echo $row['id']; ?>" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('viewModal<?php echo $row['id']; ?>')">&times;</span>
                <h2>View Details</h2>
                <p>Name: <?php echo $row['name']; ?></p>
                <p>Email: <?php echo $row['email']; ?></p>
                <p>Course: <?php echo $row['course']; ?></p>
                <p>Phone: <?php echo $row['phone']; ?></p>
                <p>Genre: <?php echo $row['genre']; ?></p>
                <p>Author: <?php echo $row['author']; ?></p>
                <p>Title: <?php echo $row['title']; ?></p>
                <p>Borrow Date: <?php echo $row['borrow_date']; ?></p>
                <p>Return Date: <?php echo $row['return_date']; ?></p>
            </div>
        </div>

        <div id="editModal<?php echo $row['id']; ?>" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('editModal<?php echo $row['id']; ?>')">&times;</span>
                <h2>Update Details</h2>
                <form action="edit.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
                    <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
                    <input type="text" name="course" value="<?php echo $row['course']; ?>" required><br>
                    <input type="tel" name="phone" value="<?php echo $row['phone']; ?>"><br>
                    <input type="text" name="genre" value="<?php echo $row['genre']; ?>"><br>
                    <input type="text" name="author" value="<?php echo $row['author']; ?>"><br>
                    <input type="text" name="title" value="<?php echo $row['title']; ?>"><br>
                    <label>Borrow Date:</label><br>
                    <input type="date" name="borrow_date" value="<?php echo $row['borrow_date']; ?>"><br>
                    <label>Return Date:</label><br>
                    <input type="date" name="return_date" value="<?php echo $row['return_date']; ?>"><br><br>
                    <button type="submit">Save Changes</button>
                </form>
            </div>
        </div>

        <div id="deleteModal<?php echo $row['id']; ?>" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('deleteModal<?php echo $row['id']; ?>')">&times;</span>
                <h2>❗Confirm Delete</h2>
                <p>Are you sure you want to delete this entry?</p>
                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
                <button onclick="closeModal('deleteModal<?php echo $row['id']; ?>')">Cancel</button>
            </div>
        </div>
        <?php } ?>

    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'block';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        window.onclick = function(event) {
            document.querySelectorAll('.modal').forEach(function(modal) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            });
        }
    </script>
</body>
</html>
