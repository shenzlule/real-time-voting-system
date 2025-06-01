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
    


    <div class="bg-gray-100 h-screen flex flex-col mx-6">





  <!-- Popup Modal -->
  <div id="popupModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg max-w-3xl w-full p-6 mx-4 max-h-[80vh] overflow-y-auto">
      <h2 class="text-2xl font-semibold mb-4">You can ask me:</h2>
      <ul class="list-disc list-inside space-y-2 text-gray-700">

        <!-- Greet -->
        <li>Hello</li>
        <li>Hi</li>
        <li>Hey there</li>
        <li>Good morning</li>
        <li>Good afternoon</li>
        <li>Greetings</li>
        <li>Hey</li>
        <li>What's up?</li>
        <li>Hello bot</li>
        <li>Yo</li>
        <li>Hi assistant</li>
        <li>Hello voting bot</li>
        <li>Hey voting system</li>
        <li>Hi there, voting help?</li>
        <li>I need help with voting</li>
        <li>Can you assist me with UMU elections?</li>

        <!-- ask_election_details -->
        <li>Who is running for union president?</li>
        <li>Can I vote online in UMU elections?</li>
        <li>When is the voting day at UMU?</li>
        <li>How do I check if I have voted?</li>
        <li>What happens after voting at UMU?</li>
        <li>Is there a list of all candidates?</li>
        <li>Who are the faculty representatives?</li>
        <li>What is the difference between executive and councilor roles?</li>
        <li>What positions are available in UMU elections?</li>
        <li>What time does voting start?</li>
        <li>Is there a voter registration list?</li>
        <li>Where can I see my voting status?</li>
        <li>How many students have voted so far?</li>
        <li>Is the election still ongoing?</li>
        <li>Who is leading the vote count?</li>
        <li>How do I vote in the UMU student election?</li>
        <li>Can I change my vote?</li>
        <li>Are elections done per hostel or faculty?</li>
        <li>Do non-resident students vote?</li>

        <!-- ask_about_asher -->
        <li>Details about candidate Horace Asiimwe?</li>
        <li>Tell me about Horace Asiimwe?</li>
        <li>What are the values of Asher?</li>
        <li>What change does Horace want?</li>
        <li>What does 'Together We Rise' mean?</li>
        <li>What does 'Unity, transparency and growth.' imply?</li>
        <li>What does Asher stand for?</li>
        <li>What does Horace Asiimwe say?</li>
        <li>What does Horace promise students?</li>
        <li>What group is Asher in?</li>
        <li>What group is Horace Asiimwe in?</li>
        <li>What impact will Asher make?</li>
        <li>What is Horace Asiimwe's constituency?</li>
        <li>What is the faculty of Horace Asiimwe?</li>
        <li>What is the mission of Horace Asiimwe?</li>
        <li>What is the nickname of Horace Asiimwe?</li>
        <li>What is the slogan of Horace Asiimwe?</li>
        <li>What position is Horace Asiimwe running for?</li>
        <li>Who is Horace Asiimwe?</li>
        <li>Who is behind the slogan 'Together We Rise'?</li>

        <!-- ask_about_big_john -->
        <li>Describe the campaign of John Mukasa</li>
        <li>Details about candidate John Mukasa?</li>
        <li>Summarize John Mukasa's campaign</li>
        <li>Tell me about John Mukasa?</li>
        <li>What are the values of Big John?</li>
        <li>What does 'For a Better Union' mean?</li>
        <li>What does Big John stand for?</li>
        <li>What does John Mukasa say?</li>
        <li>What group is Big John in?</li>
        <li>What group is John Mukasa in?</li>
        <li>What impact will Big John make?</li>
        <li>What is John Mukasa's constituency?</li>
        <li>What is the faculty of John Mukasa?</li>
        <li>What is the mission of John Mukasa?</li>
        <li>What is the nickname of John Mukasa?</li>
        <li>What is the slogan of John Mukasa?</li>
        <li>What's the platform of John Mukasa?</li>
        <li>Where is John Mukasa contesting?</li>
        <li>Who is John Mukasa?</li>

        <!-- ask_about_ema -->
        <li>Details about candidate Emily Namirembe?</li>
        <li>Explain Emily Namirembe's slogan</li>
        <li>Summarize Emily Namirembe's campaign</li>
        <li>Tell me about Emily Namirembe</li>
        <li>What are the values of Ema?</li>
        <li>What change does Emily want?</li>
        <li>What does 'Progress through unity.' imply?</li>
        <li>What does Ema stand for?</li>
        <li>What does Emily plan to do?</li>
        <li>What group is Emily Namirembe in?</li>
        <li>What is the faculty of Emily Namirembe?</li>
        <li>What is the mission of Emily Namirembe?</li>
        <li>What is the nickname of Emily Namirembe?</li>
        <li>What is the slogan of Emily Namirembe?</li>
        <li>What position is Emily Namirembe running for?</li>
        <li>Which position is Ema aspiring to?</li>
        <li>Who is Emily Namirembe?</li>
        <li>Who is behind the slogan 'Students First'?</li>
        <li>Why should we vote Emily?</li>

        <!-- ask_about_kamya -->
        <li>Describe the campaign of Emmanuel Ddumba</li>
        <li>Details about candidate Emmanuel Ddumba?</li>
        <li>Explain Emmanuel Ddumba's slogan</li>
        <li>Summarize Emmanuel Ddumba's campaign</li>
        <li>Tell me about Emmanuel Ddumba</li>
        <li>What are Kamya's priorities?</li>
        <li>What are the values of Kamya?</li>
        <li>What does 'Let’s Make it Happen' mean?</li>
        <li>What does 'Supportive leadership.' imply?</li>
        <li>What does Emmanuel plan to do?</li>
        <li>What does Emmanuel promise students?</li>
        <li>What does Kamya stand for?</li>
        <li>What group is Kamya in?</li>
        <li>What is Emmanuel Ddumba's constituency?</li>
        <li>What is the faculty of Emmanuel Ddumba?</li>
        <li>What is the mission of Emmanuel Ddumba?</li>
        <li>What's the platform of Emmanuel Ddumba?</li>
        <li>Where is Emmanuel Ddumba contesting?</li>
        <li>Which position is Kamya aspiring to?</li>
        <li>Who is behind the slogan 'Let’s Make it Happen'?</li>

        <!-- ask_about_osbert -->
        <li>Describe the campaign of Osbert Kamugira</li>
        <li>Does Osbert Kamugira have a nickname?</li>
        <li>Explain Osbert Kamugira's slogan</li>
        <li>Tell me about Osbert Kamugira</li>
        <li>What are the values of Osbert?</li>
        <li>What change does Osbert want?</li>
        <li>What does 'Katonga First' mean?</li>
        <li>What does 'Voicing Katonga.' imply?</li>
        <li>What does Osbert plan to do?</li>
        <li>What does Osbert promise students?</li>
        <li>What does Osbert stand for?</li>
        <li>What group is Osbert in?</li>
        <li>What impact will Osbert make?</li>
        <li>What is the faculty of Osbert Kamugira?</li>
        <li>What is the mission of Osbert Kamugira?</li>
        <li>What position is Osbert Kamugira running for?</li>
        <li>Where is Osbert Kamugira contesting?</li>
        <li>Which position is Osbert aspiring to?</li>
        <li>Who is behind the slogan 'Katonga First'?</li>

        <!-- ask_about_robert -->
        <li>Describe the campaign of Robert Mugabi</li>
        <li>Does Robert Mugabi have a nickname?</li>
        <li>Explain Robert Mugabi's slogan</li>
        <li>Tell me about Robert Mugabi</li>
        <li>What are the values of Robert?</li>
        <li>What does 'Unity in diversity.' mean?</li>
        <li>What does Robert promise students?</li>
        <li>What does Robert stand for?</li>
        <li>What group is Robert in?</li>
        <li>What impact will Robert make?</li>
        <li>What is the faculty of Robert Mugabi?</li>
        <li>What is the mission of Robert Mugabi?</li>
        <li>What position is Robert Mugabi running for?</li>
        <li>Where is Robert Mugabi contesting?</li>
        <li>Who is Robert Mugabi?</li>
        <li>Who is behind the slogan 'Unity in diversity'?</li>

        <!-- ask_about_sam -->
        <li>Details about candidate Samuel Mugambe?</li>
        <li>Describe Samuel Mugambe's campaign</li>
        <li>Explain Samuel Mugambe's slogan</li>
        <li>Tell me about Samuel Mugambe</li>
        <li>What are Sam's priorities?</li>
        <li>What are the values of Sam?</li>
        <li>What does 'For a Stronger Union' mean?</li>
        <li>What does Samuel promise students?</li>
        <li>What does Sam stand for?</li>
        <li>What group is Sam in?</li>
        <li>What impact will Sam make?</li>
        <li>What is the faculty of Samuel Mugambe?</li>
        <li>What is the mission of Samuel Mugambe?</li>
        <li>What position is Samuel Mugambe running for?</li>
        <li>Where is Samuel Mugambe contesting?</li>
        <li>Who is Samuel Mugambe?</li>

        <!-- general UMU info -->
        <li>What is Uganda Martyrs University?</li>
        <li>Tell me about UMU history</li>
        <li>Where are UMU campuses located?</li>
        <li>Who governs UMU?</li>
        <li>What faculties does UMU have?</li>
        <li>Tell me about UMU alumni</li>
        <li>Where is UMU main campus?</li>
        <li>How to contact UMU?</li>
        <li>What courses does UMU offer?</li>
        <li>How many students attend UMU?</li>
        <li>What is UMU’s mission and vision?</li>

      </ul>
      <button id="closeBtn" class="mt-6 w-full bg-red-600 text-white py-2 rounded hover:bg-red-700 focus:outline-none">
        Close
      </button>
    </div>
  </div>






  <!-- Chat Container -->
  <div class="flex-1 overflow-auto p-4 space-y-6 bg-white" id="chat-box">
    <div class="text-center text-gray-500 mt-10 animate-fade-in">
      🤖 Ask me anything about <strong>UMU University, voting process, candidates</strong> and more.
      <div class="mt-2 text-md text-gray-400">Examples: <br>
        - I need help with voting?<br>
        - Can you assist me with UMU elections?<br>        
        -What is the mission of Horace Asiimwe?
        <!-- More button -->
        <button id="moreBtn" class="px-3 py-1 border border-blue-600 text-blue-600 rounded hover:bg-blue-600 hover:text-white focus:outline-none text-sm">
  More
</button>

      </div>
    </div>
  </div>

 <!-- Fancy Input Section -->
<div class="bg-white p-4 shadow-lg flex items-center rounded-xl border border-gray-200 mx-4 my-6 animate-fade-in-up">
  <!-- Input with Icon -->
  <div class="relative flex-1">
    <input id="user-input" type="text" placeholder="Ask me anything about Voting..." 
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
  bubble.className = `inline-block px-4 py-2 rounded-lg max-w-lg whitespace-pre-line ${bubbleClass}`;
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
    <div class="inline-block px-4 py-2 rounded-lg max-w-lg bg-gray-200 text-gray-800 animate-pulse">
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
  const response = await fetch("http://localhost:5005/webhooks/rest/webhook", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      sender: "user123", // can be any unique ID
      message: message    // the user's actual message
    }),
  });

  const data = await response.json();
  removeTyping();

  // Rasa may return multiple messages
  if (data && data.length > 0) {
    data.forEach(botMsg => {
      const reply = botMsg.text || "🤖 Sorry, no answer found.";
      appendMessage(reply, "bot");
    });
  } else {
    appendMessage("🤖 No response from Rasa.", "bot");
  }
} catch (err) {
  removeTyping();
  appendMessage("❌ Could not connect. Please try again later.", "bot");
}

  // try {
  //   const response = await fetch("http://127.0.0.1:7001/ask", {
  //     method: "POST",
  //     headers: { "Content-Type": "application/json" },
  //     body: JSON.stringify({ question: message })
  //   });

  //   const data = await response.json();
  //   removeTyping();

  //   const reply = data.answer || data.text || "🤖 Sorry, no answer found.";
  //   appendMessage(reply, "bot");

  // } catch (err) {
  //   removeTyping();
  //   appendMessage("❌ Could not connect to the server. Please try again later.", "bot");
  // }
}

  </script>
  <script>
    const moreBtn = document.getElementById('moreBtn');
    const popupModal = document.getElementById('popupModal');
    const closeBtn = document.getElementById('closeBtn');

    moreBtn.addEventListener('click', () => {
      popupModal.classList.remove('hidden');
    });

    closeBtn.addEventListener('click', () => {
      popupModal.classList.add('hidden');
    });

    // Close when clicking outside modal content
    popupModal.addEventListener('click', (e) => {
      if (e.target === popupModal) {
        popupModal.classList.add('hidden');
      }
    });
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
