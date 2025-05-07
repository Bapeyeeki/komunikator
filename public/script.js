// Statusy przycisków formatowania
let isBoldActive = false;
let isUnderlineActive = false;

// Elementy DOM
const boldBtn = document.getElementById('bold');
const underlineBtn = document.getElementById('underline');
const emojiBtn = document.getElementById('emoji');
const emojiPicker = document.getElementById('emoji-picker');
const inputText = document.querySelector('.input-text');
const usernameInput = document.getElementById('username');
const messagesDiv = document.getElementById('messages');

// -------------------- FORMATOWANIE --------------------

// Pogrubienie
boldBtn.addEventListener('click', () => {
    isBoldActive = !isBoldActive;
    document.execCommand('bold');
    boldBtn.classList.toggle('active', isBoldActive);
});

// Podkreślenie
underlineBtn.addEventListener('click', () => {
    isUnderlineActive = !isUnderlineActive;
    document.execCommand('underline');
    underlineBtn.classList.toggle('active', isUnderlineActive);
});

// Emotki - pokaż/ukryj
emojiBtn.addEventListener('click', () => {
    emojiPicker.style.display = emojiPicker.style.display === 'block' ? 'none' : 'block';
});

// Wstawienie emotki
document.querySelectorAll('.emoji-btn').forEach(button => {
    button.addEventListener('click', () => {
        inputText.focus();
        insertAtCaret(button.textContent);
        emojiPicker.style.display = 'none';
    });
});

// Wstawianie w miejscu kursora
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

// -------------------- WIADOMOŚCI --------------------

// Wczytaj wiadomości z bazy na start
window.onload = loadMessages;

function loadMessages() {
    fetch('get_messages.php')
        .then(res => res.text())
        .then(html => {
            messagesDiv.innerHTML = html;
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        });
}

// Funkcja do wysyłania wiadomości
function sendMessage() {
    const username = usernameInput.value.trim();
    const message = inputText.innerHTML.trim();

    // Pobieramy aktualny czas użytkownika
    const userTime = new Date();  // Czas lokalny użytkownika
    const localTime = userTime.toISOString();  // Zamiana na ISO string (np. 2025-05-07T13:30:00.000Z)

    if (!message || !username) return;

    const formData = new FormData();
    formData.append('username', username);
    formData.append('message', message);
    formData.append('created_at', localTime);  // Przesyłamy lokalny czas użytkownika

    fetch('send_message.php', {
        method: 'POST',
        body: formData
    });

    inputText.innerHTML = '';  // Czyścimy pole wiadomości
}

// -------------------- PUSHER – NASŁUCH --------------------

const pusher = new Pusher('d48989b62b3e217f5781', {
    cluster: 'eu'
});

const channel = pusher.subscribe('chat');
// Nasłuchiwanie na wiadomości przychodzące przez Pusher
channel.bind('new-message', function(data) {
    const msg = document.createElement('div');
    msg.classList.add('message');
    msg.innerHTML = `<span class="user">${data.username}:</span> ${data.message} <span class="time">${formatTime(data.created_at)}</span>`;
    messagesDiv.appendChild(msg);
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
});

// -------------------- FUNKCJA FORMATOWANIA CZASU --------------------

// Funkcja formatująca czas w lokalnej strefie czasowej użytkownika
function formatTime(dateStr) {
    const date = new Date(dateStr); // Tworzymy obiekt Date z daty przesłanej z serwera (lub z lokalnego czasu)

    // Sprawdzamy, czy czas jest prawidłowy
    if (isNaN(date)) {
        console.error("Niepoprawny czas");
        return;
    }

    // Ustawiamy strefę czasową użytkownika
    const options = {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false, // Użyj 24-godzinnego formatu
        timeZoneName: 'short' // Dodaje nazwę strefy czasowej
    };

    return date.toLocaleTimeString([], options); 
}