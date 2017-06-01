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

// Mauvaise function
function ajouterElement(){
    var element = document.createElement('fieldset');
    element.innerHTML = ""
        +"<div>N° du Semestre : <input type='text' name='numsem' size='10' maxlength='10' value='' /></div>"
        +"<div>Label du Semestre :<input type='text' name='labelsem' size='10' maxlength='10' value='' /></div>"
        +"<div>Sigle :<input type='text' name='sigle' size='5' maxlength='4' value='' /></div>"
        +"<div>Catégorie :<?php inputSelect($Categorie_Options,'categorie');?></div>"
        +"<div>Affectation :<?php inputRadio($Affectations_Options,'affectation');?></div>"
        +"<div>A-t-elle a été passé à l'UTT ?"
          + "<?php inputRadio($Boolean_Options,'inUTT'); ?></div>"
        +"<div>Correspond-t-elle a votre profil ?"
          + "<?php inputRadio($Boolean_Options,'inProfil'); ?></div>"
        +"<div>Nombre de crédit obtenu :<input type='number' name='numcredit' size='5' maxlength='4' value='' /></div>"
        +"<div>Résultat à l'UV :<?php inputSelect($Resultats_Options,'result'); ?></div>"
        +"</fieldset>";
    document.getElementById().appendChild(element);
}