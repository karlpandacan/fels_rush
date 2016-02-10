function cloneRow()
{
    rows = getRows();
    rowOriginal = rows[rows.length - 1].parentNode.parentNode;
    rowClone = rowOriginal.cloneNode(true);
    rowClone.insertBefore(rowClone, rowOriginal.parentNode);

}

function removeRow(row)
{
    row.parentNode.parentNode.remove();
    countRows();
}

function countRows()
{
    rows = document.querySelectorAll('.glyphicon-minus');

    if(rows.length < 2) {
        rows[0].setAttribute("disabled", null);
    } else {
        rows[0].removeAttribute("disabled");
    }
}

function getRows()
{
    return document.querySelectorAll('input[name="word_original[]"');
}
