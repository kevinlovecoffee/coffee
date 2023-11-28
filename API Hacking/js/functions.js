// get an updated list of available coffee
const getCoffee = async () => {
const response = await fetch('v1/coffee.php');
const myJson = await response.json();
    // update page
    select = document.getElementById('coffeeList1');
    for (let i = 0; i < myJson.length; i++) {
        let opt = document.createElement('option');
        opt.value = i;
        opt.innerHTML = myJson[i].name;
        select.appendChild(opt);
    }
}

function parseJwt(token) {
    let base64Url = token.split('.')[1];
    let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    let jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
}

// ordering coffee
const orderCoffee = async () => {
let formEmail = document.getElementById('inputEmail1').value;
let formCoffee = document.getElementById("coffeeList1").value;
let formQuantity = document.querySelector('input[name="inlineRadioOptions"]:checked').value;
let uri = 'v1/order.php?email=' + formEmail + '&coffee=' + formCoffee + '&q=' + formQuantity;
const response = await fetch(uri);
const coffeeJson = await response.json();
    // update with response
    // clear the modal
    document.getElementById('modal-order').innerHTML = "";
    // display the results

    modalContainer = document.getElementById('modal-order');
    let head = document.createElement('h2');
    let para = document.createElement('p');
    document.getElementById("place-order-btn").style.display = "none";
    head.innerHTML = coffeeJson.status;
    modalContainer.appendChild(head);
    if (coffeeJson.orderID) {
        para.innerHTML = 'Your order ID: ' + coffeeJson.orderID;
        modalContainer.appendChild(para);
    }
}

// tracking order
const checkOrder = async () => {
let inputTrack = document.getElementById('inputTrack').value;
let uri = 'v1/track.php?id=' + inputTrack;
const response = await fetch(uri);
const trackJson = await response.json();
    // update with response
    // clear the modal
    document.getElementById('tracking-modal').innerHTML = "";
    // display the results
    modalContainer = document.getElementById('tracking-modal');
    let head = document.createElement('h2');
    let para1 = document.createElement('p');
    let para2 = document.createElement('p');
    head.innerHTML = trackJson.status;
    modalContainer.appendChild(head);
    if (trackJson.email) {
        para1.innerHTML = 'Username: ' + trackJson.email;
        para2.innerHTML = 'Status: ' + trackJson.tracking_status;
        modalContainer.appendChild(para1);
        modalContainer.appendChild(para2);
    }
}

// register account
const registerAccount = async () => {
    let formRegisterUsername = document.getElementById('inputRegisterUsername').value;
    let formRegisterPassword = document.getElementById("inputRegisterPassword").value;
    let uri = 'v1/auth.php';
    let data = {
        request: 'register',
        username: formRegisterUsername,
        password: formRegisterPassword
    };
    const response = await fetch(uri, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
    const registerJson = await response.json();
    document.getElementById('register-modal').innerHTML = "";
    modalContainer = document.getElementById('register-modal');
    document.getElementById("register-btn").style.display = "none";
    let head = document.createElement('h2');
    if (registerJson) {
        head.innerHTML = registerJson;
        modalContainer.appendChild(head);
    }
}

// login
const login = async () => {
    let formLoginUsername = document.getElementById('inputLoginUsername').value;
    let formLoginPassword = document.getElementById("inputLoginPassword").value;
    let uri = 'v1/auth.php';
    let data = {
        request: 'login',
        username: formLoginUsername,
        password: formLoginPassword
    };
    const response = await fetch(uri, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
    const loginJson = await response.json();
    document.getElementById('login-modal').innerHTML = "";
    modalContainer = document.getElementById('login-modal');
    document.getElementById("login-btn").style.display = "none";
    let head = document.createElement('h2');
    if (loginJson) {
        if(response.status != 200){
            head.innerHTML = loginJson;
            modalContainer.appendChild(head);
        } else {
            head.innerHTML = 'You successfully logged in!';
            document.cookie = `session=${loginJson}; expires=${new Date(Date.now() + 86400e3).toUTCString()}; path=/; SameSite=Strict`; 
            modalContainer.appendChild(head);
        }
    }
}

// check if logged in
const cookieValue = document.cookie.split('; ').find(row => row.startsWith('session='))?.split('=')[1];
if (cookieValue !== undefined) {
  const decodedValue = decodeURIComponent(cookieValue);
  console.log(`JWT: ${decodedValue}`);
  let decodedToken = parseJwt(decodedValue);
  //console.log(decodedToken);
  // update the UI
  document.getElementById('logged-out').style.display = 'none';
  document.getElementById('logged-in').style.display = 'block';
  document.getElementById('inputEmail1').value = decodedToken.username;
} else {
  console.log('Not logged in');
  // make the order coffee show login modal
  document.getElementById('order-button').dataset.bsTarget = '#loginModal';
}

// logout
const button = document.getElementById('logout');
button.addEventListener('click', function() {
  document.cookie = 'session=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
  location.reload();
});

// close buttons
const buttons = document.querySelectorAll('.close-button');
for(let i = 0; i < buttons.length; i++) {
  buttons[i].addEventListener('click', function() {
    location.reload();
  });
}

// logged in order tracking

window.onload=getCoffee();