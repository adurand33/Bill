// inits

let restyle = true;

let mycompany = document.querySelector("#inputCompany");
let myamount = document.querySelector("#inputAmount");
let mybilled = document.querySelector("#inputBilled");
let mydued = document.querySelector("#inputDued");
let mystatus = document.querySelector("#selectStatus");
let mysubmit = document.querySelector("#submitEdit");

// first

mycompany.addEventListener("input", stateEvent);
myamount.addEventListener("input", stateEvent);
mybilled.addEventListener("input", stateEvent);
mydued.addEventListener("input", stateEvent);
mystatus.addEventListener("input", stateEvent);

buttonize();

// event

function stateEvent() { buttonize(); }

// buttonize

function buttonize() {

  let hascompany = mycompany.value.toString() != '';
  let hasamount = myamount.value.toString() != '';
  let hasbilled = mybilled.value.toString() != '';
  let hasdued = mydued.value.toString() != '';
  let hasstatus = mystatus.value.toString() != '';

  mysubmit.disabled = !hascompany || !hasamount || !hasbilled || !hasdued || !hasstatus;

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