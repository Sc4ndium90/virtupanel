$(document).ready(function () {

    const location = $('#path').text()

    $('#create-dir-btn').click(function (event) {

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
                        title: "Directory created", icon: "success",
                        timer: 1500, timerProgressBar: true,
                        didOpen: () => { Swal.showLoading() },
                        willClose: () => { clearInterval(timerInterval) }
                    }).then(() => {
                        window.location.reload();
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
                        window.location.reload();
                    })
                }
            }
        })

    })

    $('#create-file-btn').click(function (event) {

        Swal.fire({
            text: 'Enter the name of the file you want to create',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: false,
            confirmButtonText: 'Create it!',
            showLoaderOnConfirm: true,
            preConfirm: (input) => {
                return $.post('./ajax/createFile.php', { name: input, path: location }).then(function (res) { return res })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.value === '') {
                    let timerInterval
                    Swal.fire({
                        title: "File created", icon: "success",
                        timer: 1500, timerProgressBar: true,
                        didOpen: () => { Swal.showLoading() },
                        willClose: () => { clearInterval(timerInterval) }
                    }).then(() => {
                        window.location.reload();
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
                        window.location.reload();
                    })
                }
            }
        })

    })

    $('#delete-file-or-folder-btn').click(function (event) {

        Swal.fire({
            text: 'Enter the path of the file or the directory you want to delete. ⚠️ Note that, for a folder, it will delete all of its content.',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: false,
            confirmButtonText: 'Delete it!',
            showLoaderOnConfirm: true,
            preConfirm: (input) => {
                return $.post('./ajax/deleteFileOrDirectory.php', { path: input }).then(function (res) { return res })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.value === '') {
                    let timerInterval
                    Swal.fire({
                        title: "File/Directory deleted", icon: "success",
                        timer: 1500, timerProgressBar: true,
                        didOpen: () => { Swal.showLoading() },
                        willClose: () => { clearInterval(timerInterval) }
                    }).then(() => {
                        window.location.reload();
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
                        window.location.reload();
                    })
                }
            }
        })

    })

})