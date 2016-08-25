$(document).ready(function(){
    ukryj_rejestracja($('#userRegister_typ input').val())
    $('#userRegister_typ input').on('click', function(){
        ukryj_rejestracja($(this).val());
    });
});

function ukryj_rejestracja(stan) {
    if(stan == 0) {
        $('#userRegister_pesel').parent().parent().hide();
        $('#userRegister_nr_dowodu').parent().parent().hide();
        $('#userRegister_miasto').parent().parent().hide();
        $('#userRegister_ulica').parent().parent().hide();
        $('#userRegister_nr_domu').parent().parent().hide();
        $('#userRegister_nr_lokalu').parent().parent().hide();
    } else {
        $('#userRegister_pesel').parent().parent().show();
        $('#userRegister_nr_dowodu').parent().parent().show();
        $('#userRegister_miasto').parent().parent().show();
        $('#userRegister_ulica').parent().parent().show();
        $('#userRegister_nr_domu').parent().parent().show();
        $('#userRegister_nr_lokalu').parent().parent().show();
    }
}


