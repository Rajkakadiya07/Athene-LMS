var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; //Javascript reGex for Email Validation.
var regContactNo = /^\d{10}$/; // Javascript reGex for contact number validation.
var regUserIdStudent = /^\d{10,15}$/; // Javascript reGex for user id validation.
var regUserIdTeacher = /[~!@#$%^&*()+=*?\-\"',.;:|]/;
var regName = /\d/; // Javascript reGex for Name validation
var regName2 = /^[A-Z][a-zA-Z ]*$/; // Javascript reGex for Name validation
var regPassword = /^(?=.*[0-9])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*_]{8,16}$/; //regex for passsword checking


function valName(name) {
    if (name == "" || regName.test(name) || !regName2.test(name)) {
        alert("Please enter a valid name");
        return false;
    }
}

function valActivityName(name) {
    if (name == "") {
        alert("Please enter a valid activity name");
        return false;
    } else {
        return true;
    }
}

function valDesc(desc) {
    if (desc == "") {
        alert("Please enter a valid description");
        return false;
    } else {
        return true;
    }
}

function valNumber(num) {
    if (isNaN(num) || num.includes("e") || num == "") {
        alert("Please enter a valid number.");
        return false;
    } else {
        return true;
    }
}

function dateCompare(d1, d2) {

        let date1 = new Date(d1).getTime();
        let date2 = new Date(d2).getTime();
        if (date1 < date2) {
            return true;
        } else if (date1 > date2) {
           alert(`Start date must be earlier than end date.`);
           return false;
        } 
}