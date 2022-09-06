importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js');



var firebaseConfig = {
    apiKey: "AIzaSyAmt7PRDsvu64bljAEjkAp46NDveSvbqGM",
    authDomain: "fcskill-16498.firebaseapp.com",
    projectId: "fcskill-16498",
    storageBucket: "fcskill-16498.appspot.com",
    messagingSenderId: "611858008160",
    appId: "1:611858008160:web:ddc836b441198ca27d9b05",
    measurementId: "G-90ZZEWMKQQ"
};

firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log(payload);
    const notification = JSON.parse(payload);
    const notificationOption = {
        body: notification.body,
        icon: notification.icon
    };
    return self.registration.showNotification(payload.notification.title, notificationOption);
});