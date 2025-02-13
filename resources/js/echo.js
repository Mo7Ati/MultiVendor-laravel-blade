import Echo from 'laravel-echo';
import Pusher from "pusher-js";
import Swal from 'sweetalert2'

window.pusher = Pusher;

console.log('hi') ;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '9c8aa83bdd3c106a4b82',
    cluster: 'ap2',
    forceTLS: true
});

var channel = window.Echo.private(`App.Models.Admin.${userId}`);
channel.listen('.Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function (data) {
    console.log(data)
    Swal.fire({
        position: "top-end",
        icon: "info",
        title: data.body,
        showConfirmButton: true,
        timer: 10000
    });
});
