const Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 3000,
    background: '#FAFAFA',
});

function success(msg) {
    Toast.fire({
        icon: 'success',
        title: msg
    })
}

function error(msg) {
    Toast.fire({
        icon: 'error',
        title: msg
    })
}

function info(msg) {
    Toast.fire({
        icon: 'info',
        title: msg
    })
}

function warning(msg) {
    Toast.fire({
        icon: 'warning',
        title: msg
    })
}

function question(msg) {
    Toast.fire({
        icon: 'question',
        title: msg
    })
}