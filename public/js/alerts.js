// ALERT EPISODE
if(document.getElementById('alertepisode') != undefined)
{
    document.getElementById('alertepisode').addEventListener('click', () => {
        let idepisode = document.getElementById('idepisodealert').value;
        fetch('http://localhost:8888/p5/project-epizode-afm/index.php?action=addAlertEpisode&idepisode=' + idepisode);
        alert("Votre signalement a bien été envoyé à l'administration");
    })
}

// ALERT COMMENT
if(document.getElementById('alertcomment') != undefined)
{
    document.getElementById('alertcomment').addEventListener('click', () => {
        let idcomment = document.getElementById('idcommentalert').value;
        fetch('http://localhost:8888/p5/project-epizode-afm/index.php?action=addAlertComment&idcomment=' + idcomment);
        alert("Votre signalement a bien été envoyé à l'administration");
    })
}
