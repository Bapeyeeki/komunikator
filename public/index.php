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

<<<<<<< HEAD
            <div id="messages" class="messages">
                <!-- Wiadomości będą pojawiać się tutaj -->
=======
            <!-- Kontener na wiadomości -->
            <div class="messages" id="messages">
                <!-- Wiadomości będą dynamicznie ładowane przez JS -->
>>>>>>> 2cde95f8617b93fde80ded93dc04101d6a259681
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
<<<<<<< HEAD
                <div class="input-text" contenteditable="true" placeholder="Napisz wiadomość..."></div>
=======

                <!-- Pole do wpisania wiadomości -->
                <textarea placeholder="Napisz wiadomość..." class="input-text"></textarea>
>>>>>>> 2cde95f8617b93fde80ded93dc04101d6a259681
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