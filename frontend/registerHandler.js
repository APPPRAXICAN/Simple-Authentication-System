let firstname = document.getElementById('f-name')
let surname = document.getElementById('surname')
let pass = document.getElementById('pass')
let Cpass = document.getElementById('Cpass')
let email = document.getElementById('email')
let date = document.getElementById('date')
let male = document.getElementById('male')
let female = document.getElementById('female')
let captcha = document.getElementById('captcha-input')
let spinner = document.getElementById('spinner')
let registerBtn = document.getElementById('register')

let isString = /^[a-zA-Z]+$/m
let isEmail = /@+/m
function isBlank(str, id) {
    if (str === '') {
        document.getElementById(id).innerHTML = 'field is blank'
        ok = false
    }
    return str === ''
}

firstname.onchange = function () {
    document.getElementById('f-name-err').innerHTML = ""
}
surname.onchange = function () {
    document.getElementById('surname-err').innerHTML = ""
}
pass.onchange = function () {
    document.getElementById('pass-err').innerHTML = ""
}
Cpass.onchange = function () {
    document.getElementById('Cpass-err').innerHTML = ""
}
male.onchange = function () {
    document.getElementById('gender-err').innerHTML = ""
}

female.onchange = function () {
    document.getElementById('gender-err').innerHTML = ""
}

email.onchange = function () {
    document.getElementById('email-err').innerHTML = ""
}
date.onchange = function () {
    document.getElementById('date-err').innerHTML = ""
}
captcha.onchange = function () {
    document.getElementById('captcha-err').innerHTML = ""
}

function register() {
    let ok = true
    let data = {}
    if (!isBlank(firstname.value, 'f-name-err')) {
        if (isString.test(firstname.value)) {
            data.fname = firstname.value
        } else {
            document.getElementById('f-name-err').innerHTML = 'Enter a valid name'
            ok = false
        }
    }
    if (!isBlank(surname.value, 'surname-err')) {
        if (isString.test(surname.value)) {
            data.surname = surname.value
        } else {
            document.getElementById('surname-err').innerHTML = 'Enter a valid name'
            ok = false
        }
    }
    if (!isBlank(pass.value, 'pass-err') && !isBlank(Cpass.value, 'Cpass-err')) {
        if (pass.value === Cpass.value) {

            data.pass = pass.value
        }
        else {
            document.getElementById('Cpass-err').innerHTML = "passwords not equivalent"
            ok = false
        }
    }
    if (!isBlank(email.value, 'email-err')) {
        if (isEmail.test(email.value)) {
            data.email = email.value
        }
        else {
            document.getElementById('email-err').innerHTML = "enter a valid email"
            ok = false
        }
    }
    if (!isBlank(date.value, 'date-err')) {
        data.date = date.value
    }
    if (!isBlank(captcha.value, 'captcha-err')) {
        console.log('captcha:', captcha.value)
        data.captcha = captcha.value
    }
    if (male.checked == false && female.checked == false) {
        document.getElementById('gender-err').innerHTML = "select a gender"
        ok = false
    }
    male.checked == true ? data.gender = male.value : data.gender = female.value
    if (ok) {
        console.log(data)
        registerBtn.style.display = 'none'
        spinner.style.display = 'block'
        let url = "/websites/subsytems/login-registration-subsystem/backend/server.php"
        fetch(url, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(
            (response) => {
                if (response.ok) {
                    console.log('ok')
                    return response.json()
                } else {
                    console.log('response error')
                }
            }
        ).then(
            (data) => {
                spinner.style.display='none'
                registerBtn.style.display='block'
                console.log('data: ')
                console.log(data)
                data.status == 0 ? window.location.replace('../login-registration-subsystem/Email-Verification.php') : null 
                data.status == -1 ? document.getElementById('email-err').innerHTML = data.msg :null
                data.status == -2 ? document.getElementById('captcha-err').innerHTML = data.msg :null
            }
        )
    }
    console.log('inputed data :' ,data)

}


console.log('tgggg')