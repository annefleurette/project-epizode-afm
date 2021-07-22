if(document.getElementById('like') != undefined){
    // LIKES
    document.getElementById('like').addEventListener('click', () => {
        let idepisode = document.getElementById('idepisode').value;
        fetch('http://localhost:8888/p5/project-epizode-afm/index.php?action=addLike&idepisode=' .idepisode)
        .then(res => res.json())
        .then(responseServer => {
            console.log(responseServer);
            document.getElementById('nbLikes').textContent = responseServer.likes;
            document.getElementById('like').disabled = true;
        })
    })
}else{
    // DISLIKES
    document.getElementById('dislike').addEventListener('click', () => {
        let idepisode = document.getElementById('idepisode').value;
        fetch('http://localhost:8888/p5/project-epizode-afm/index.php?action=removeLike&idepisode=' .idepisode)
        .then(res => res.json())
        .then(responseServer => {
            console.log(responseServer);
            document.getElementById('nbLikes').textContent = responseServer.likes;
            document.getElementById('like').disabled = true;
        })
    })
}
