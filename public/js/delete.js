// DELETE
if(document.getElementById('delete') != undefined)
{
    document.getElementById('delete').addEventListener('click', (e) => {
        let valid = confirm("Confirmez-vous la suppression ?");
        if(!valid){
            e.preventDefault();
        }
    })
}
