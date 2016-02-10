function cloneRow()
{
    addButton = document.querySelectorAll('.btn-success')[0];
    addButton = addButton.parentNode.parentNode.parentNode;
    addButtonClone = addButton.cloneNode(true);

    rows = getRows();
    rowOriginal = rows[0].parentNode.parentNode;
    rowClone = rowOriginal.cloneNode(true);
    // Clear row values
    rowCloneValues = rowClone.querySelectorAll('input[type=text]');
    rowCloneValues[0].value = null;
    rowCloneValues[1].value = null;
    // Append to HTML
    rowOriginal.parentNode.appendChild(rowClone);
    // Remove button then add it again to keep button at the bottom of the form
    addButton.remove();
    rowClone.parentNode.appendChild(addButtonClone);

    countRows();
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
        rows[0].setAttribute('disabled', null);
    } else if(rows.length > 1) {
        for(i = 0; i < rows.length; i++) {
            if(rows[i].hasAttribute('disabaled')) {
                continue;
            }

            rows[i].removeAttribute('disabled');
        }
    }
}

function getRows()
{
    return document.querySelectorAll('input[name="word_original[]"');
}
