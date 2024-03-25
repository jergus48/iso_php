window.onload = function () {
    var sortOrder = localStorage.getItem('sortOrder');
    var filter = localStorage.getItem('filter');
    var checkbox = document.getElementById("oboznamitSaCheckbox");
    if (filter == "true") {
        checkbox.checked = true;
    } else {
        checkbox.checked = false;
    }


    filterRows();

    if (sortOrder) {
        sortTableById(sortOrder);
    }
};

function sortTableById(order) {
    var table, rows, switching, i, x, y, shouldSwitch, vzostupne, zostupne;
    zostupne = document.getElementById("zostupne");
    vzostupne = document.getElementById("vzostupne");
    table = document.getElementById("isoDocTable");
    switching = true;

    // Store sorting order in localStorage
    localStorage.setItem('sortOrder', order);

    if (order === "asc") {
        vzostupne.style.textDecoration = "underline";
        zostupne.style.textDecoration = "none";
    } else {
        zostupne.style.textDecoration = "underline";
        vzostupne.style.textDecoration = "none";
    }
    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("TD")[1];
            y = rows[i + 1].getElementsByTagName("TD")[1];
            if (order === "asc") {
                if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {
                    shouldSwitch = true;
                    break;
                }
            } else if (order === "desc") {
                if (parseInt(x.innerHTML) < parseInt(y.innerHTML)) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}


function filterRows() {
    var checkbox = document.getElementById("oboznamitSaCheckbox");
    var rows = document.querySelectorAll("#isoDocTable .data-row");

    if (checkbox.checked) {
        localStorage.setItem('filter', "true");
    } else {
        localStorage.setItem('filter', "false");
    }
    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        if (cells.length > 0) {
            var dateink = cells[6].innerHTML.trim();
            var notDate = dateink.includes("button");

            if (checkbox.checked && notDate !== true) {
                rows[i].classList.add("hidden");
            } else {
                rows[i].classList.remove("hidden");
            }
        }
    }
}

function clearSortOrder() {
    localStorage.removeItem('sortOrder');
    localStorage.removeItem('filter');
}

