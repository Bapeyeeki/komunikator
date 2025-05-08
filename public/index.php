<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">Messenger</div>
            
            <div class="menu">
                <div class="channel active" data-channel="general">Ogólny</div>
                <div class="channel" data-channel="projekty">Projekty</div>
                <div class="channel" data-channel="wydarzenia">Wydarzenia</div>
            </div>
            <div class="add-channel">Dodaj nowy czat</div>
        </div>

        <div class="chat-area">
            <div class="chat-header">
                <span># Ogólny</span>
            </div>

            <div id="messages" class="messages">
                <!-- Wiadomości będą pojawiać się tutaj -->
            </div>

            <div class="message-input">
                <input type="text" id="username" class="username-input" placeholder="Twoja nazwa użytkownika">
                <div class="format-buttons">
                    <button id="bold" class="format-btn"><i class="fas fa-bold"></i></button>
                    <button id="underline" class="format-btn"><i class="fas fa-underline"></i></button>
                    <button id="emoji" class="format-btn"><i class="far fa-smile"></i></button>
                </div>
                <div class="input-wrapper">
                    <div class="input-text" contenteditable="true" placeholder="Aa"></div>
                    <button class="send-button" onclick="sendMessage()">
                        <svg viewBox="0 0 24 24" height="24" width="24">
                            <path d="M16.6915026,12.4744748 L3.50612381,13.2599618 C3.19218622,13.2599618 3.03521743,13.4170592 3.03521743,13.5741566 L1.15159189,20.0151496 C0.8376543,20.8006365 0.99,21.89 1.77946707,22.52 C2.41,22.99 3.50612381,23.1 4.13399899,22.8429026 L21.714504,14.0454487 C22.6563168,13.5741566 23.1272231,12.6315722 22.9702544,11.6889879 C22.8132856,11.0605983 22.3423792,10.4322088 21.714504,10.118014 L4.13399899,1.16346272 C3.34915502,0.9 2.40734225,1.00636533 1.77946707,1.4776575 C0.994623095,2.10604706 0.8376543,3.0486314 1.15159189,3.99121575 L3.03521743,10.4322088 C3.03521743,10.5893061 3.34915502,10.7464035 3.50612381,10.7464035 L16.6915026,11.5318905 C16.6915026,11.5318905 17.1624089,11.5318905 17.1624089,12.0031827 C17.1624089,12.4744748 16.6915026,12.4744748 16.6915026,12.4744748 Z" fill="currentColor"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="emoji-picker" class="emoji-picker" style="display: none;">
        <button class="emoji-btn">😊</button>
        <button class="emoji-btn">😂</button>
        <button class="emoji-btn">😍</button>
        <button class="emoji-btn">👍</button>
        <button class="emoji-btn">🎉</button>
        <button class="emoji-btn">👋</button>
        <button class="emoji-btn">❤️</button>
        <button class="emoji-btn">👌</button>
        <button class="emoji-btn">🙏</button>
        <button class="emoji-btn">🔥</button>
        <button class="emoji-btn">👏</button>
        <button class="emoji-btn">😎</button>
        <button class="emoji-btn">🤔</button>
        <button class="emoji-btn">😉</button>
        <button class="emoji-btn">🥰</button>
        <button class="emoji-btn">😁</button>
    </div>
    
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="script.js"></script>
</body>
</html>