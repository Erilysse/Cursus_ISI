// Compteur est une variable de type nombre qui permet de répertorier le nombre d'UV que l'utilisateur veut ajouter.
var compteur = 1;

// Bonne function
/*
 * ajouterUV() permets d'ajouter un nouveau formulaire afin d'ajouter une nouvelle UV sur la même page HTML.
 * Elle récupère le premier formulaire d'UV, le clone et le copie à sa suite.
 * L'id de copie est incrémenté ainsi que les différents éléments du formulaire.
 */
function ajouterUV(){
    var element = document.getElementById('UV1');
    var copie = element.cloneNode(true);
    copie.id= 'UV' + ++compteur;
    element.parentNode.appendChild(copie);
}