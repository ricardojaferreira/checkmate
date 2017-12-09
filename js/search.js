'use strict';

let closeSearch = document.querySelector('.closesearch');
let openSearch = document.querySelector('.fa-search');
let searchModal = document.querySelector('.search-modal-input');
let searchBox = document.querySelector('#search');
let categories = document.querySelector('.search-results');

openSearch.addEventListener('click', function(){
    searchModal.style.display='block';
    searchModal.style.opacity=100;
});


closeSearch.addEventListener('click', function(){
    searchModal.style.display='none';
    searchModal.style.opacity=0;
});

searchBox.addEventListener('input',searchCategory);

/***AJAX*****/
function searchCategory(event){
    let searchRequest = new XMLHttpRequest();
    searchRequest.addEventListener("load", searchresult);
    searchRequest.open("POST", "action_searchcategory.php",true);
    searchRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    searchRequest.send("searchWord="+this.value);
}

function searchresult(){
    while (categories.hasChildNodes()) {
        categories.removeChild(categories.firstChild);
    }
    let searchResults = JSON.parse(this.responseText);
    for(let i=0; i<searchResults.length; i++){
        let elementLi = document.createElement('LI');
        let elementA = document.createElement('a');
        elementA.href='todos.php?category_id='+searchResults[i].category_id;
        elementA.innerText=searchResults[i].category_name;
        elementLi.appendChild(elementA);
        categories.appendChild(elementLi);
    }


    console.log(searchResults);
}