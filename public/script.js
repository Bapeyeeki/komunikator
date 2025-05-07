// Statusy przycisków formatowania
let isBoldActive = false;
let isUnderlineActive = false;

// Przełączniki pogrubienia
const boldBtn = document.getElementById('bold');
const underlineBtn = document.getElementById('underline');
const emojiBtn = document.getElementById('emoji');
const emojiPicker = document.getElementById('emoji-picker');

// Funkcja do przełączania pogrubienia
boldBtn.addEventListener('click', function () {
    isBoldActive = !isBoldActive;
    document.execCommand('bold');
    boldBtn.classList.toggle('active', isBoldActive);
});

// Funkcja do przełączania podkreślenia
underlineBtn.addEventListener('click', function () {
    isUnderlineActive = !isUnderlineActive;
    document.execCommand('underline');
    underlineBtn.classList.toggle('active', isUnderlineActive);
});

// Pokaz/ukryj emotki
emojiBtn.addEventListener('click', function () {
    emojiPicker.style.display = emojiPicker.style.display === 'block' ? 'none' : 'block';
});

// Kliknięcie na emotkę
document.querySelectorAll('.emoji-btn').forEach(button => {
    button.addEventListener('click', function () {
        const emoji = button.textContent;
        insertAtCaret(emoji);
        emojiPicker.style.display = 'none';
    });
});

// Wstawianie emotek
function insertAtCaret(content) {
    const sel = window.getSelection();
    if (!sel.rangeCount) return;

    const range = sel.getRangeAt(0);
    range.deleteContents();
    range.insertNode(document.createTextNode(content));

    // Przesuń kursor za wstawionym emoji
    range.setStartAfter(range.endContainer);
    range.setEndAfter(range.endContainer);
    sel.removeAllRanges();
    sel.addRange(range);
}

// Wysyłanie wiadomości
function sendMessage() {
    const input = document.querySelector('.input-text');
    const messageHTML = input.innerHTML.trim();

    if (!messageHTML) return;

    const messagesDiv = document.getElementById('messages');
    const messageDiv = document.createElement('div');
    messageDiv.className = 'message user1';
    messageDiv.innerHTML = `<span class="user">Ty:</span> ${messageHTML}`;

    messagesDiv.appendChild(messageDiv);
    input.innerHTML = '';  // Czyści input po wysłaniu
    messagesDiv.scrollTop = messagesDiv.scrollHeight;  // Przewija do ostatniej wiadomości
}