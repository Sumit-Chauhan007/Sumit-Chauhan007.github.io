<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>videoChatApp</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.socket.io/4.6.0/socket.io.min.js"
        integrity="sha384-c79GN5VsunZvi+Q/WObgk2in0CbZsHnjEqvFxC5DxHn9lTfNce2WW6h2pH6u/kF+" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/c939d0e917.js"></script>
    <script src="https://unpkg.com/peerjs@1.3.1/dist/peerjs.min.js"></script>
    
    <script>
        const ROOM_ID = "123";
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 8vh;
            width: 100%;
            background-color: var(— main-darklg);
        }

        .logo>h3 {
            color: var(— main-light);
        }

        .main {
            overflow: hidden;
            height: 92vh;
            display: flex;
        }

        .main__left {
            flex: 0.7;
            display: flex;
            flex-direction: column;
        }

        .videos__group {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
            background-color: var(— main-dark);
        }

        video {
            height: 300px;
            border-radius: 1rem;
            margin: 0.5rem;
            width: 400px;
            object-fit: cover;
            transform: rotateY(180deg);
            -webkit-transform: rotateY(180deg);
            -moz-transform: rotateY(180deg);
        }

        .options {
            padding: 1rem;
            display: flex;
            background-color: var(— main-darklg);
        }

        .options__left {
            display: flex;
        }

        .options__right {
            margin-left: auto;
        }

        .options__button {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(— primary-color);
            height: 50px;
            border-radius: 5px;
            color: var(— main-light);
            font-size: 1.2rem;
            width: 50px;
            margin: 0 0.5rem;
        }

        .background__red {
            background-color: #f6484a;
        }

        .main__right {
            flex: 0.3;
            background-color: #242f41;
        }

        .main__chat_window {
            flex-grow: 1;
        }

        .main__message_container {
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main__message_container>input {
            height: 50px;
            flex: 1;
            border-radius: 5px;
            padding-left: 20px;
            border: none;
        }

        #video-grid {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">
            <h3>Video Chat</h2>
        </div>
    </div>
    <div class="main">
        <div class="main__left">
            <div class="videos__group">
                <div id="video-grid">

                </div>
            </div>
            <div class="options">
                <div class="options__left">
                    <div id="stopVideo" class="options__button">
                        <i class="fa fa-video-camera"></i>
                    </div>
                    <div id="muteButton" class="options__button">
                        <i class="fa fa-microphone"></i>
                    </div>
                </div>
                <div class="options__right">
                    <div id="inviteButton" class="options__button">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="main__right">
            <div class="main__chat_window">
                <div class="messages">

                </div>
            </div>
            <div class="main__message_container">
                <input id="chat_message" type="text" autocomplete="off" placeholder="Type message here...">
                <div id="send" class="options__button">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="script.js"></script>

</html>
