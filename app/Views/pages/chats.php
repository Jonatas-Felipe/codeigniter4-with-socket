<?php
    $session = session(); 
    $user_id = $session->user->id;
?>

<div class="row">
    <div class="col-lg-9" style="height: 90vh; overflow-y: auto;">
        <h1 class="mb-3">Conversas</h1>
        <div id="conversas"></div>
    </div>
    <div class="col-lg-3" style="height: 90vh; overflow-y: auto;">
        <h3 class="mb-3">Outros usuários</h3>
        <div id="otherUsers"></div>
    </div>
</div>

<script>
    $.ajax({
        url: "<?= base_url("chats/$user_id") ?>",
        success: function(result){
            if(result.length > 0){
                const chats = result;
                for(chat of chats){
                    const name = <?= $user_id ?> == chat.id1 ? chat.name2 : chat.name1;
                    $('#conversas').append(`
                        <a 
                            class="row mb-2"
                            href="<?= base_url('conversa') ?>/${chat.user_id}/${chat.id_user}"
                        >
                            <div class="col-lg-1">
                                <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=${name}" alt="${name}">
                            </div>
                            <div class="col-lg-5">
                                <h5>${name}</h5>
                                <p>${chat.message ? chat.message : ''}</p>
                            </div>
                        </a>
                    `);
                }
            } else{
                $('#conversas').append(`<h2>Nenhuma conversa ainda</h2>`);
            }
        }
    });

    $.ajax({
        url: "<?= base_url("otherUsers/$user_id") ?>",
        success: function(result){
            if(result.length > 0){
                const otherUsers = result;
                for(otherUser of otherUsers){
                    $('#otherUsers').append(`
                        <a 
                            class="row mb-2"
                            href="<?= base_url('conversa') ?>/<?= $user_id ?>/${otherUser.id}"
                        >
                            <div class="col-lg-3">
                                <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=${otherUser.name}" alt="${otherUser.name}">
                            </div>
                            <div class="col-lg-9">
                                <h5>${otherUser.name}</h5>
                            </div>
                        </a>
                    `);
                }
            } else{
                $('#otherUsers').append(`<h4>Nenhuma outro usuário ainda</h4>`);
            }
        }
    });
</script>