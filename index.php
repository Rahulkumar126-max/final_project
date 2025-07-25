<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>GECV Hostel Complaint Portal</title>
<style>
body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #74ebd5, #ACB6E5);
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
}

.container {
    background-color: rgba(255, 255, 255, 0.1);
    padding: 50px 30px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    max-width: 500px;
}

h1 {
    font-size: 36px;
    margin-bottom: 10px;
    letter-spacing: 1px;
    color: #ffffff;
}

p {
    font-size: 18px;
    margin-bottom: 30px;
    color: #f0f0f0;
}

a.button {
    display: inline-block;
    padding: 12px 25px;
    margin: 10px;
    background-color: #1e88e5;
    color: white;
    text-decoration: none;
    font-size: 18px;
    font-weight: bold;
    border: none;
    border-radius: 10px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
}

a.button:hover {
    background-color: #1565c0;
    transform: scale(1.05);
}
</style>
</head>
<body>
  <div class="container">
    <h1>GECV Hostel Complaint Portal</h1>
    <p>Your platform to quickly report and resolve hostel issues for a better living experience.</p>
    <a href="login.php" class="button">Login</a>
    <a href="register.php" class="button">Register</a>
  </div>
</body>
</html>