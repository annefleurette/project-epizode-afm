if(document.getElementById('subscribe') != undefined){
    // ABONNEMENT
    document.getElementById('subscribe').addEventListener('click', () => {
        let idseries = document.getElementById('idseries').value;
        fetch('http://localhost:8888/p5/project-epizode-afm/index.php?action=addSubscription&idseries=' .idseries)
        .then(res => res.json())
        .then(responseServer => {
            console.log(responseServer);
            document.getElementById('nbSubscriptions').textContent = responseServer.subscriptions;
            document.getElementById('subscribe').disabled = true;
        })
    })
}else{
    // DESABONNEMENT
    document.getElementById('unsubscribe').addEventListener('click', () => {
        let idseries = document.getElementById('idseries').value;
        fetch('http://localhost:8888/p5/project-epizode-afm/index.php?action=removeSubscription&idseries=' .idseries)
        .then(res => res.json())
        .then(responseServer => {
            console.log(responseServer);
            document.getElementById('nbSubscriptions').textContent = responseServer.subscriptions;
            document.getElementById('unsubscribe').disabled = true;
        })
    })
}
