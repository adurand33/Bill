// inits

let address = window.location.href;
let tempaddress = address.split("?")[0];

// change url

ChangeUrl(address, tempaddress);

//

function ChangeUrl(page, url) {

  if (address == tempaddress) return;

  if (typeof (history.pushState) != "undefined") {

    let obj = {Page: page, Url: url};

    history.pushState(obj, obj.Page, obj.Url);
  }
  else {

    window.location.href = "homePage";
  }
}
