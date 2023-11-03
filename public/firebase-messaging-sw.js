/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js');
   
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
 firebase.initializeApp({
    apiKey: "AIzaSyCKKm-u3jshvWXiV9Eu6bG_00K7obR6YHM",
    authDomain: "testing-send-message-b808e.firebaseapp.com",
    projectId: "testing-send-message-b808e",
    storageBucket: "testing-send-message-b808e.appspot.com",
    messagingSenderId: "945924315420",
    appId: "1:945924315420:web:055b8ea15aaa1b959dc2d9",
    measurementId: "G-ZZ3KE8V32K"
  });
  
/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    /* Customize notification here */
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };
  
    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});
