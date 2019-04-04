
//Funktionen für die Filter..........................................................

function refreshActivities(){
    var checkboxes = document.getElementsByClassName("filtercheckboxes");
    var checkboxValues = [];
    
    for(var i = 0; i < checkboxes.length; i++){
        if(checkboxes[i].checked){
            checkboxValues.push(checkboxes[i].value);
        }
    }
    var jsonString = JSON.stringify(checkboxValues);

    $.ajax({
        beforeSend: (xhr) => {
            xhr.setRequestHeader("X-WP-Nonce", reftreffData.nonce)
        },
        url: "http://test2.local/wp-json/reftreff/v1/manageFilter",
        type: "POST",
        data: {"checkboxValues": jsonString},
        success: (response) => {
            alert("erfolgreich");
            console.log(response);
        },
        error:(response) => {
            alert("fail");
            console.log(response);
        }
    });


};
/*
function prepareArguments(_values){
    var args = "array('numberposts' => -1, 'post_type' => 'referate','meta_query'	=> array('relation'	=> 'AND',"
            
    for(var i = 0; i < _values.length; i++){
        console.log(_values[i]);
        args += "array('key' => 'referate_tags','value' => \'"+_values[i]+"\','compare' => 'LIKE'),"
    }
    args += "),);";

        var area = document.getElementsByClassName("aktivity_area")[0];
        while (area.firstChild) {
            area.removeChild(area.firstChild);
        }
            //$( ".activities" ).replaceWith( "<div class='activities'></div>" );
            $.ajax({
            url: 'index.php',
            type: 'post',
            data: { "callFunc1": args},
            success: function(response) { alert(response); }
        });
            //$(".aktivity_area").load("index.php .aktivity_area");
            /*
            jQuery.ajax({
                type: "Post",
                url: "index.php",
                dataType: "html",
                data: {functionname: "queryNewActivities", arguments: args},

                success: function(){
                    alert(args);
                }
            });
        };

function removeAvtivities(){
    var activitieArea = document.getElementsByClassName("aktivity_area");
    while(activitieArea[0].firstChild) 
    activitieArea[0].removeChild(activitieArea[0].firstChild);
}

//....................................................................................
}
*/
// Funktionen für das Dropdownmenü der Startseite....................................


function myFunction() {
  document.getElementById("dpMenue").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

//............................................................................................

//...........................................Follow Funktionen................................
class FollowActivityButton{
    constructor(){
        this.events();
    }

    events(){
        $("#activityFollowBtn").on("click", this.clickDispatcher.bind(this));
    }

    clickDispatcher(e){
        var currentFollowButton = $(e.target).closest("#activityFollowBtn");

        if(currentFollowButton.attr("data-exists") == "yes"){
            this.defollowActivity(currentFollowButton);
        }else{
            this.followActivity(currentFollowButton);
        }
    }

    followActivity(_currentFollowButton){
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader("X-WP-Nonce", reftreffData.nonce)
            },
            url: "http://test2.local/wp-json/reftreff/v1/manageFollow",
            type: "POST",
            data: {"activityId": _currentFollowButton.data("activity"), "followerId": _currentFollowButton.data("userid")},
            success: (response) => {
                _currentFollowButton.attr("data-exists", "yes");
                _currentFollowButton.attr("data-follow", response);
                console.log(response);
            },
            error:(response) => {
                console.log(response);
            }
        });
    }

    defollowActivity(_currentFollowButton){
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader("X-WP-Nonce", reftreffData.nonce)
            },
            url: "http://test2.local/wp-json/reftreff/v1/manageFollow",
            data: {"following": _currentFollowButton.attr("data-follow")},
            type: "DELETE",
            success: (response) => {
                _currentFollowButton.attr("data-exists", "no");
                _currentFollowButton.attr("data-follow","");
                
                if($("#participationBtn").data("exists") == "yes"){
                    PAB.stopParticipatingInActivity($("#participationBtn"));
                }

            },
            error:(response) => {
                console.log(response);
            }
        });
    }


}

var FAB = new FollowActivityButton();

//..............................................................................................

//....................................Kommentarfunktion.........................................
class Comments{
    constructor(){
        this.events();
    }
    events(){
        $(".commentDeleteBtn").on("click", this.deletComment.bind(this));
    }

    deletComment(e){
        var currentDeleteButton = $(e.target).closest(".commentDeleteBtn");
        var test = currentDeleteButton[0].dataset.commentid;

        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader("X-WP-Nonce", reftreffData.nonce)
            },
            url: "http://test2.local/wp-json/reftreff/v1/manageComments",
            data: {"commentId": test},
            type: "DELETE",
            success: (response) => {
                
                $(currentDeleteButton).closest(".participant")[0].remove();
                console.log(response);
            },
            error:(response) => {
                console.log("fail")
                console.log(response);
            }
        });
    }
}

var com = new Comments();

//..............................................................................................
//.....................................Teilnahme an Aktivitäten...................................
class ParticipateInActivityButton{
    constructor(){
        this.events();
    }

    events(){
        $("#participationBtn").on("click", this.clickDispatcher.bind(this));
    }

    clickDispatcher(e){
        var currentParticipationButton = $(e.target).closest("#participationBtn");

        if(currentParticipationButton.attr("data-exists") == "yes"){
            this.stopParticipatingInActivity(currentParticipationButton);
        }else{
            this.participateInActivity(currentParticipationButton);
        }
    }

    participateInActivity(_currentParticipationButton){

        if($("#activityFollowBtn").data("exists") == "no"){
            alert("Du musst einer Aktivität erst Folgen, bevor du daran Teilnehmen kannst.");
        }else{
            $.ajax({
                beforeSend: (xhr) => {
                    xhr.setRequestHeader("X-WP-Nonce", reftreffData.nonce)
                },
                url: "http://test2.local/wp-json/reftreff/v1/manageParticipation",
                type: "POST",
                data: {"activityId": _currentParticipationButton.data("activity"), "participantId": _currentParticipationButton.data("userid")},
                success: (response) => {
                    _currentParticipationButton.attr("data-exists", "yes");
                    _currentParticipationButton.attr("data-participation", response);
                    console.log(response);
                },
                error:(response) => {
                    console.log(response);
                }
            });
        }
    }

    stopParticipatingInActivity(_currentParticipationButton){
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader("X-WP-Nonce", reftreffData.nonce)
            },
            url: "http://test2.local/wp-json/reftreff/v1/manageParticipation",
            data: {"participating": _currentParticipationButton.attr("data-participation")},
            type: "DELETE",
            success: (response) => {
                _currentParticipationButton.attr("data-exists", "no");
                _currentParticipationButton.attr("data-participation","");
                console.log(response);
            },
            error:(response) => {
                console.log(response);
            }
        });
    }
}

var PAB = new ParticipateInActivityButton();

//.................................................................................................

//..................................Avatar Upload Funktionen.......................................

class AvatarUploader{
    constructor(){
        this.events();
    }

    events(){
        $("#uploadBtn").on("click", this.clickDispatcher.bind(this));
        $("#overlay").on("click", this.clickDispatcher.bind(this));
    }

    clickDispatcher(e){
        var uploadButton = $(e.target).closest("#uploadBtn");
        var overlay = $(e.target).closest("#overlay");
        if(uploadButton.attr("data-active") == "false"){
            this.showUploadDiv(uploadButton);
        }else{
            this.removeUploadDiv(uploadButton);
        }
    }

    showUploadDiv(_uploadButton){
        $("#overlay").css({ 'display' : 'block'});
        $("#avatarUpload").css({ 'display' : 'block'});
        _uploadButton.attr("data-active", "true");
        $("#overlay").on("click", this.removeUploadDiv.bind(this));
    }

    removeUploadDiv(){
        //ändert das data Attribute nicht
        $("#overlay").css({ 'display' : 'none'});
        $("#avatarUpload").css({ 'display' : 'none'});
        $('#uploadBtn').attr('data-active', "false");
    }
}

var AU = new AvatarUploader();

