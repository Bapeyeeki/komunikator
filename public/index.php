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
        <!-- Pasek boczny -->
        <div class="sidebar">
            <div class="logo">Komunikator</div>
            <div class="menu">
                <div class="channel"># general</div>
                <div class="channel"># projekty</div>
                <div class="channel"># wydarzenia</div>
            </div>
            <div class="add-channel">+ Dodaj kanał</div>
        </div>

        <!-- Obszar czatu -->
        <div class="chat-area">
            <div class="chat-header">
                <span># general</span>
            </div>

            <div id="messages" class="messages">
                <!-- Wiadomości będą pojawiać się tutaj -->
            </div>

            <div class="message-input">
                <!-- Input do wpisania nicku -->
                <input type="text" id="username" class="username-input" placeholder="Twoja nazwa użytkownika">

                <!-- Narzędzia formatowania -->
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

    <!-- Panel emoji -->
    <div id="emoji-picker" class="emoji-picker" style="display: none;">
        <button class="emoji-btn">😊</button>
        <button class="emoji-btn">😂</button>
        <button class="emoji-btn">😍</button>
        <button class="emoji-btn">👍</button>
        <button class="emoji-btn">😢</button>
    </div>

    <script src="script.js"></script>
</body>
</html>
