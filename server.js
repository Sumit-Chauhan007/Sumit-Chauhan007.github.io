// server.js
const express = require('express');
const app = express();
const server = require('http').Server(app);
const { v4: uuidv4 } = require('uuid');
app.set('view engine', 'ejs');
const io = require('socket.io')(server, {
    cors: {
        origin: 'http://127.0.0.1:8000',
        methods: ['GET', 'POST'],
        credentials: true,
    },
});
const { ExpressPeerServer } = require('peer');
const peerServer = ExpressPeerServer(server, {
    debug: true,
});

app.use('/peerjs', peerServer);
app.use(express.static('public'));
app.get('/', (req, res) => {
    res.redirect(`/${uuidv4()}`);
});
app.get('/:room', (req, res) => {
    res.render('room', { roomId: req.params.room });
});
io.on('connection', (socket) => {
    console.log('connection');
    socket.on('join-room', (roomId, userId) => {
        console.log("-----------------------" + roomId);
        console.log(userId);
        socket.join(roomId);
        io.to(roomId).emit('user-connected', userId);
        // socket.to(roomId).broadcast.emit('user-connected', userId);
        socket.on('disconnect', () => {
            io.to(roomId).emit('user-disconnected', userId);
        });
    });
});
const PORT = 3030;
server.listen(PORT, () => {
    console.log(`Server listening on :${PORT}`);
});