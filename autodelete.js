
function delete_data(id) {
var info = 'id=' + id;
if(confirm("Are you sure you want to delete this Record?")){
    $.ajax
    ({
        type:'POST',
        url:'delete.php',
        data:info,
        success:function(data) {
                $("#row" + id).remove();
        }
    });
}
}
