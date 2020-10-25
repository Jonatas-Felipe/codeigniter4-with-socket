var conn = new WebSocket('ws://localhost:8080');
conn.onopen = function(e) {
    console.log("Connection established!");
};

conn.onmessage = function(e) {
    alert(e.data);
};

var data = {
    message: "Olá",
    user_id: 1,
    recipient_id: 2,
    chat_id: 1
}

data = JSON.stringify(data); 

conn.send(data);