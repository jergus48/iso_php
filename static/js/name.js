function searchNames() {
    // Get input value and convert to lowercase
    var input = document.getElementById("searchInput").value.toLowerCase();

    // Get table rows
    var rows = document.getElementById("isoDocTable").getElementsByTagName("tr");

    // Loop through all rows, starting from index 1 to skip the header row
    for (var i = 1; i < rows.length; i++) {
        var name = rows[i].getElementsByTagName("td")[0].textContent.toLowerCase(); // Get the name from the second cell

        // Remove diacritics and convert to lowercase
        name = name.normalize("NFD").replace(/[\u0300-\u036f]/g, "");

        // Check if the name contains the input value
        if (name.includes(input)) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}