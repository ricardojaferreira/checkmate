'use strict';

let select = document.querySelector('select#categories');

select.addEventListener('change', function(){
    window.location = this.value;
});

