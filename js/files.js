$(document).ready(function () {

    const location = $('#path').text()

    /*
        Create a new directory in the active directory
     */
    $('#create-dir-btn').click(function () {

        Swal.fire({
            text: 'Enter the name of the directory you want to create',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: false,
            confirmButtonText: 'Create it!',
            showLoaderOnConfirm: true,
            preConfirm: (input) => { // Send data
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
                        window.location.reload(); // Refresh the page
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
                        window.location.reload(); // Refresh the page
                    })
                }
            }
        })

    })
    

    /*
        Create a new file in the active directory
     */
    $('#create-file-btn').click(function () {

        Swal.fire({
            text: 'Enter the name of the file you want to create',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: false,
            confirmButtonText: 'Create it!',
            showLoaderOnConfirm: true,
            preConfirm: (input) => { // Send the data
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
                        window.location.reload(); // Refresh the page
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
                        window.location.reload(); // Refresh the page
                    })
                }
            }
        })

    })


    /*
        Delete a file or a whole directory specified
     */
    $('#delete-file-or-folder-btn').click(function () {

        Swal.fire({
            text: 'Enter the path of the file or the directory you want to delete. ⚠️ Note that, for a folder, it will delete all of its content.',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: false,
            confirmButtonText: 'Delete it!',
            showLoaderOnConfirm: true,
            preConfirm: (input) => { // Send the data
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
                        window.location.reload(); // Refresh the page
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
                        window.location.reload(); // Refresh the page
                    })
                }
            }
        })

    })

})