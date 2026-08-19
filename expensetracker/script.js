// <============= INITS ==================> //

// TAKE CONSTS AS YOU GO
const form = document.getElementById("form");
const traType = document.getElementById("transaction-type");
const traAmount = document.getElementById("transaction-amount");
const blurp = document.getElementById("background-blur");

const btnRecord = document.getElementById("button-1");
const btnNext = document.getElementById("button-next-form");
const btnNext1 = document.getElementById("button-next-form-1");
const btnsubmit = document.getElementById("button-submit");

const sel01 = document.getElementById("sel01");
const sel02 = document.getElementById("sel02");
const sel03 = document.getElementById("sel03");
const sel04 = document.getElementById("sel04");
const sel05 = document.getElementById("sel05");
const sel06 = document.getElementById("sel06");

const dropdown = document.getElementById("transactiontype");

const containers = document.querySelectorAll(".div-container-buying-something");

var selectedItem = "none";


// WHEN BUTTON PRESSED ACTIVATE FORM AND BLUR
btnRecord.addEventListener('click', function(){
    form.classList.remove("hidden");
    traType.classList.remove("hidden");
    blurp.classList.remove("hidden");
});

// Removing form when pressing anywhere else
blurp.addEventListener('click', function(){
    form.classList.add("hidden");
    traType.classList.add("hidden");
    blurp.classList.add("hidden");
    traAmount.classList.add("hidden");
    // Clear All Fields Also
    containers.forEach(c => c.classList.remove('selected'));
    document.getElementById("input-amount").value = '';
    document.getElementById("input-description").value = '';
    selectedItem = "none";
});



// PART 1 = TAKE THE CORRECT ID WHEN PRESSED ON TYPE


const imgsel = document.getElementsByClassName('div-container-buying-something');
const textsel = document.getElementById('transactiontype');

const categories = {
  sel01: "BuyingSomething",
  sel02: "Income",
  sel03: "BoughtFood",
  sel04: "HealthCare",
  sel05: "Subscription",
  sel06: "Clothings",
};


// Taking the selected value while deselecting the others
Object.entries(categories).forEach(([id, label]) => {
  const el = document.getElementById(id);
  el.addEventListener('click', () => {
    // resettting all containers
    containers.forEach(c => c.classList.remove('selected'));

    selectedItem = label;
    document.getElementById('transactiontype').value = '';
    el.classList.add('selected');
  });
});
// The others option, that also deselects everything else when selected
dropdown.addEventListener("change", (event)=>{
    selectedItem=event.target.value;
    containers.forEach(c => c.classList.remove('selected'));
});

// Going to the next page
btnNext.addEventListener('click', function(){
    if (selectedItem == "none"){
    alert("Please select transaction type");
    }else{
        traType.classList.add("hidden");
        traAmount.classList.remove("hidden");
    }
});

// Submitting the form
btnNext1.addEventListener('click', function(){
    if (selectedItem == "none"){
    alert("Please select transaction type");
    }else{
        traType.classList.add("hidden");
        traAmount.classList.remove("hidden");
    }
});

// Final Stuff before sending to the server, Taking values n all
var amount;
var description;

btnsubmit.addEventListener("click", function(){
    const inputAmount = document.getElementById("input-amount").value;
    const descInput = document.getElementById("input-description").value;

    if(!inputAmount){
        alert("Entered amount is empty or invalid");
        return;
    }
    if(!descInput){
        alert("Entered Description is empty or invalid");
        return;
    }

    amount = document.getElementById("input-amount").value;
    description = document.getElementById("input-description").value

    form.classList.add("hidden");
    traType.classList.add("hidden");
    blurp.classList.add("hidden");
    traAmount.classList.add("hidden");
    
    // Sending data to server
    fetch("form_send.php", {
        method : "POST",
        headers: {
            "Content-type": "application/x-www-form-urlencoded"
        },
        body: `selectedItem=${encodeURIComponent(selectedItem)}&amount=${encodeURIComponent(amount)}&description=${encodeURIComponent(description)}`
    })
    .then(res => res.text())
    .then(res => console.log(res));



    // Clear All Fields Also
    containers.forEach(c => c.classList.remove('selected'));
    selectedItem = "none";

    document.getElementById("input-amount").value = '';
    document.getElementById("input-description").value = '';



});

/*
  /$$$$$$  /$$$$$$$$ /$$$$$$$  /$$    /$$ /$$$$$$$$ /$$$$$$$ 
 /$$__  $$| $$_____/| $$__  $$| $$   | $$| $$_____/| $$__  $$
| $$  \__/| $$      | $$  \ $$| $$   | $$| $$      | $$  \ $$
|  $$$$$$ | $$$$$   | $$$$$$$/|  $$ / $$/| $$$$$   | $$$$$$$/
 \____  $$| $$__/   | $$__  $$ \  $$ $$/ | $$__/   | $$__  $$
 /$$  \ $$| $$      | $$  \ $$  \  $$$/  | $$      | $$  \ $$
|  $$$$$$/| $$$$$$$$| $$  | $$   \  $/   | $$$$$$$$| $$  | $$
 \______/ |________/|__/  |__/    \_/    |________/|__/  |__/
*/
// btw, Big Money-ne on asciiart.eu/text-to-ascii-art
// :( everything had to be put up
// Variables to send `selectedItem`, `amount` and `description`;



// TO DO LIST
// ===========
// MAKE THE SQL TAKE IN THE URL AND SEND IT TO THE SERVER FOR STORAGE
// MAKE THE LOGOUT BUTTON WORK
// MAKE THE RESTRICTION WITHOUT USER ID 
// MAKE THE REST OF THE BUTTONS WORK NOW
