<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$message_success = $_SESSION['success'] ?? '';
$message_error = $_SESSION['error'] ?? '';
unset($_SESSION['success'], $_SESSION['error']);

$stmt = $conn->prepare("SELECT id, problem_category, description, status, created_at FROM complaints WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$complaints = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard - GECV Hostel Complaint Portal</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f8fb;
    margin: 0;
    padding: 0;
}

header {
    background-color: #1e88e5;
    color: white;
    padding: 20px;
    text-align: center;
    font-size: 26px;
    font-weight: bold;
    letter-spacing: 1px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.container {
    max-width: 900px;
    margin: 40px auto;
    padding: 20px;
    background-color: white;
    box-shadow: 0 6px 12px rgba(0,0,0,0.1);
    border-radius: 12px;
}

h2 {
    color: #333;
    text-align: center;
    margin-bottom: 30px;
}

.complaint {
    background-color: #e3f2fd;
    border-left: 5px solid #2196f3;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.08);
}

.complaint strong {
    display: inline-block;
    width: 100px;
    color: #0d47a1;
}

.status {
    padding: 5px 10px;
    border-radius: 5px;
    font-weight: bold;
    display: inline-block;
}

.status.Pending {
    background-color: #fff3cd;
    color: #856404;
}

.status["In Progress"] {
    background-color: #d1ecf1;
    color: #0c5460;
}

.status.Resolved {
    background-color: #d4edda;
    color: #155724;
}

.logout-btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #e53935;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: background 0.3s;
}

.logout-btn:hover {
    background-color: #c62828;
}
</style>

    
</head>
<body>

<header>
  <h1><i class="fas fa-tools"></i> GECV Hostel Complaint Portal</h1>
  <div>Welcome, <?= htmlspecialchars($username) ?> | <a href="logout.php" class="logout">Logout</a></div>
</header>

<div class="container">
  <h2><i class="fas fa-comment-dots"></i> Submit a Complaint</h2>

  <?php if ($message_success): ?>
    <div class="message success"><?= htmlspecialchars($message_success) ?></div>
  <?php endif; ?>
  <?php if ($message_error): ?>
    <div class="message error"><?= htmlspecialchars($message_error) ?></div>
  <?php endif; ?>

  <form method="POST" action="submit_complaint.php">
    <label for="problem_category"><i class="fas fa-list"></i> Select Problem Category</label>
    <select id="problem_category" name="problem_category" required>
      <option value="" disabled selected>-- Select a Problem --</option>
      <option value="Plumbing">🚰 Plumbing</option>
      <option value="Electrical">💡 Electrical</option>
      <option value="Cleanliness">🧹 Cleanliness</option>
      <option value="Food">🍽️ Food</option>
      <option value="Other">❓ Other</option>
    </select>

    <label for="description"><i class="fas fa-align-left"></i> Describe the Problem</label>
    <textarea id="description" name="description" placeholder="Enter detailed description here..." required></textarea>

    <button type="submit"><i class="fas fa-paper-plane"></i> Submit Complaint</button>
  </form>

  <h2><i class="fas fa-history"></i> Your Complaints</h2>

  <?php if (count($complaints) === 0): ?>
    <p>No complaints submitted yet.</p>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Category</th>
          <th>Description</th>
          <th>Status</th>
          <th>Submitted On</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($complaints as $complaint): ?>
          <tr>
            <td><?= htmlspecialchars($complaint['id']) ?></td>
            <td><?= htmlspecialchars($complaint['problem_category']) ?></td>
            <td><?= nl2br(htmlspecialchars($complaint['description'])) ?></td>
            <td>
              <?php
                $status = strtolower($complaint['status']);
                if ($status === 'pending') {
                    echo '<span class="status-pending">Pending</span>';
                } elseif ($status === 'resolved') {
                    echo '<span class="status-resolved">Resolved</span>';
                } elseif ($status === 'in progress') {
                    echo '<span class="status-inprogress">In Progress</span>';
                } else {
                    echo htmlspecialchars($complaint['status']);
                }
              ?>
            </td>
            <td><?= htmlspecialchars($complaint['created_at']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

</body>
</html>