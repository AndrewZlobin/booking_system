'use strict';

const typed = new Typed('.center h2', {
    strings: ["Забронируйте номер прямо сейчас!", "Устройте себе незабываемый отдых!", "Отдохните от тяжелых будней!"],
    typeSpeed: 30,
    loop: true,
    loopCount: Infinity,
    showCursor: false
});

$(function(){
    $("form").submit(function(event){
        event.preventDefault();
        const data = $(this).serializeArray();
        $.post('api/index.php', {
            data
        }).done(function (res) {
            alert('Заявка принята');
        }).fail(function(){
            alert('Ошибка отправки данных!');
        });
    })
});

const button = document.getElementById("leave--contacts");

button.addEventListener("click", noReload);

function noReload() {
    // button.preventDefault();
    const xhr = new XMLHttpRequest();
    const url = 'http://skillbox-landing/contacts.php';
    xhr.open('GET', '/', true);
    xhr.send();
    xhr.onreadystatechange = function() {
        if (this.status === 200) {
            location.assign(url);
        } else {
            alert( 'ошибка: ' + (this.status ? this.statusText : 'запрос не удался') );
        }
    };
}