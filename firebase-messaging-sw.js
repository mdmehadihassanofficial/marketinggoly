// Import the Firebase scripts
importScripts("https://www.gstatic.com/firebasejs/10.11.1/firebase-app.js");
importScripts(
    "https://www.gstatic.com/firebasejs/10.11.1/firebase-messaging.js"
);

// Initialize the Firebase app in the service worker
const firebaseConfig = {
    apiKey: "AIzaSyCWIYecsREqPAlToy8KDuHIg8lqaPTxtnA",
    authDomain: "goly-final-project.firebaseapp.com",
    projectId: "goly-final-project",
    storageBucket: "goly-final-project.firebasestorage.app",
    messagingSenderId: "167423088874",
    appId: "1:167423088874:web:6d8865d9481fc05cb71f93",
    measurementId: "G-VE4VGRSKEW",
};

firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

// Handle background messages
messaging.onBackgroundMessage((payload) => {
    console.log("Received background message: ", payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.notification.icon || "/default-icon.png",
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
