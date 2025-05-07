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

            <div class="messages">
                <div class="message user1">
                    <span class="user">Janek:</span> Cześć! Jak się macie?
                </div>
                <div class="message user2">
                    <span class="user">Anna:</span> Wszystko w porządku, a ty?
                </div>
            </div>

            <div class="message-input">
                <!-- Narzędzia formatowania -->
                <div class="format-buttons">
                    <button id="bold" class="format-btn"><b>B</b></button>
                    <button id="underline" class="format-btn"><u>U</u></button>
                    <button id="emoji" class="format-btn">😊</button>
                </div>
                <textarea placeholder="Napisz wiadomość..." class="input-text"></textarea>
                <button class="send-button">Wyślij</button>
            </div>
        </div>
    </div>

    <div id="emoji-picker" class="emoji-picker">
        <button class="emoji-btn">😊</button>
        <button class="emoji-btn">😂</button>
        <button class="emoji-btn">😍</button>
        <button class="emoji-btn">👍</button>
        <button class="emoji-btn">😢</button>
    </div>

    <script src="script.js"></script>
</body>
</html>
