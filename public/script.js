// Statusy przycisków formatowania
let isBoldActive = false;
let isUnderlineActive = false;

// Pobieramy przyciski formatowania
const boldBtn = document.getElementById('bold');
const underlineBtn = document.getElementById('underline');
const emojiBtn = document.getElementById('emoji');
const emojiPicker = document.getElementById('emoji-picker');
const inputText = document.querySelector('.input-text');  // Edytor tekstu

// Funkcja do przełączania pogrubienia
boldBtn.addEventListener('click', function () {
    isBoldActive = !isBoldActive;
    if (isBoldActive) {
        document.execCommand('bold');
    } else {
        document.execCommand('removeFormat');  // Usuwanie pogrubienia
    }
    boldBtn.classList.toggle('active', isBoldActive);
});

// Funkcja do przełączania podkreślenia
underlineBtn.addEventListener('click', function () {
    isUnderlineActive = !isUnderlineActive;
    if (isUnderlineActive) {
        document.execCommand('underline');
    } else {
        document.execCommand('removeFormat');  // Usuwanie podkreślenia
    }
    underlineBtn.classList.toggle('active', isUnderlineActive);
});

// Pokaz/ukryj emotki
emojiBtn.addEventListener('click', function () {
    emojiPicker.style.display = emojiPicker.style.display === 'block' ? 'none' : 'block';
});

// Kliknięcie na emotkę
document.querySelectorAll('.emoji-btn').forEach(button => {
    button.addEventListener('click', function () {
        // Upewnijmy się, że edytor ma fokus przed dodaniem emoji
        inputText.focus();
        
        const emoji = button.textContent;
        insertAtCaret(emoji);  // Wstawianie emoji w miejscu kursora
        emojiPicker.style.display = 'none';  // Ukrywa panel emotek po wyborze
    });
});

// Funkcja wstawiania emoji w miejsce kursora w edytorze tekstu
function insertAtCaret(content) {
    const sel = window.getSelection();
    
    if (!sel.rangeCount) return;

    const range = sel.getRangeAt(0);  // Pobierz zakres zaznaczenia
    range.deleteContents(); // Usuwa zaznaczoną treść
    range.insertNode(document.createTextNode(content)); // Wstawia emoji lub tekst

    // Przesuń kursor za wstawionym emoji
    range.setStartAfter(range.endContainer);
    range.setEndAfter(range.endContainer);
    sel.removeAllRanges();
    sel.addRange(range);
}

// Funkcja wysyłania wiadomości
function sendMessage() {
    const username = document.getElementById('username').value;  // Pobranie nazwy użytkownika
    const messageHTML = inputText.innerHTML.trim();  // Pobranie treści wiadomości w HTML

    if (!messageHTML || !username) return;  // Sprawdzamy, czy wiadomość i nazwa użytkownika nie są puste

    // Dodanie wiadomości do widoku
    const messagesDiv = document.getElementById('messages');
    const messageDiv = document.createElement('div');
    messageDiv.className = 'message user1';
    messageDiv.innerHTML = `<span class="user">${username}:</span> ${messageHTML}`;

    messagesDiv.appendChild(messageDiv);

    // Wysłanie wiadomości do serwera (PHP)
    const formData = new FormData();
    formData.append('username', username);
    formData.append('message', messageHTML);

    fetch('send_message.php', {
        method: 'POST',
        body: formData
    })
    .then(() => {
        inputText.innerHTML = '';  // Czyści pole tekstowe po wysłaniu
        messagesDiv.scrollTop = messagesDiv.scrollHeight;  // Przewija do ostatniej wiadomości
    })
    .catch(err => console.error('Błąd podczas wysyłania wiadomości:', err));
}

// Automatyczne ładowanie wiadomości co 2 sekundy
setInterval(loadMessages, 2000);

// Pierwsze załadowanie wiadomości po załadowaniu strony
window.onload = loadMessages;

function convertTimestamps() {
    document.querySelectorAll('.message .time').forEach(span => {
        const utcTime = span.getAttribute('data-time'); // pobiera np. "2024-05-07T10:30:00+00:00"
        if (!utcTime) return;

        const date = new Date(utcTime);
        const localTime = date.toLocaleString(); // format lokalny użytkownika
        span.textContent = ` (${localTime})`;
    });
}
// Uruchom po załadowaniu wiadomości
function loadMessages() {
    fetch('get_messages.php')
        .then(response => response.text())
        .then(data => {
            const messagesDiv = document.getElementById('messages');
            messagesDiv.innerHTML = data;
            convertTimestamps(); // Przelicz czas po wczytaniu wiadomości
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        });
}