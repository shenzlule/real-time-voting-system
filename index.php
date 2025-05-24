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
<!-- Tailwind CSS CDN for animations and styles -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet">

<style>
  /* Fade in animation */
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translate3d(0, 20px, 0);
    }
    to {
      opacity: 1;
      transform: none;
    }
  }
  .animate-fade-in-up {
    animation: fadeInUp 0.7s ease forwards;
  }

  /* Button gradient and hover */
  .btn-gradient {
    background: linear-gradient(90deg, #4f46e5, #3b82f6);
    transition: background-position 0.5s;
    background-size: 200% 200%;
    background-position: left;
  }
  .btn-gradient:hover {
    background-position: right;
  }

  /* Google button style */
  .btn-google {
    background-color: #4285F4;
    color: white;
    transition: background-color 0.3s ease;
  }
  .btn-google:hover {
    background-color: #357ae8;
  }
</style>

<body class="bg-gradient-to-r from-purple-100 via-blue-100 to-green-100 min-h-screen flex flex-col justify-center items-center font-sans px-4">

  <!-- Floating Admin Login Button (Top Right) -->
  <div class="absolute top-6 right-6 z-10">
    <a href="admin/index.php"
      class="py-2 px-5 rounded-full border-2 border-purple-600 text-purple-700 font-semibold hover:bg-purple-600 hover:text-white transition duration-300 shadow-sm flex items-center space-x-2">
      <i class="fas fa-user-shield"></i>
      <span>Admin Login</span>
    </a>
  </div>

  <!-- Title -->
  <div class="text-center mb-8 animate-fade-in-up">
    <h1 class="text-5xl font-extrabold text-gradient bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-700">
      <span>Real-Time</span> Voting System
    </h1>
    <p class="text-gray-700 mt-2 text-lg italic">Secure and seamless voting experience</p>
  </div>

  <!-- Login Card -->
  <div class="bg-white shadow-2xl rounded-3xl p-10 w-full max-w-xl animate-fade-in-up" style="animation-delay: 0.2s;">
    <h2 class="text-3xl font-semibold text-center text-gray-900 mb-8">Student Sign In</h2>

    <form action="login.php" method="POST" class="space-y-6">
      <div>
        <label class="block text-gray-700 mb-2 font-medium">Generated ID</label>
        <div class="relative">
          <input type="text" name="student" required id="student"
            class="w-full px-5 py-3 pl-12 border-2 border-gray-300 rounded-full focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition duration-300">
          <span class="absolute left-4 top-3.5 text-blue-500 text-xl">
            <i class="fas fa-user"></i>
          </span>
        </div>
      </div>

      <div>
        <label class="block text-gray-700 mb-2 font-medium">Password</label>
        <div class="relative">
          <input type="password" id="password" name="password" required
            class="w-full px-5 py-3 pl-12 pr-12 border-2 border-gray-300 rounded-full focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300 transition duration-300">
          <span class="absolute left-4 top-3.5 text-blue-500 text-xl">
            <i class="fas fa-lock"></i>
          </span>
          <span onclick="togglePassword()" class="absolute right-4 top-3.5 text-blue-500 cursor-pointer text-xl hover:text-blue-700 transition">
            <i id="eyeIcon" class="fas fa-eye"></i>
          </span>
        </div>
      </div>

      <div>
        <button type="submit" name="login"
          class="w-full btn-gradient text-white font-semibold py-3 rounded-full shadow-lg flex items-center justify-center space-x-3 hover:shadow-xl">
          <i class="fas fa-sign-in-alt text-xl"></i>
          <span>login</span>
        </button>
      </div>
    </form>

    <div class="my-6 flex items-center justify-center space-x-3 text-gray-500">
      <hr class="w-1/4 border-gray-300">
      <span>OR</span>
      <hr class="w-1/4 border-gray-300">
    </div>

   <!-- Google Login Button -->
<a href="#"
   class="w-full py-3 rounded-full flex items-center justify-center space-x-3 border border-gray-300 text-gray-700 font-semibold bg-white hover:shadow-md transition duration-300">
  <img src="./images/googl.png" alt="Google icon" class="w-8 h-8" />
  <span>Sign in with Google</span>
</a>


      
    </div>

    <!-- Display error -->
    <?php
      if (isset($_SESSION['error'])) {
        echo "
        <div class='mt-6 text-red-600 text-center font-medium animate-fade-in-up'>
          ".$_SESSION['error']."
        </div>
        ";
        unset($_SESSION['error']);
      }
    ?>
  </div>

  <!-- Footer Credit -->
  <footer class="mt-12 text-center text-gray-600 text-md select-none">
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
