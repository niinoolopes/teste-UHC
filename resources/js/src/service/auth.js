import firebase from '../config/firebase-config'

export const socialMediaAuth = (provider) => {

  let firebaseConfig = {
    githubProvider: new firebase.auth.GithubAuthProvider(),
    googleProvider: new firebase.auth.GoogleAuthProvider(),
  }

  return firebase
    .auth()
    .signInWithPopup(firebaseConfig[provider])
    .then((res) => {
      return res.user
    })
    .catch(er => {
      return er
    })
}