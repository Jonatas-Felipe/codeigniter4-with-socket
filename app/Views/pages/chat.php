<?php
    $session = session(); 
    $myId = $session->user->id;
    $myUserName = $session->user->name;
    $recipient_id = $myId === $user_id ? $id_user : $user_id;
    $recipientUserName = $myId == $conversa->user1Id ? $conversa->user2Name : $conversa->user1Name;
?>

<div class="row">
    <div class="col-12" id="scroll" style="overflow-y: auto; height: 75vh;">
        <h1 class="mb-3">Conversa</h1>
        <div id="messages"></div>
    </div>
</div>

<form id="chat" action="<?= base_url("message/$myId/$recipient_id") ?>" method="POST" class="row mt-2 align-items-center">
    <div class="col-lg-10">
        <textarea id="message" name="message" class="form-control" style="resize: none"></textarea>
    </div>
    <div class="col-lg-2">
        <button type="submit" class="btn btn-primary w-100">Enviar</button>
    </div>
</form>

<script>
    $('#message').keyup(function(event){
        if(event.keyCode === 13){
            event.preventDefault();
            $('#chat').trigger('submit');
        }
    });

    $.ajax({
        url: "<?= base_url("chat/$user_id/$id_user") ?>",
        success: function(result){
            if(result.length > 0){
                const messages = result;
                for(message of messages){
                    if(<?= $myId ?> == message.user_id){
                        $('#messages').append(`
                            <div class="row mb-2 justify-content-center">
                                <div class="col-lg-10">
                                    <p class="text-right">${message.message}</p>
                                </div>
                                <div class="col-lg-1">
                                    <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=<?=$myUserName?>" alt="<?= $myUserName ?>">
                                </div>
                            </div>
                        `);
                    }else{
                        $('#messages').append(`
                            <div class="row mb-2 justify-content-center">
                                <div class="col-lg-1">
                                    <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=<?=$recipientUserName?>" alt="<?= $recipientUserName ?>">
                                </div>
                                <div class="col-lg-10">
                                    <p>${message.message}</p>
                                </div>
                            </div>
                        `);
                    }
                }
                $('#scroll').scrollTop(10000);
            } else{
                $('#messages').append(`<h2 id="no-messages">Nenhuma mensagem ainda</h2>`);
            }
        }
    });

    var conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function(e) {
        console.log("Connection established!");
    };

    conn.onmessage = function(e) {
        data = JSON.parse(e.data);
        $('#no-messages').css('display', 'none');
        if(<?= $myId ?> == data.user_id){
            $('#messages').append(`
                <div class="row mb-2 justify-content-center">
                    <div class="col-lg-10">
                        <p class="text-right">${data.message}</p>
                    </div>
                    <div class="col-lg-1">
                        <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=<?=$myUserName?>" alt="<?= $myUserName ?>">
                    </div>
                </div>
            `);
        }else if(<?= $recipient_id ?> == data.user_id){
            $('#messages').append(`
                <div class="row mb-2 justify-content-center">
                    <div class="col-lg-1">
                        <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=<?=$recipientUserName?>" alt="<?= $recipientUserName ?>">
                    </div>
                    <div class="col-lg-10">
                        <p>${data.message}</p>
                    </div>
                </div>
            `);
        }
        $("#scroll").animate({ scrollTop: 10000 }, 1000);
    };
</script>