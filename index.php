<?php
  	session_start();
  	if(isset($_SESSION['admin'])){
    	header('location: admin/home.php');
  	}

    if(isset($_SESSION['voter'])){
      header('location: home.php');
    }
?>

<?php include 'includes/header.php'; ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<script src="css/tailwind_3_4_1_6.css"></script>

<body class="bg-gray-100 min-h-screen flex flex-col justify-center items-center font-sans">
  <!-- Title -->
  <div class="text-center mb-6">
    <h1 class="text-4xl font-bold text-gray-800">
      <span class="text-blue-600">Real-Time</span> Voting System
    </h1>
    <p class="text-gray-500 mt-1 text-sm">Secure and seamless voting experience</p>
  </div>

  <!-- Login Card -->
  <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md animate-fade-in">
    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Student Sign In</h2>

    <form action="login.php" method="POST" class="space-y-5">
      <div>
        <label class="block text-gray-600 mb-1">Generated ID</label>
        <div class="relative">
          <input type="text" name="student" required  id="student"
            class="w-full px-4 py-2 pl-10 border rounded-full border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span class="absolute left-3 top-2.5 text-gray-400">
            <i class="fas fa-user"></i>
          </span>
        </div>
      </div>

      <div>
        <label class="block text-gray-600 mb-1">Password</label>
        <div class="relative">
          <input type="password" id="password" name="password" required
            class="w-full px-4 py-2 pl-10 pr-10 border rounded-full border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
          <span class="absolute left-3 top-2.5 text-gray-400">
            <i class="fas fa-lock"></i>
          </span>
          <span onclick="togglePassword()" class="absolute right-3 top-2.5 text-gray-400 cursor-pointer">
            <i id="eyeIcon" class="fas fa-eye"></i>
          </span>
        </div>
      </div>

      <div class="text-center">
        <button type="submit" name="login"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-full transition duration-300">
          <i class="fas fa-sign-in-alt mr-2"></i>login
        </button>
      </div>
    </form>

    <!-- Display error -->
    <?php
      if (isset($_SESSION['error'])) {
        echo "
        <div class='mt-4 text-red-600 text-center font-medium'>
          ".$_SESSION['error']."
        </div>
        ";
        unset($_SESSION['error']);
      }
    ?>
  </div>

  <!-- Footer Credit -->
  <footer class="mt-10 text-center text-gray-600 text-sm">
    Designed & Developed by <span class="font-semibold text-blue-600">Jeremy Kalembe</span><br>
    Uganda Martyrs University – Final Year Project
  </footer>

  <script>
    function togglePassword() {
      const password = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');
      if (password.type === 'password') {
        password.type = 'text';
        eyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        password.type = 'password';
        eyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    }
  </script>
</body>
</html>
