console.log(document.getElementById('subscribe'));
if(document.getElementById('subscribe') != null || document.getElementById('unsubscribe') != null)
{ 
    // ABONNEMENT
    document.getElementById('subscribe').addEventListener('click', () => {
        let idseries = document.getElementById('idseries').value;
        fetch('http://localhost:8888/p5/project-epizode-afm/index.php?action=addSubscription&idseries=' + idseries)
        .then(res => res.json())
        .then(responseServer => {
            console.log(responseServer);
            let nbSubscriptionsElt = document.getElementById('nbSubscriptions');
            nbSubscriptionsElt.textContent = Number(nbSubscriptionsElt.textContent) + 1 ;
            document.getElementById('subscribe').classList.add('hidden');
            document.getElementById('unsubscribe').classList.remove('hidden');
        })
    })
    // DESABONNEMENT
    document.getElementById('unsubscribe').addEventListener('click', () => {
        let idseries = document.getElementById('idseries').value;
        fetch('http://localhost:8888/p5/project-epizode-afm/index.php?action=removeSubscription&idseries=' + idseries)
        .then(res => res.json())
        .then(responseServer => {
            console.log(responseServer);
            let nbSubscriptionsElt = document.getElementById('nbSubscriptions');
            nbSubscriptionsElt.textContent = Number(nbSubscriptionsElt.textContent) - 1 ;
            document.getElementById('subscribe').classList.remove('hidden');
            document.getElementById('unsubscribe').classList.add('hidden');
        })
    })
}