<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komunikator</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">Komunikator</div>
            <div class="menu">
            <div class="channel" data-channel="general"># general</div>
            <div class="channel" data-channel="projekty"># projekty</div>
            <div class="channel" data-channel="wydarzenia"># wydarzenia</div>

            </div>
            <div class="add-channel">+ Dodaj kanał</div>
        </div>

        <div class="chat-area">
            <div class="chat-header">
                <span># general</span>
            </div>

            <div id="messages" class="messages">
                <!-- Wiadomości będą pojawiać się tutaj -->
            </div>

            <div class="message-input">
                <input type="text" id="username" class="username-input" placeholder="Twoja nazwa użytkownika">
                <div class="format-buttons">
                    <button id="bold" class="format-btn"><b>B</b></button>
                    <button id="underline" class="format-btn"><u>U</u></button>
                    <button id="emoji" class="format-btn">😊</button>
                </div>
                <div class="input-text" contenteditable="true" placeholder="Napisz wiadomość..."></div>
                <button class="send-button" onclick="sendMessage()">Wyślij</button>
            </div>
        </div>
    </div>

    <div id="emoji-picker" class="emoji-picker" style="display: none;">
        <button class="emoji-btn">😊</button>
        <button class="emoji-btn">😂</button>
        <button class="emoji-btn">😍</button>
        <button class="emoji-btn">👍</button>
    </div>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="script.js"></script>
</body>
</html>