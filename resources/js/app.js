require('./bootstrap');
// script.js

document.getElementById('send-button').addEventListener('click', function () {
    const inputField = document.getElementById('chat-input');
    const messageText = inputField.value.trim();

    if (messageText !== '') {
        const chatMessages = document.getElementById('chat-messages');
        const newMessage = document.createElement('div');
        newMessage.classList.add('message');
        newMessage.innerHTML = `<p><strong>You:</strong> ${messageText}</p>`;
        chatMessages.appendChild(newMessage);

        // Clear input field
        inputField.value = '';

        // Auto-scroll to the bottom
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
});
