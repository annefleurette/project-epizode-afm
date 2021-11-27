// Signaler un épisode
if(document.getElementById('alertepisode') != undefined)
{
    document.getElementById('alertepisode').addEventListener('click', () => {
        let idepisode = document.getElementById('idepisodealert').value;
        fetch('https://www.epizode.fr/index.php?action=addAlertEpisode&idepisode=' + idepisode)
        //fetch('http://localhost:8888/p5/project-epizode-afm/index.php?action=addAlertEpisode&idepisode=' + idepisode);
        .then(res => res.json)
        .then(resp => {
            alert("Votre signalement a bien été envoyé à l'administration");
        })  
    })
}

// Signaler un commentaire
if(document.getElementsByClassName('alertcomment') != undefined)
{
    Array.from(document.getElementsByClassName("alertcomment")).forEach(elt => {
        elt.addEventListener('click', () => { 
            let idcomment = elt.closest('article').querySelector('.idcommentalert').value; // antécédent le plus proche
            fetch('https://www.epizode.fr/index.php?action=addAlertComment&idcomment=' + idcomment)
            //fetch('http://localhost:8888/p5/project-epizode-afm/index.php?action=addAlertComment&idcomment=' + idcomment);
            .then(res => res.json)
            .then(resp => {
            alert("Votre signalement a bien été envoyé à l'administration");
            })
        })
    })
}
