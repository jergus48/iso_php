
const numberInput = document.getElementById('numberInput');
const numberSpans = document.querySelectorAll('.number span');
const deleteSpan = document.getElementById('delete');
function addNumberToInput(number) {

    numberInput.value += number;

}


function deleteLastNumberFromInput() {

    if (numberInput.value.length > 0) {

        numberInput.value = numberInput.value.slice(0, -1);
    }
}



numberSpans.forEach(function (span) {
    span.addEventListener('click', function () {
        const number = span.dataset.number;

        if (typeof number !== "undefined" && number !== null) {
            addNumberToInput(number);
        }
    });
});