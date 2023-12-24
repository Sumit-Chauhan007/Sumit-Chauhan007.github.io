const socket = io('http://127.0.0.1:3030');

const videoGrid = document.getElementById('video-grid');
const myVideo = document.createElement('video');
myVideo.muted = true;
const Mypeeers = {};
var peer = new Peer(undefined, {
    path: '/peerjs',
    host: '127.0.0.1',
    port: '3030',
    secure: false,
});
let myVideoStream;
navigator.mediaDevices
    .getUserMedia({
        audio: true,
        video: true,
    })
    .then((stream) => {
        myVideoStream = stream;
        addVideoStream(myVideo, stream);
        peer.on('call', (call) => {
            call.answer(stream);
            const video = document.createElement('video');
            call.on('stream', (userVideoStream) => {
                addVideoStream(video, userVideoStream);
            });
        });
        socket.on('user-connected', (userId) => {
            connectToNewUser(userId, stream);
        });
        socket.on('user-disconnected', (userId) => {
            if (Mypeeers[userId]) Mypeeers[userId].close();
        });
    });

const connectToNewUser = (userId, stream) => {

    navigator.mediaDevices
        .getUserMedia({
            audio: true,
            video: true,
        })
        .then((stream) => {
            myVideoStream = stream;
            addVideoStream(myVideo, stream);
            const call = peer.call(userId, stream);
            console.log('Call Object:', call);
            const video = document.createElement('video');
            call.on('stream', (userVideoStream) => {
                console.log('dsadsadsadsadsadsadsadsadsadsada');
                addVideoStream(video, userVideoStream);
            });
            call.on('close', () => {
                video.remove();
            });
            Mypeeers[userId] = call;
        });
};

peer.on('open', (id) => {
    socket.emit('join-room', ROOM_ID, id);
});
const addVideoStream = (video, stream) => {
    video.srcObject = stream;
    video.addEventListener('loadedmetadata', () => {
        video.play();
        videoGrid.append(video);
    });
    video.addEventListener('error', (event) => {
    });
};