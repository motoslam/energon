function adminConfirm(callbackFunction, title = "Вы уверены?") {
    Swal.fire({
        title: title,
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: 'Да',
        cancelButtonText: 'Нет',
        confirmButtonColor: 'rgb(220, 53, 69)',
    }).then((result) => {
        if (result.isConfirmed) {
            callbackFunction();
        }
    })
}

function generatePassword(len=8){
    let password = "";
    let symbols = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (let i = 0; i < len; i++){
        password += symbols.charAt(Math.floor(Math.random() * symbols.length));
    }
    return password;
}

function putPassword(passElement, confirmElement) {
    let password = generatePassword();
    $(passElement).attr('type', 'text').val(password);
    $(confirmElement).attr('type', 'text').val(password);
    return true;
}
