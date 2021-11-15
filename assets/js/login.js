// inits

let restyle = true;

let myemail = document.querySelector('#inputEmail');
let mypassword = document.querySelector('#inputPassword');
let mysubmit = document.querySelector('#submitLogin');

// first

myemail.addEventListener('input', stateEvent);
mypassword.addEventListener('input', stateEvent);

buttonize();

// event

function stateEvent() { buttonize(); }

// buttonize

function buttonize() {

  let hasemail = myemail.value.toString() != '';
  let haspassword = mypassword.value.toString() != '';

  mysubmit.disabled = !hasemail || !haspassword;

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