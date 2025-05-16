<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    


    <div class="bg-gray-100 h-screen flex flex-col m-6">

  <!-- Chat Container -->
  <div class="flex-1 overflow-auto p-4 space-y-4" id="chat-box">
    <div class="text-center text-gray-500 mt-10 animate-fade-in">
      🤖 Ask me anything about <strong>UMU University, voting process, candidates</strong> and more.
      <div class="mt-2 text-md text-gray-400">Examples: <br>
        - Who is running for president?<br>
        - When does voting start?<br>
        - What is UMU?
      </div>
    </div>
  </div>

 <!-- Fancy Input Section -->
<div class="bg-white p-4 shadow-lg flex items-center rounded-xl border border-gray-200 mx-4 my-6 animate-fade-in-up">
  <!-- Input with Icon -->
  <div class="relative flex-1">
    <input id="user-input" type="text" placeholder="Ask me anything about UMU..." 
           class="w-full pl-12 pr-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent text-gray-700 shadow-inner transition duration-300 ease-in-out"
           onkeydown="if(event.key==='Enter') sendMessage()">
    <div class="absolute left-4 top-3 text-gray-400">
      <i class="fa fa-comment-dots"></i>
    </div>
  </div>

  <!-- Send Button with Animation -->
  <button onclick="sendMessage()" 
          class="ml-4 flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1">
    <i class="fa fa-paper-plane"></i> Send
  </button>
</div>


</div>



</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>


<script>
    const chatBox = document.getElementById("chat-box");
//     function appendMessage(content, sender = "user") {
//   const div = document.createElement("div");
//   div.className = sender === "user"
//     ? "text-right"
//     : "text-left";  // 🚫 Removed animate-pulse here

//   const bubbleClass = sender === "user"
//     ? "bg-blue-500 text-white ml-auto"
//     : "bg-gray-200 text-gray-800 mr-auto";

//   div.innerHTML = `<div class="inline-block px-4 py-2 rounded-lg max-w-xs ${bubbleClass}">${content}</div>`;
//   chatBox.appendChild(div);
//   chatBox.scrollTop = chatBox.scrollHeight;
// }

function appendMessage(content, sender = "user") {
  const div = document.createElement("div");
  div.className = sender === "user" ? "text-right" : "text-left";

  const bubbleClass = sender === "user"
    ? "bg-blue-500 text-white ml-auto"
    : "bg-gray-200 text-gray-800 mr-auto";

  const bubble = document.createElement("div");
  bubble.className = `inline-block px-4 py-2 rounded-lg max-w-xs whitespace-pre-line ${bubbleClass}`;
  div.appendChild(bubble);
  chatBox.appendChild(div);
  chatBox.scrollTop = chatBox.scrollHeight;

  // Typing effect
  let index = 0;
  const typingSpeed = 30; // Adjust typing speed (ms per character)

  function typeChar() {
    if (index < content.length) {
      bubble.textContent += content.charAt(index);
      index++;
      chatBox.scrollTop = chatBox.scrollHeight;
      setTimeout(typeChar, typingSpeed);
    }
  }

  typeChar();
}



    function showTyping() {
  // Prevent duplicates
  if (document.getElementById("typing-indicator")) return;

  const div = document.createElement("div");
  div.id = "typing-indicator";
  div.className = "text-left";
  div.innerHTML = `
    <div class="inline-block px-4 py-2 rounded-lg max-w-xs bg-gray-200 text-gray-800 animate-pulse">
      Typing<span>.</span><span>.</span><span>.</span>
    </div>`;
  chatBox.appendChild(div);
  chatBox.scrollTop = chatBox.scrollHeight;
}

function removeTyping() {
  const typing = document.getElementById("typing-indicator");
  if (typing && typing.parentNode) {
    typing.parentNode.removeChild(typing);
  }
}

    async function sendMessage() {
  const input = document.getElementById("user-input");
  const message = input.value.trim();
  if (!message) return;

  appendMessage(message, "user");
  input.value = "";
  showTyping();

  try {
    const response = await fetch("http://127.0.0.1:7001/ask", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ question: message })
    });

    const data = await response.json();
    removeTyping();

    const reply = data.answer || data.text || "🤖 Sorry, no answer found.";
    appendMessage(reply, "bot");

  } catch (err) {
    removeTyping();
    appendMessage("❌ Could not connect to the server. Please try again later.", "bot");
  }
}

  </script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const boxes = document.querySelectorAll('.small-box');

  function randomPulse() {
    const randomBox = boxes[Math.floor(Math.random() * boxes.length)];
    randomBox.style.transition = "transform 0.5s ease";
    randomBox.style.transform = "scale(1.08)";

    setTimeout(() => {
      randomBox.style.transform = "scale(1)";
    }, 500);

    // Call again after a random time (2 to 5 seconds)
    const randomTime = Math.floor(Math.random() * 3000) + 2000;
    setTimeout(randomPulse, randomTime);
  }

  randomPulse();
});
</script>

</body>
</html>
