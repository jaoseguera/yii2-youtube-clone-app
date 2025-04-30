//Submits automatically the ActiveForm.
//Add this file into the AppAsset.php
$(function () {
    'use strict';
    $('#videoFile').change(ev => {
        $(ev.target).closest('form').trigger('submit');
    });
});