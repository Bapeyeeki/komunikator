document.getElementById('bold').addEventListener('click', function() {
    const textArea = document.querySelector('.input-text');
    const selectedText = textArea.value.substring(textArea.selectionStart, textArea.selectionEnd);
    textArea.setRangeText(`<b>${selectedText}</b>`);
});

document.getElementById('underline').addEventListener('click', function() {
    const textArea = document.querySelector('.input-text');
    const selectedText = textArea.value.substring(textArea.selectionStart, textArea.selectionEnd);
    textArea.setRangeText(`<u>${selectedText}</u>`);
});

document.getElementById('emoji').addEventListener('click', function() {
    const emojiPicker = document.getElementById('emoji-picker');
    // Zmieniamy widoczność panelu emotek
    emojiPicker.style.display = emojiPicker.style.display === 'block' ? 'none' : 'block';
});

document.querySelectorAll('.emoji-btn').forEach(button => {
    button.addEventListener('click', function() {
        const emoji = button.textContent;
        const textArea = document.querySelector('.input-text');
        textArea.value += emoji;
        // Ukrywamy panel emotek po kliknięciu
        document.getElementById('emoji-picker').style.display = 'none';
    });
});
