// inits

let mytext = '';
let myoption = '';

let myalert = document.querySelector('#userAlert');

// customize alert

if (myalert != null) {

  mytext = myalert.textContent;
  myoption = myalert.getAttribute('data');
}

// modify alert

if (myoption != '' && mytext != '') {

  myalert.textContent = myalert.innerHTML = '';

  let inner = '';

  inner += `<div class="alert alert-`;
  inner += myoption == 'success' ? 'success' : ((myoption == 'info') ? 'primary' : (myoption == 'warning') ? 'warning' : 'danger');
  inner += ` d-flex align-items-center" role="alert">`;

  inner += `<svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="`;
  inner += myoption == 'success' ? '#warn-success' : ((myoption == 'info') ? '#warn-info' : '#warn-error');
  inner += `"/></svg>`;
  inner += `<div>${mytext}</div></div>`;

  myalert.innerHTML = inner;
}
