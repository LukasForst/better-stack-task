function cityFilter() {
    // Get input value
    const input = document.getElementById('filterInput');
    const filter = input.value.toUpperCase();

    // Get table rows
    const table = document.getElementById('userTable');
    const rows = table.getElementsByTagName('tr');

    // Loop through all rows and hide those that don't match the filter
    for (let i = 0; i < rows.length; i++) {
        // Assuming city is in the third column -> we can also find the index in the header, but this is faster
        const cityCell = rows[i].getElementsByTagName('td')[2];

        if (cityCell) {
            const cityText = cityCell.textContent || cityCell.innerText;

            if (cityText.toUpperCase().indexOf(filter) > -1) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }
}
