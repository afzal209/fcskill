importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');



var firebaseConfig = {
    apiKey: "AIzaSyBwXDk9x0OQWXoWxQrM1B87t4HO1fNOnSk",
    authDomain: "fcskill-3de1b.firebaseapp.com",
    databaseURL: "https://fcskill-3de1b-default-rtdb.firebaseio.com",
    projectId: "fcskill-3de1b",
    storageBucket: "fcskill-3de1b.appspot.com",
    messagingSenderId: "636149404949",
    appId: "1:636149404949:web:d122a083e58671f5d6c51c",
    measurementId: "G-WD5V69Z0LP"
};

firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    // console.log(payload);
    const notification = JSON.parse(payload);
    const notificationOption = {
        body: notification.body,
        icon: notification.icon
    };
    return self.registration.showNotification(payload.notification.title, notificationOption);
});