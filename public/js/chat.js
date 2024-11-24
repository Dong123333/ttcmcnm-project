const chatMessages = document.getElementById("chat-messages");
const messageInput = document.getElementById("message-input");
const sendButton = document.getElementById("send-button");

// Placeholder data
const messages = [
  { type: "received", text: "Haha, ốp lưng của m định vàng hay kim cương vậy" },
  { type: "sent", text: "mua ốp lưng tặng coin meme đi" },
  { type: "received", text: "Dạ, nào anh làm cho em hùn vốn với" },
];

// Function to display messages
function renderMessages() {
  chatMessages.innerHTML = "";
  messages.forEach((msg) => {
    const messageDiv = document.createElement("div");
    messageDiv.classList.add("message", msg.type);
    messageDiv.innerText = msg.text;
    chatMessages.appendChild(messageDiv);
  });
  chatMessages.scrollTop = chatMessages.scrollHeight;
}

// Send message
sendButton.addEventListener("click", () => {
  const text = messageInput.value.trim();
  if (text) {
    messages.push({ type: "sent", text });
    messageInput.value = "";
    renderMessages();
  }
});

// Initial render
renderMessages();
