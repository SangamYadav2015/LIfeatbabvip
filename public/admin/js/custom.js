/* For Admin Login Remember function */
$('#loginFormAdmin').on('submit', function () {
    if ($('#remember').is(':checked')) {
        localStorage.setItem('remember', true);
        localStorage.setItem('rememberEmail',  $('#login-email').val());
        localStorage.setItem('rememberPassword',  $('#password-input').val());
    } else {
        localStorage.removeItem('remember');
        localStorage.removeItem('rememberEmail');
        localStorage.removeItem('rememberPassword');
    }
});
if (localStorage.getItem('remember')) {
    $('#remember').prop('checked', true);
    $('#login-email').val(localStorage.getItem('rememberEmail'));
    $('#password-input').val(localStorage.getItem('rememberPassword'))
}
/* For Admin Login Remember function */

/* Fadeout alert message*/
document.addEventListener('DOMContentLoaded', (event) => {
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert-messages');
        alerts.forEach(alert => {
            alert.style.opacity = '0';
            alert.addEventListener('transitionend', () => {
                alert.style.display = 'none';
            });
        });
    }, 5000); 
});


/* for delete alert*/
function deleteAlert(itemId){
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + itemId).submit();
        }
      });
}

function deleteAlertMenu(itemId){
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this! & Menu Page also deleted",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + itemId).submit();
        }
      });
}

