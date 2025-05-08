// Statusy przycisków formatowania
let isBoldActive = false;
let isUnderlineActive = false;
let currentChannel = 'general'; // Domyślnie #general

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
    // Dodajemy parametr kanału do żądania
    fetch(`get_messages.php?channel=${currentChannel}`)
        .then(res => res.text())
        .then(html => {
            messagesDiv.innerHTML = html;
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        })
        .catch(err => console.error("Błąd ładowania wiadomości: ", err));
}

// Funkcja do wysyłania wiadomości
function sendMessage() {
    const username = usernameInput.value.trim();
    const message = inputText.innerHTML.trim();
    
    if (!message || !username) return;

    // Tworzymy obiekt FormData po sprawdzeniu danych
    const formData = new FormData();
    formData.append('username', username);
    formData.append('message', message);
    formData.append('channel', currentChannel); // Dodajemy informację o kanale
    
    // Pobieramy aktualny czas użytkownika
    const userTime = new Date();  // Czas lokalny użytkownika
    
    // Dodajemy offset strefy czasowej (-2 godziny), aby skompensować różnicę
    // gdy serwer PHP dodaje strefę czasową
    const offsetTime = new Date(userTime.getTime() + 2 * 60 * 60 * 1000);
    const localTime = offsetTime.toISOString();  // Zamiana na ISO string
    
    formData.append('created_at', localTime);  // Przesyłamy skorygowany czas użytkownika

    // Wyślij dane do serwera
    fetch('send_message.php', {
        method: 'POST',
        body: formData
    });

    inputText.innerHTML = '';  // Czyścimy pole wiadomości
}

// Obsługa wysyłania wiadomości po naciśnięciu Enter (bez Shift)
inputText.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault(); // Zapobiegamy domyślnej akcji (nowa linia)
        sendMessage();
    }
});

// Dodajemy obsługę przycisku do wysyłania (jeśli istnieje w HTML)
const sendButton = document.querySelector('.send-button');
if (sendButton) {
    sendButton.addEventListener('click', sendMessage);
}

// -------------------- PUSHER – NASŁUCH --------------------

const pusher = new Pusher('d48989b62b3e217f5781', {
    cluster: 'eu'
});

const channel = pusher.subscribe('chat');

// Pojedyncza obsługa zdarzenia new-message
channel.bind('new-message', function(data) {
    // Sprawdzamy, czy wiadomość należy do aktualnie wybranego kanału
    if (data.channel && data.channel !== currentChannel) return;

    const msg = document.createElement('div');
    msg.classList.add('message');
    msg.innerHTML = `<span class="user">${data.username}:</span> ${data.message} <span class="time">${formatTime(data.created_at)}</span>`;
    messagesDiv.appendChild(msg);
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
});

// -------------------- FUNKCJA FORMATOWANIA CZASU --------------------

function formatTime(dateStr) {
    const date = new Date(dateStr);

    if (isNaN(date)) {
        console.error("Niepoprawny czas:", dateStr);
        return "??:??";
    }

    // Usuwamy sztuczne dodanie 2 godzin
    const hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');

    return `${hours}:${minutes}`;
}

// -------------------- KANAŁY --------------------

// Obsługa przełączania między kanałami
document.querySelectorAll('.channel').forEach(channelEl => {
    channelEl.addEventListener('click', () => {
        // Usuwamy aktywną klasę z poprzednio wybranego kanału
        document.querySelector('.channel.active')?.classList.remove('active');
        
        // Dodajemy aktywną klasę do wybranego kanału
        channelEl.classList.add('active');
        
        currentChannel = channelEl.dataset.channel;
        document.querySelector('.chat-header span').textContent = `${currentChannel}`;
        loadMessages();
    });
});

// Dodawanie nowego kanału
document.querySelector('.add-channel').addEventListener('click', () => {
    const newChannel = prompt("Podaj nazwę nowego kanału:");
    if (!newChannel) return;

    const channelName = newChannel.trim().toLowerCase().replace(/\s+/g, '-');
    if (!channelName) return;

    // Sprawdzamy, czy kanał już istnieje
    const existingChannel = document.querySelector(`.channel[data-channel="${channelName}"]`);
    if (existingChannel) {
        alert("Ten kanał już istnieje!");
        return;
    }

    const channelDiv = document.createElement('div');
    channelDiv.classList.add('channel');
    channelDiv.setAttribute('data-channel', channelName);
    channelDiv.textContent = `${channelName}`;
    
    // Dodajemy obsługę kliknięcia dla nowego kanału
    channelDiv.addEventListener('click', () => {
        // Usuwamy aktywną klasę z poprzednio wybranego kanału
        document.querySelector('.channel.active')?.classList.remove('active');
        
        // Dodajemy aktywną klasę do wybranego kanału
        channelDiv.classList.add('active');
        
        currentChannel = channelName;
        document.querySelector('.chat-header span').textContent = ` ${currentChannel}`;
        loadMessages();
    });

    document.querySelector('.menu').appendChild(channelDiv);
});