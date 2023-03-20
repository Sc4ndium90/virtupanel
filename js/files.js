$(document).ready(function () {

    const location = $('#path').text()

    $('#create-dir-btn').click(function (event) {
        console.log(location)

        Swal.fire({
            text: 'Enter the name of the directory you want to create',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: false,
            confirmButtonText: 'Create it!',
            showLoaderOnConfirm: true,
            preConfirm: (input) => {
                return $.post('./ajax/createDirectory.php', { name: input, path: location }).then(function (res) { return res })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.value === '') {
                    let timerInterval
                    Swal.fire({
                        title: "Process killed", icon: "success",
                        timer: 1500, timerProgressBar: true,
                        didOpen: () => { Swal.showLoading() },
                        willClose: () => { clearInterval(timerInterval) }
                    }).then(() => {
                        // Action after success (prob reload page)
                    })
                } else {
                    let timerInterval
                    Swal.fire({
                        title: "Error", icon: "error",
                        text: result.value,
                        timer: 3000, timerProgressBar: true,
                        didOpen: () => { Swal.showLoading() },
                        willClose: () => { clearInterval(timerInterval) }
                    }).then(() => {
                        // Action after error
                    })
                }
            }
        })

    })

})