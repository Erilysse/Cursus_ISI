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
    document.getElementById(UV).appendChild(element);
}