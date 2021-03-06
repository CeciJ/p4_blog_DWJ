//Comments as table in frontend chapter view
$(document).ready( function () {
    $('#table_comments_admin').DataTable({
        searching: false,
        responsive: true,
        lengthMenu: [ 5, 10, 15, 25, 50 ],
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
        }
    });
    $('#table_list_users').DataTable({
        searching: false,
        responsive: true,
        lengthMenu: [ 5, 10, 15, 25, 50 ],
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
        }
    });
});

//To adapt chapter view font-size
function ChangeFontSize(){
    document.getElementById('fontSizeForm').addEventListener("change", function (e) {
        console.log("Taille de police : " + e.target.value);
        if(e.target.value == 14){
            document.getElementById('chapterViewAdmin').style.fontSize = "14px";
            document.getElementById('noComments').style.fontSize = "14px";
        } else if (e.target.value == 16){
            document.getElementById('chapterViewAdmin').style.fontSize = "16px";
            document.getElementById('noComments').style.fontSize = "16px";
        } else if (e.target.value == 18){
            document.getElementById('chapterViewAdmin').style.fontSize = "18px";
            document.getElementById('noComments').style.fontSize = "18px";
        } else if (e.target.value == 20){
            document.getElementById('chapterViewAdmin').style.fontSize = "20px";
            document.getElementById('noComments').style.fontSize = "20px";
        } else if (e.target.value == 22){
            document.getElementById('chapterViewAdmin').style.fontSize = "22px";
            document.getElementById('noComments').style.fontSize = "22px";
        }
    });
};

//To add confirm before deleting chapter, comment and user
function Supp(link){
    if(confirm('Confirmer la suppression ?')){
        document.location.href = link;
    }
};

//To disappear the message of confirmation when editing a comment
(function disappearMsg(){
    setTimeout(function(){
        $('#msgEditCommentOk').hide(); 
    }, 5000);
}());

//To disappear the message of confirmation when deleting a comment
(function disappearMsg(){
    setTimeout(function(){
        $('#msgDelCommentOk').hide(); 
    }, 5000);
}());

//To disappear the message of confirmation when editing admin infos
(function disappearMsgConfirUser(){
    setTimeout(function(){
        $('#msgConfirmEditUserOk').hide(); 
    }, 5000);
}());

//To disappear the message of confirmation when adding a new admin
(function disappearMsgConfirmAddUser(){
    setTimeout(function(){
        $('#msgConfirmAddUserOK').hide(); 
    }, 5000);
}());

//To disappear the message of confirmation when deleting an admin
(function disappearMsgConfirmDelUser(){
    setTimeout(function(){
        $('#msgConfirmDelUserOK').hide(); 
    }, 5000);
}());

//To disappear the message of confirmation when deleting a chapter
(function disappearMsgConfirmDelChapter(){
    setTimeout(function(){
        $('#msgConfirmDelChapterOK').hide(); 
    }, 5000);
}());