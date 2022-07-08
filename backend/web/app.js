$(function () {
    'use strict';


    $('#recipeTN').change(ev => {
        $(ev.target).closest('form').trigger('submit');
    })


});