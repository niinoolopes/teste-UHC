import firebase from 'firebase'

// Your web app's Firebase configuration
var firebaseConfig = {
  // apiKey: "AIzaSyBVwBKLU-M7ZJ96ttLdHfgPuda0KwTnU9g",
  // authDomain: "teste-htc.firebaseapp.com",
  // projectId: "teste-htc",
  // storageBucket: "teste-htc.appspot.com",
  // messagingSenderId: "1085217040510",
  // appId: "1:1085217040510:web:3e6e69aaedbe746271102f"
  
  apiKey: "AIzaSyBVwBKLU-M7ZJ96ttLdHfgPuda0KwTnU9g",
  authDomain: "teste-htc.firebaseapp.com",
  projectId: "teste-htc",
  storageBucket: "teste-htc.appspot.com",
  messagingSenderId: "1085217040510",
  appId: "1:1085217040510:web:8954d67107b3a91171102f"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
firebase.analytics();


export default firebase