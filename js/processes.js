$(document).ready(function () {

    // Init the table with DataTable
    const processesTable = $('#processesTable')

    processesTable.DataTable({
        dom: '<"toolbar">frtip',
        ajax: {
            url: "./ajax/getProcesses.php",
            dataSrc: ""
        },
        scrollY: '500px',
        scrollCollapse: true,
        paging: false
    })

    // Set a custom toolbar for the table
    $('div.toolbar').html(
        '<button class="btn btn-primary me-2" id="refreshBtn"><svg class="bi pe-none" width="16" height="16"><use xlink:href="#refresh"></use></svg></button>'+
        '<button class="btn btn-danger" id="killProcessBtn">Kill a process</button>'

    );

    // On click, refresh the table
    $('#refreshBtn').click(function () {
        processesTable.DataTable().ajax.reload();
    })

    // Kill a process
    $('#killProcessBtn').click(function () {

        // Fire a modal with Sweet Alerts
        Swal.fire({
            text: 'Enter the PID of the process you want to kill',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: false,
            confirmButtonText: 'Kill it!',
            showLoaderOnConfirm: true,
            preConfirm: (input) => { // Send the data to the php file
                return $.post('./ajax/killProcess.php', { id: input }).then(function (res) { return res })
            },
            allowOutsideClick: () => !Swal.isLoading() // Allow user to click outside the modal to close it
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.value == '') { // If nothing, the command is a success, show the success modal
                    let timerInterval
                    Swal.fire({
                        title: "Process killed", icon: "success",
                        timer: 1500, timerProgressBar: true,
                        didOpen: () => { Swal.showLoading() },
                        willClose: () => { clearInterval(timerInterval) }
                    }).then(() => {
                        processesTable.DataTable().ajax.reload(); // Refresh the table
                    })
                } else { // Else show the error modal with the error
                    let timerInterval
                    Swal.fire({
                        title: "Error", icon: "error",
                        text: result.value,
                        timer: 3000, timerProgressBar: true,
                        didOpen: () => { Swal.showLoading() },
                        willClose: () => { clearInterval(timerInterval) }
                    }).then(() => {
                        processesTable.DataTable().ajax.reload(); // Refresh the table
                    })
                }
            }
        })

    })

})