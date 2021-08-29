// DELETE EPISODE
if(document.getElementById('deleteepisode') != undefined)
{
    document.getElementById('deleteepisode').addEventListener('click', () => {
        confirm("Êtes-vous sûr(e) de vouloir supprimer cet épisode ?");
    })
}
