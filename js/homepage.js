let slogans = document.querySelectorAll('.promo-slogans h1');
window.setInterval(changeOpacity, 2000);

/*Query the document */
let userInput = document.querySelector('#username');
let userChecker = document.querySelector('.checkuser li');
let passwordInput = document.querySelector('#password');
let passwordChecker = document.querySelector('.checkpassword');
let firstCheck = document.querySelector('.first-rule span');
let secondCheck = document.querySelector('.second-rule span');
let thirdCheck = document.querySelector('.third-rule span');
let forthCheck = document.querySelector('.forth-rule span');

let passCheck = document.querySelector('.passcheck');
let userCheck = document.querySelector('.usercheck');
let passNotCheck = document.querySelector('.passnotcheck');
let userNotCheck = document.querySelector('.usernotcheck');

let goodPass=false;
let goodUser=false;

/***** START: Check User *********/

function userErrorMessage(message){
    userChecker.textContent=message;
    userChecker.style.display='list-item';
}

function clearErrorMessage(){
    userChecker.textContent='';
    userChecker.style.display='none';
}

function checkUserValue(){
    let found = [];
    if(userRule.test(userInput.value)){
        userCheck.style.display='inline';
        userNotCheck.style.display='none';
        clearErrorMessage();
        goodUser=true;
        //console.log('if-0');
    }else if(emailRule.test(userInput.value)){
        userCheck.style.display='inline';
        userNotCheck.style.display='none';
        clearErrorMessage();
        goodUser=true;
        //console.log('if-1');
    }else if(notAllowedSymbols.test(userInput.value)){
        found = userInput.value.match(notAllowedSymbols);
        userErrorMessage('The symbol '+found[0]+' is not allowed here.');
        userCheck.style.display='none';
        userNotCheck.style.display='inline';
        goodUser=false;
        //console.log('if-2');
    }else if(detectArroba.test(userInput.value)){
        found = userInput.value.match(detectArroba);
        userErrorMessage(found[0]+' is only allowed with valid email addresses.');
        userCheck.style.display='none';
        userNotCheck.style.display='inline';
        goodUser=false;
        //console.log('if-3');
    }else{
        userErrorMessage('This is not a valid username or email.');
        userCheck.style.display='none';
        userNotCheck.style.display='inline';
        goodUser=false;
        //console.log('else');
    }
}

let userRule = /^\w+([\.-]?\w+)*$/;
let emailRule = /^[a-zA-Z]+([\.-]?\w+)*@([a-zA-Z]+([\.-]?\w)*)+(\.\w{2,4})+$/;
let notAllowedSymbols = /[!#$%^&*()?\/+"'=]+/;
let detectArroba = /@/;

userInput.addEventListener('focus',function () {
    if(userChecker.textContent!='') {
        userChecker.style.display = 'list-item';
    }else{
        userChecker.style.display = 'none';
    }
},true);

userInput.addEventListener('blur',function () {
    userChecker.style.display='none';
},true);

userInput.addEventListener('input', function () {
    checkUserValue();
});

/***** END Check User *********/



/****** START: Check Password ********/

/* password rules */
let ruleTwo=/[0-9]+/;
let ruleThreeCapital=/[A-Z]+/;
let ruleThreeSmall=/[a-z]+/;
let ruleFour=/[.!@#$%^&*()?_\/+"'=-]+/;

passwordInput.addEventListener('focus',function () {
    passwordChecker.style.display='block';
},true);

passwordInput.addEventListener('blur',function () {
    passwordChecker.style.display='none';
},true);

passwordInput.addEventListener('input', function () {
    if(passwordInput.value.length>=8){
        firstCheck.style.display='inline';
    }else{
        firstCheck.style.display='none';
    }

    if(ruleTwo.test(passwordInput.value)){
        secondCheck.style.display='inline';
    }else{
        secondCheck.style.display='none';
    }

    if(ruleThreeSmall.test(passwordInput.value) && ruleThreeCapital.test(passwordInput.value)){
        thirdCheck.style.display='inline';
    }else{
        thirdCheck.style.display='none';
    }

    if(ruleFour.test(passwordInput.value)){
        forthCheck.style.display='inline';
    }else{
        forthCheck.style.display='none';
    }

    if(passwordInput.value.length>=8 &&
        ruleTwo.test(passwordInput.value) &&
        ruleThreeSmall.test(passwordInput.value) &&
        ruleThreeCapital.test(passwordInput.value) &&
        ruleFour.test(passwordInput.value)){
        goodPass = true;
        passCheck.style.display='inline';
        passNotCheck.style.display='none';
        passwordChecker.style.display='none';
    }else{
        goodPass = false;
        passCheck.style.display='none';
        passNotCheck.style.display='inline';
        passwordChecker.style.display='block';
    }
});

/***** END: Check Password ********/

/***** Validate Form ******/

window.onsubmit=function(){
    if(goodUser && goodPass)
        return true;
    else
        return false;
};

/***** VALIDATIONS WHEN THE PAGE STARTS *******/

window.onload=function(){
    if(userInput.value!='')
        checkUserValue();
}


function changeOpacity(){
    for(let i=0; i<slogans.length; i++){
        if(window.getComputedStyle(slogans[i],null).getPropertyValue("opacity")==1){
            //console.log(i);   //DEBUG
            slogans[i].style.opacity=0;
            if((i++)==slogans.length-1){
                slogans[0].style.opacity=1;
            }else{
                slogans[i++].style.opacity=1;
            }
            return;
        }
    }
}
