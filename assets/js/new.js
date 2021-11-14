// inits

let restyle = true;

let mycompany = document.querySelector("#inputCompany");
let myemail = document.querySelector("#inputEmail");
let myaddress = document.querySelector("#inputAddress");
let myamount = document.querySelector("#inputAmount");
let mydued = document.querySelector("#inputDued");
let mystatus = document.querySelector("#selectStatus");
let mysubmit = document.querySelector("#submitNew");

// first

mycompany.addEventListener("input", stateEvent);
myemail.addEventListener("input", stateEvent);
myaddress.addEventListener("input", stateEvent);
myamount.addEventListener("input", stateEvent);
mydued.addEventListener("input", stateEvent);
mystatus.addEventListener("input", stateEvent);

buttonize();

// event

function stateEvent() { buttonize(); }

// buttonize

function buttonize() {

  let hascompany = mycompany.value.toString() != '';
  let hasemail = myemail.value.toString() != '';
  let hasaddress = myaddress.value.toString() != '';
  let hasamount = myamount.value.toString() != '';
  let hasdued = mydued.value.toString() != '';
  let hasstatus = mystatus.value.toString() != '';

  mysubmit.disabled = !hascompany || !hasemail || !hasaddress || !hasamount || !hasdued || !hasstatus;

  if (restyle) {

    if (mysubmit.disabled) {

      mysubmit.classList.remove('btn-primary');
      mysubmit.classList.add('btn-danger');
    }
    else {

      mysubmit.classList.remove('btn-danger');
      mysubmit.classList.add('btn-primary');
    }
  }
}
