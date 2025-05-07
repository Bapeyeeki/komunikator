// Pogrubienie
document.getElementById('bold').addEventListener('click', function() {
    const textArea = document.querySelector('.input-text');
    const selectedText = textArea.value.substring(textArea.selectionStart, textArea.selectionEnd);
    textArea.setRangeText(`<b>${selectedText}</b>`);
});

// Podkreślenie
document.getElementById('underline').addEventListener('click', function() {
    const textArea = document.querySelector('.input-text');
    const selectedText = textArea.value.substring(textArea.selectionStart, textArea.selectionEnd);
    textArea.setRangeText(`<u>${selectedText}</u>`);
});

// Pokaz/ukryj emotki
document.getElementById('emoji').addEventListener('click', function() {
    const emojiPicker = document.getElementById('emoji-picker');
    emojiPicker.style.display = emojiPicker.style.display === 'block' ? 'none' : 'block';
});

// Kliknięcie na emotkę
document.querySelectorAll('.emoji-btn').forEach(button => {
    button.addEventListener('click', function() {
        const emoji = button.textContent;
        const textArea = document.querySelector('.input-text');
        textArea.value += emoji;
        document.getElementById('emoji-picker').style.display = 'none';
    });
});

// Wysyłanie wiadomości
function sendMessage() {
    const message = document.querySelector('.input-text').value.trim();
    const username = "Anon"; // Możesz to zmienić na input

    if (!message) return;

    const formData = new FormData();
    formData.append('username', username);
    formData.append('message', message);

    fetch('send_message.php', {
        method: 'POST',
        body: formData
    }).then(() => {
        document.querySelector('.input-text').value = '';
        loadMessages();
    });
}

// Pobieranie wiadomości
function loadMessages() {
    fetch('get_messages.php')
        .then(response => response.text())
        .then(data => {
            const messagesDiv = document.getElementById('messages');
            messagesDiv.innerHTML = data;
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        });
}

// Autoładowanie wiadomości co 2 sekundy
setInterval(loadMessages, 2000);
window.onload = loadMessages;