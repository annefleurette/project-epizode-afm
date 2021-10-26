// Compter le nombre de caractères saisis
function tinySignCount(){
	let theEditor = tinymce.activeEditor;
	let wordCount = theEditor.plugins.wordcount.body.getCharacterCount();
	document.getElementById("nbCharacters").value = wordCount;
}
document.querySelector('.container section form').addEventListener('submit', () => {
	tinySignCount()
})

