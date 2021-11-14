// inits

let restyle = true;

let mypassword = document.querySelector("#inputPassword");
let mypassword2 = document.querySelector("#inputPassword2");
let mysubmit = document.querySelector("#submitPass");

// first

mypassword.addEventListener("input", stateEvent);
mypassword2.addEventListener("input", stateEvent);

buttonize();

// event

function stateEvent() { buttonize(); }

// buttonize

function buttonize() {

  let password = mypassword.value.toString();
  let password2 = mypassword2.value.toString();

  let haspassword = password != '';
  let haspassword2 = password2 != '';

  let hassame = haspassword && haspassword2 && password == password2;

  mysubmit.disabled = !haspassword || !haspassword2 || hassame;

  if (restyle) {

    if (mysubmit.disabled) {

      mysubmit.classList.remove('btn-success');
      mysubmit.classList.add('btn-danger');
    }
    else {

      mysubmit.classList.remove('btn-danger');
      mysubmit.classList.add('btn-success');
    }
  }
}