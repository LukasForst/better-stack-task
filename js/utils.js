function filterTableByRow(rowIdx) {
    const input = $('#filterInput');
    const rows = $('#userTable tr');
    const searchValue = input.val().toLowerCase();
    const visibleRows = $([])

    // loop through all rows and hide those that don't match the filter
    rows.each((index, element) => {
        const row = $(element);
        const cell = row.find('td').eq(rowIdx);

        if (!cell || index === 0) {
            return;
        }

        const cellValue = cell.text().toLowerCase();
        const hidden = !cellValue.includes(searchValue);
        row.toggleClass('hidden', hidden);
        row.removeClass('even');
        if (!hidden) {
            visibleRows.push(row)
        }
    });

    // fix odd/even background
    visibleRows.each(function (index, row) {
        if (index % 2 === 0) {
            row.addClass('even');
        }
    })
}

function createNewRecord() {
    // reset validation errors
    $('.text-danger').text('');

    // ajax request
    $.ajax({
        type: "POST",
        url: "create.php",
        data: {
            name: $("#name").val(),
            email: $("#email").val(),
            city: $("#city").val(),
            phone: $("#phone").val()
        },
        success: (r) => {
            $('#new-record-modal').modal('toggle');
            // wait 150ms so we can animate closing modal and then refresh data
            setTimeout(() => {
                const updatedPage = document.open("text/html", "replace");
                updatedPage.write(r);
                updatedPage.close();

            }, 150);
        },
        error: (r) => {
            const j = r.responseJSON;
            if (j) {
                // handle validation errors
                const validation_errors = j['validation_errors'];
                if (validation_errors) {
                    for (const element of ["name", "email", "city", "phone"]) {
                        const err = validation_errors[element];
                        if (err) {
                            $(`#${element}-error`).text(err);
                        }
                    }
                }
                // and any other errors that might come up
                const generic_error = j['error'];
                if (generic_error) {
                    alert(generic_error);
                }
            } else {
                console.error(j.responseText)
                alert('Failed to create user. See console for errors.')
            }
        }
    });
}

function resetForm() {
    // reset validation errors
    $('.text-danger').text('');
    // and reset data
    $("#new-record-form")[0].reset();
}