let isBoldActive = false;
let isUnderlineActive = false;

const boldBtn = document.getElementById('bold');
const underlineBtn = document.getElementById('underline');
const emojiBtn = document.getElementById('emoji');
const emojiPicker = document.getElementById('emoji-picker');
const inputText = document.querySelector('.input-text');
const usernameInput = document.getElementById('username');
const messagesDiv = document.getElementById('messages');

// Formatowanie
boldBtn.addEventListener('click', () => {
    isBoldActive = !isBoldActive;
    document.execCommand('bold');
    boldBtn.classList.toggle('active', isBoldActive);
});

underlineBtn.addEventListener('click', () => {
    isUnderlineActive = !isUnderlineActive;
    document.execCommand('underline');
    underlineBtn.classList.toggle('active', isUnderlineActive);
});

emojiBtn.addEventListener('click', () => {
    emojiPicker.style.display = emojiPicker.style.display === 'block' ? 'none' : 'block';
});

document.querySelectorAll('.emoji-btn').forEach(button => {
    button.addEventListener('click', () => {
        inputText.focus();
        insertAtCaret(button.textContent);
        emojiPicker.style.display = 'none';
    });
});

function insertAtCaret(content) {
    const sel = window.getSelection();
    if (!sel.rangeCount) return;

    const range = sel.getRangeAt(0);
    range.deleteContents();
    range.insertNode(document.createTextNode(content));
    range.collapse(false);
    sel.removeAllRanges();
    sel.addRange(range);
}

// Ładowanie wiadomości
window.onload = loadMessages;

function loadMessages() {
    fetch('get_messages.php')
        .then(res => res.text())
        .then(html => {
            messagesDiv.innerHTML = html;
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        });
}

// Wysyłanie wiadomości
function sendMessage() {
    const username = usernameInput.value.trim();
    const message = inputText.innerHTML.trim();
    if (!message || !username) return;

    const formData = new FormData();
    formData.append('username', username);
    formData.append('message', message);

    fetch('send_message.php', {
        method: 'POST',
        body: formData
    });

    inputText.innerHTML = '';
}

// Pusher - nasłuch na nowe wiadomości
const pusher = new Pusher('YOUR_APP_KEY', {
    cluster: 'eu'
});

const channel = pusher.subscribe('chat');
channel.bind('new-message', function (data) {
    const msg = document.createElement('div');
    msg.classList.add('message');
    msg.innerHTML = `<span class="user">${data.username}:</span> ${data.message} <span class="time">${formatTime(data.created_at)}</span>`;
    messagesDiv.appendChild(msg);
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
});

function formatTime(dateStr) {
    const date = new Date(dateStr);
    return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
}