
//Funktionen für die Filter..........................................................

class Filter{

    constructor(){
        this.events();
    }

    events(){
        
        
        $(".filtercheckboxes").on("click", this.clickDispatcher.bind(this));
    }

    clickDispatcher(){
        var checkedBoxes = [];
        var inputElements = document.getElementsByClassName("filtercheckboxes");
        for (var i = 0; i < inputElements.length; i++){
            if (inputElements[i].checked){
                checkedBoxes.push(inputElements[i]);
            }
        }
        console.log(checkedBoxes);
        console.log(inputElements);
        
        checkedBoxes = [];
    }

    filterActivities(_checkedBoxes){
        
    }
}

var filter = new Filter();


// Funktionen für das Dropdownmenü der Startseite....................................


function myFunction() {
  document.getElementById("dpMenue").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.activityBtn')) {
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
                    alert(response["responseText"]);
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
        $("#overlayAvatarUpload").on("click", this.clickDispatcher.bind(this));
    }

    clickDispatcher(e){
        var uploadButton = $(e.target).closest("#uploadBtn");
        if(uploadButton.attr("data-active") == "false"){
            this.showUploadDiv(uploadButton);
        }else{
            this.removeUploadDiv(uploadButton);
        }
    }

    showUploadDiv(_uploadButton){
        $("#overlayAvatarUpload").css({ 'display' : 'block'});
        $("#avatarUpload").css({ 'display' : 'block'});
        _uploadButton.attr("data-active", "true");
        $("#overlayAvatarUpload").on("click", this.removeUploadDiv.bind(this));
    }

    removeUploadDiv(){
        $("#overlayAvatarUpload").css({ 'display' : 'none'});
        $("#avatarUpload").css({ 'display' : 'none'});
        $('#uploadBtn').attr('data-active', "false");
    }
}

var AU = new AvatarUploader();
//...................................................................................................
//..................................Ortsbeschreibungsoverlay.........................................

class Ortsbeschreibungsoverlay{
    constructor(){
        this.events();
    }

    events(){
        $("#locationPopupActivator").on("click", this.clickDispatcher.bind(this));
        $("#overlayLocationWindow").on("click", this.clickDispatcher.bind(this));
    }

    clickDispatcher(e){
        var locationPopupActivator = $(e.target).closest("#locationPopupActivator");
        if(locationPopupActivator.attr("data-active") == "false"){
            this.showLocationPopup(locationPopupActivator);
        }else{
            this.removeLocationPopup(locationPopupActivator);
        }
    }

    showLocationPopup(_locationPopupActivator){
        $("#overlayLocationWindow").css({ 'display' : 'block'});
        $("#locationWindow").css({ 'display' : 'block'});
        _locationPopupActivator.attr("data-active", "true");
        $("#overlayLocationWindow").on("click", this.removeUploadDiv.bind(this));
    }

    removeLocationPopup(){
        $("#overlayLocationWindow").css({ 'display' : 'none'});
        $("#locationWindow").css({ 'display' : 'none'});
        $('#locationPopupActivator').attr('data-active', "false");
    }
}

var ObO = new Ortsbeschreibungsoverlay();

//...................................................................................................
//..................................mail.........................................

class Mail{
    constructor(){
        this.events();
    }

    events(){
        $("#button-std-submit").on("click", this.clickDispatcher.bind(this));
    }

    clickDispatcher(e){
        var submitButton = $(e.target).closest("#button-std-submit");
        this.sendEmail(submitButton);
    }

    sendEmail(_submitButton){

     $.ajax({
        beforeSend: (xhr) => {
            xhr.setRequestHeader("X-WP-Nonce", reftreffData.nonce)
        },
        url: "http://test2.local/wp-json/reftreff/v1/sendNotification",
        type: "POST",
        data: {"daten": "test"},
        success: (response) => {
            alert("gesendet");
            console.log(response);
        },
        error:(response) => {
            alert("error");
            console.log(response);
            
        }
    });
    }
}

var mail = new Mail();