//Comments as table in frontend chapter view
var table = $(document).ready( function () {
    $('#table_comments').DataTable({
        responsive: true,
        language: {
            processing:     "Traitement en cours...",
            search:         "Rechercher&nbsp;:",
            lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
            info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            infoPostFix:    "",
            loadingRecords: "Chargement en cours...",
            zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            emptyTable:     "Aucune donnée disponible dans le tableau",
            paginate: {
                first:      "Premier",
                previous:   "Pr&eacute;c&eacute;dent",
                next:       "Suivant",
                last:       "Dernier"
            },
            aria: {
                sortAscending:  ": activer pour trier la colonne par ordre croissant",
                sortDescending: ": activer pour trier la colonne par ordre décroissant"
            }
        },
        lengthMenu: [ 5, 10, 15, 25, 50 ]
    });
});

//To adapt chapter view font-size
function ChangeFontSize(){
    document.getElementById('fontSizeForm').addEventListener("change", function (e) {
        console.log("Taille de police : " + e.target.value);
        if(e.target.value == 14){
            document.getElementById('chapterText').style.fontSize = "14px";
        } else if (e.target.value == 16){
            document.getElementById('chapterText').style.fontSize = "16px";
        } else if (e.target.value == 18){
            document.getElementById('chapterText').style.fontSize = "18px";
        } else if (e.target.value == 20){
            document.getElementById('chapterText').style.fontSize = "20px";
        } else if (e.target.value == 22){
            document.getElementById('chapterText').style.fontSize = "22px";
        }
    });
}

//To disappear the message of confirmation when posting a new comment
(function disappearMsg(){
    setTimeout(function(){
        $('#msgConfirNewComment').hide(); 
    }, 5000);
}())

//To disappear the message of confirmation when reporting a comment
(function disappearMsg(){
    setTimeout(function(){
        $('#msgConfirReportComment').hide(); 
    }, 5000);
}())