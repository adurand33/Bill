// inits

let restyle = true;

let myemail = document.querySelector("#inputEmail");
let mypseudo = document.querySelector("#inputPseudo");
let mypassword = document.querySelector("#inputPassword");
let mypassword2 = document.querySelector("#inputPassword2");
let mysubmit = document.querySelector("#submitRegister");

// first

myemail.addEventListener("input", stateEvent);
mypseudo.addEventListener("input", stateEvent);
mypassword.addEventListener("input", stateEvent);
mypassword2.addEventListener("input", stateEvent);

buttonize();

// event

function stateEvent() { buttonize(); }

// buttonize

function buttonize() {

  let hasemail = myemail.value.toString() != '';
  let haspseudo = mypseudo.value.toString() != '';

  let password = mypassword.value.toString();
  let password2 = mypassword2.value.toString();

  let haspassword = password != '';
  let haspassword2 = password2 != '';

  let hassame = haspassword && haspassword2 && password == password2;

  mysubmit.disabled = !hasemail || !haspassword || !hassame;

  if (restyle) {

    if (mysubmit.disabled) {

      mysubmit.classList.remove('btn-success');
      mysubmit.classList.add('btn-primary');
    }
    else {

      mysubmit.classList.remove('btn-primary');
      mysubmit.classList.add('btn-success');
    }
  }
}