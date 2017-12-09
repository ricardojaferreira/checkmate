'use strict';

/*REGEX*/

let rules ={
    user_name: /^[A-Z][a-z]*([\s]{0,1}[A-Z][a-z]*)*$/,
    user_username: /^\w+([\.-]?\w+)*$/,
    user_email: /^[a-zA-Z]+([\.-]?\w+)*@([a-zA-Z]+([\.-]?\w)*)+(\.\w{2,4})+$/,
    user_phone: /[0-9]{9}|^[0-9]{3}-[0-9]{3}-[0-9]{3}$/,
    user_address: /[A-Za-z0-9]+/,
    user_description: /[A-Za-z0-9]+/
}

/*FORM*/
let formName = document.querySelector('input#user_name');
let formUsername = document.querySelector('input#user_username');
let formEmail = document.querySelector('input#user_email');
let formPhone = document.querySelector('input#user_phone');
let formAddress = document.querySelector('input#user_address');
let formBio = document.querySelector('textarea#user_description');
let currentPassword = document.querySelector('input#currentPassword');
let newPassword = document.querySelector('input#newPassword');
let newPasswordChecker = document.querySelector('.checkpassword');
let newFirstCheck = document.querySelector('.first-rule span');
let newSecondCheck = document.querySelector('.second-rule span');
let newThirdCheck = document.querySelector('.third-rule span');
let newForthCheck = document.querySelector('.forth-rule span');

//let newConfirmedPassword = document.querySelector('input#newConfirmedPassword');
/*GET ALL*/
let formUserInputs = document.querySelectorAll('.formUserInputs');

for(let i=0; i<formUserInputs.length; i++){
    formUserInputs[i].addEventListener('input', changeBio);
    formUserInputs[i].addEventListener('blur', getOriginalValue);
}


/*DRAG BOX*/
let dropPhoto = document.querySelector('.dragBox');
let img = document.querySelector('.profilePic');
let image ='';

function changeBio(event){
    if(rules[this.id].test(this.value)){
        document.querySelector('label.'+ this.id).innerHTML=this.name+": <span class=\"userinteract fa fa-check\" aria-hidden=\"true\"></span>";
    }else{
        document.querySelector('label.'+ this.id).innerHTML=this.name+": <span class=\"fa fa-times\" aria-hidden=\"true\"></span>";
    }

    if(document.querySelector('.'+this.id)){
        document.querySelector('.'+this.id).innerHTML = this.value;
    }else{
        /*Create only the elements needed, for now the elements are included on the HTML*/
    }

    if(this.value==''){
        document.querySelector('label.'+ this.id).innerHTML=this.name+":";
    }

}

/*** AJAX CALL ***/
function getOriginalValue(event){
    if(this.value==''){
        let valueToget = this.id;
        let request = new XMLHttpRequest();
        request.addEventListener("load", function(){
            let value = JSON.parse(this.responseText);
            document.querySelector('.'+valueToget).innerHTML=value[valueToget];
            //console.log(value[valueToget]);
        });
        request.open("POST", "action_getuserdata.php",true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("value="+this.id);
    }
}

/****** START: Check Password ********/
let newGoodPass=false;
/* password rules */
let newRuleTwo=/[0-9]+/;
let newRuleThreeCapital=/[A-Z]+/;
let newRuleThreeSmall=/[a-z]+/;
let newRuleFour=/[.!@#$%^&*()?_\/+"'=-]+/;

currentPassword.addEventListener('input', function () {
    if(newGoodPass && currentPassword.value!=''){
        document.querySelector('label.'+ currentPassword.id).innerHTML="Change your password: <span class=\"userinteract fa fa-check\" aria-hidden=\"true\"></span>";
    }else{
        document.querySelector('label.'+ currentPassword.id).innerHTML="Change your password: <span class=\"fa fa-times\" aria-hidden=\"true\"></span>";
    }
});

currentPassword.addEventListener('blur',function () {
    if(this.value=='' && newPassword.value==''){
        document.querySelector('label.'+ currentPassword.id).innerHTML="Change your password:";
    }
},true);

newPassword.addEventListener('focus',function () {
    newPasswordChecker.style.display='block';
},true);

newPassword.addEventListener('blur',function () {
    newPasswordChecker.style.display='none';
    if(this.value=='' && currentPassword.value==''){
        document.querySelector('label.'+ currentPassword.id).innerHTML="Change your password:";
    }
},true);

newPassword.addEventListener('input', function () {
    if(newPassword.value.length>=8){
        newFirstCheck.style.display='inline';
    }else{
        newFirstCheck.style.display='none';
    }

    if(newRuleTwo.test(newPassword.value)){
        newSecondCheck.style.display='inline';
    }else{
        newSecondCheck.style.display='none';
    }

    if(newRuleThreeSmall.test(newPassword.value) && newRuleThreeCapital.test(newPassword.value)){
        newThirdCheck.style.display='inline';
    }else{
        newThirdCheck.style.display='none';
    }

    if(newRuleFour.test(newPassword.value)){
        newForthCheck.style.display='inline';
    }else{
        newForthCheck.style.display='none';
    }

    if(newPassword.value.length>=8 &&
        newRuleTwo.test(newPassword.value) &&
        newRuleThreeSmall.test(newPassword.value) &&
        newRuleThreeCapital.test(newPassword.value) &&
        newRuleFour.test(newPassword.value)){
        newGoodPass = true;
        newPasswordChecker.style.display='none';
        if(currentPassword.value!=''){
            document.querySelector('label.'+ currentPassword.id).innerHTML="Change your password: <span class=\"userinteract fa fa-check\" aria-hidden=\"true\"></span>";
        }
    }else{
        newPasswordChecker.style.display='block';
        newGoodPass = false;
        document.querySelector('label.'+ currentPassword.id).innerHTML="Change your password: <span class=\"fa fa-times\" aria-hidden=\"true\"></span>";
    }
});

/***** END: Check Password ********/



/**** AJAX CALL ****/
let saveChanges = document.querySelector('.saveChanges');
saveChanges.addEventListener('click', saveToDataBase, false);

function saveToDataBase(){
    if(document.querySelector('.userinteract')){
        if(document.querySelector('span.formError')){
            document.querySelector('span.formError').remove();
        }
        let userDetailsObj = { };
        let userPicObj = { };
        let userPasswordsObj = { };
        userPicObj.user_profilepic = image;
        userDetailsObj.user_name = formName.value;
        userDetailsObj.user_username = formUsername.value;
        userDetailsObj.user_email = formEmail.value;
        userDetailsObj.user_phone = formPhone.value;
        userDetailsObj.user_description = formBio.value;
        userDetailsObj.user_address = formAddress.value;
        userPasswordsObj.user_password = newPassword.value;
        userPasswordsObj.user_currentPassword = currentPassword.value;
        /*** AJAX CALL *****/
        let request = new XMLHttpRequest();
        request.addEventListener("load", updateUser);
        request.open("POST", "action_updateuser.php",true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("userDetails="+JSON.stringify(userDetailsObj,null)+
            "&userPicture="+image+
            "&userPasswords="+JSON.stringify(userPasswordsObj,null)
            );

    }else{
        if(!document.querySelector('span.formError')){
            let error = document.createElement("span");
            error.innerHTML = "Errors or nothing to send!";
            error.style.color='red';
            error.classList.add('formError');
            document.querySelector('#setDetails').appendChild(error);
        }
    }
}

function updateUser(){
    let userDetails = JSON.parse(this.responseText);

    if(userDetails['error']=='No error'){
        reset(userDetails['imgsrc']);
        console.log(userDetails['imgsrc']);
        let modal = document.querySelector('.modal-messages');
        modal.style.display="block";
        modal.style.opacity=100;
        setTimeout(function(){
            modal.style.opacity = 0;
            modal.style.display = 'none';
        }, 1500);
    }else{
        let error = document.createElement("span");
        error.innerHTML = userDetails['error'];
        error.style.color='red';
        error.classList.add('formError');
        document.querySelector('#setDetails').appendChild(error);
    }
}

function reset(imgsrc = img.src){
    formName.value = '';
    document.querySelector('label.'+ formName.id).innerHTML=formName.name;
    formUsername.value = '';
    document.querySelector('label.'+ formUsername.id).innerHTML=formUsername.name;
    formEmail.value = '';
    document.querySelector('label.'+ formEmail.id).innerHTML=formEmail.name;
    formPhone.value = '';
    document.querySelector('label.'+ formPhone.id).innerHTML=formPhone.name;
    formAddress.value = '';
    document.querySelector('label.'+ formAddress.id).innerHTML=formAddress.name;
    formBio.value = '';
    document.querySelector('label.'+ formBio.id).innerHTML=formBio.name;
    currentPassword.value = '';
    newPassword.value = '';
    document.querySelector('label.'+ currentPassword.id).innerHTML="Change your password:";
    newFirstCheck.style.display='none';
    newSecondCheck.style.display='none';
    newThirdCheck.style.display='none';
    newForthCheck.style.display='none';
    img.classList.remove('userinteract');
    img.src=imgsrc+"?"+ new Date().getTime();;
}


window.addEventListener("drop", function(e) {
    if (e.target === dropPhoto) {
      drop_handler(e);
      e.target.style.background = "";
    }else{
        e.preventDefault();
    }
}, false);

window.addEventListener("dragover", function(e) {
    if (e.target != dropPhoto) {
        e.preventDefault();
    }else{
        dragover_handler(e);
    }
}, false);

window.addEventListener("dragend", function(e) {
    if (e.target != dropPhoto) {
        e.preventDefault();
    }else{
        dragend_handler(e);
    }
}, false);

window.addEventListener("dragenter", function(e) {
    if (e.target != dropPhoto) {
        e.preventDefault();
    }else{
        e.target.style.backgroundImage = "url('images/drag_and_drop.gif')";
    }
}, false);

window.addEventListener("dragleave", function(e) {
    if (e.target != dropPhoto) {
        e.preventDefault();
    }else{
        e.target.style.background = "";
    }
}, false);

function drop_handler(ev) {
  ev.preventDefault();
  let mimeTypes = /\.(png|jpe?g)$/i;
  let reader = new FileReader();
  let dt = ev.dataTransfer;
  if(dt.files.length<2){
    for (let i=0; i < dt.files.length; i++) {
      if(mimeTypes.test(dt.files[i].name)) {
        reader.readAsDataURL(dt.files[i]);
        reader.addEventListener("load", function () {
            img.src = reader.result;
            image=reader.result;
            img.classList.add('userinteract');
            //photoPath = dt.files[i].name;
            //errorMessage.innerHTML = 'Drop Images:';
            //errorMessage.style.color = '#000000';
            //uploadPhoto.value=reader.result;
        }, false);
      }else{
        console.log('only images');
      }
    }

  }else{
    console.log('just one element');
  }
}

function dragover_handler(ev) {
    ev.preventDefault();
    ev.dataTransfer.effectAllowed='copy';
    ev.dataTransfer.dropEffect='copy';
}

function dragend_handler(ev) {
    ev.dataTransfer.clearData();
}
