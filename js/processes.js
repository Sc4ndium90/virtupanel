$(document).ready(function () {

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

    $('div.toolbar').html(
        '<button class="btn btn-primary me-2" id="refreshBtn"><svg class="bi pe-none" width="16" height="16"><use xlink:href="#refresh"></use></svg></button>'+
        '<button class="btn btn-danger" id="killProcessBtn">Kill a process</button>'

    );

    $('#refreshBtn').click(function () {
        processesTable.DataTable().ajax.reload();
    })

    $('#killProcessBtn').click(function () {

        Swal.fire({
            text: 'Enter the PID of the process you want to kill',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: false,
            confirmButtonText: 'Kill it!',
            showLoaderOnConfirm: true,
            preConfirm: (input) => {
                return $.post('./ajax/killProcess.php', { id: input }).then(function (res) { return res })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                if (result.value == '') {
                    let timerInterval
                    Swal.fire({
                        title: "Process killed", icon: "success",
                        timer: 1500, timerProgressBar: true,
                        didOpen: () => { Swal.showLoading() },
                        willClose: () => { clearInterval(timerInterval) }
                    }).then(() => {
                        processesTable.DataTable().ajax.reload();
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
                        processesTable.DataTable().ajax.reload();
                    })
                }
            }
        })

    })

})