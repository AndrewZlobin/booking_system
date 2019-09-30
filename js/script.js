'use strict';

$(document).ready(function(){
    $('#contacts').mask('+7(000) 000-00-00');
});

$(function(){
    $("form").submit(function(event){
        event.preventDefault();
        const data = $(this).serializeArray();
        $.post('api/leave-contacts.php', {
            data
        }).done(function (res) {
            alert('Мы Вам перезвоним!');
            // console.log(res);
        }).fail(function(){
            alert('Мы не сможем Вам перезвонить!');
        });
    })
});