let deleteBtns = document.querySelectorAll('.delete');
if(deleteBtns.length > 0 ){
    deleteBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            let valid = confirm("Confirmez-vous la suppression ?");
            if(!valid){
                e.preventDefault();
            }
        })
    })
}

