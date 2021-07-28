if(document.getElementById('like') != undefined) OR (document.getElementById('dislike') != undefined)
{
    // LIKES
    document.getElementById('like').addEventListener('click', () => {
        let idepisode = document.getElementById('idepisode').value;
        fetch('http://localhost:8888/p5/project-epizode-afm/index.php?action=addLike&idepisode=' + idepisode)
        .then(res => res.json())
        .then(responseServer => {
            console.log(responseServer);
            let nbLikesElt = document.getElementById('nbLikes');
            nbLikesElt.textContent = Number(nbLikesElt.textContent) + 1 ;
            document.getElementById('like').classList.add('hidden');
            document.getElementById('dislike').classList.remove('hidden');
        })
    })

    // DISLIKES
    document.getElementById('dislike').addEventListener('click', () => {
        let idepisode = document.getElementById('idepisode').value;
        fetch('http://localhost:8888/p5/project-epizode-afm/index.php?action=removeLike&idepisode=' + idepisode)
        .then(res => res.json())
        .then(responseServer => {
            console.log(responseServer);
            let nbLikesElt = document.getElementById('nbLikes');
            nbLikesElt.textContent = Number(nbLikesElt.textContent) - 1 ;
            document.getElementById('like').classList.remove('hidden');
            document.getElementById('dislike').classList.add('hidden');
        })
    })
}

