/* A $( document ).ready() block.
$( document ).ready(function() {
$("#AjoutElement").on("click",function() {
    ajouterElement();
});*/

function ajouterElement() {
 $("#FormAjoutCursus").append( `    UV -
                     <div>N° du Semestre :<input type='text' name='numsem' size='10' maxlength='10' value='' /></div>
                    <div>Label du Semestre :<input type='text' name='labelsem' size='10' maxlength='10' value='' /></div>
                    <div>Sigle :<input type='text' name='sigle' size='5' maxlength='4' value='' /></div>
                    <div>Catégorie :<select name='categorie'>
                    <option>CS</option>
                    <option>TM</option>
                    <option>ME</option>
                    <option>EC</option>
                    <option>HT</option>
                    <option>NPML</option>
                    <option>ST</option>
                    </select></div>
                    <div>Affectation :
            <input type="radio" name='affectation' value='TC'/>Tronc Commun
            <input type="radio" name='affectation' value='TCBR'/>Tronc Commun de Branche
            <input type="radio" name='affectation' value='FCBR'/>Branche
                <div>A-t-elle a été passé à l'UTT ?
            <input type="radio" name='inUTT' value='true'/>Oui
            <input type="radio" name='inUTT' value='false'/>Non
                <div>Correspond-t-elle a votre profil ?
            <input type="radio" name='inProfil' value='true'/>Oui
            <input type="radio" name='inProfil' value='false'/>Non
                <div>Nombre de crédit obtenu :<input type='number' name='numcredit' size='5' maxlength='4' value='' /></div>
                <div>Résultat à l'UV :<select name='result'>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                    <option>E</option>
                    <option>FX</option>
                    <option>F</option>
                    </select></div> `);

}
});
