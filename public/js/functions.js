/*
 * Question creation
 */
window.onload = function(e) {
    countRows();
}

function cloneRow()
{
    addButton = $('.btn-success').eq(0);

    rows = getRows();
    rowOriginal = rows.eq(0).parent().parent();
    rowClone = rowOriginal.clone(true);
    // Clear row values
    rowClone.find('input[type=text]').val(null);
    rowClone.find('input[type=hidden]').val(null);
    // Append to HTML
    rowClone.insertBefore(addButton.parent().parent());

    countRows();
}

function removeRow(row)
{
    $(row).parent().parent().remove();
    countRows();
}

function countRows()
{
    rows = $('.glyphicon-minus');

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
    return $('input[name="word_original[]"');
}

/*
 * Set Deletion
 */
function confirmSetDelete(button, e)
{
    form = $(button).parent();

    e.preventDefault();

    if(confirm('Are you sure you want to delete this set?')) {
        form.submit();
    }

}

/*
 *
 */
