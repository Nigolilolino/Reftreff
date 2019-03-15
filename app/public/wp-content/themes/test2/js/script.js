
//Funktionen für die Filter..........................................................
    function refreshActivities(){
        var checkboxes = document.getElementsByClassName("filterCheckboxes");
        var checkboxValues = [];
        console.log("tada");
        
        for(var i = 0; i < checkboxes.length; i++){
            if(checkboxes[i].checked){
                checkboxValues.push(checkboxes[i].value);
            }
        }
        prepareArguments(checkboxValues);

};

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
*/
function removeAvtivities(){
    var activitieArea = document.getElementsByClassName("aktivity_area");
    while(activitieArea[0].firstChild) 
    activitieArea[0].removeChild(activitieArea[0].firstChild);
}

//....................................................................................
}
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
                console.log(response);
            },
            error:(response) => {
                console.log(response);
            }
        });
    }


}

var FAB = new FollowActivityButton();

//..............................................................................................

class Comments{
    constructor(){
        this.events();
    }
    events(){
        $(".commentDeleteBtn").on("click", this.deletComment.bind(this));
    }

    deletComment(e){
        var currentDeleteButton = $(e.target).closest(".commentDeleteBtn");
        console.log(currentDeleteButton.attr("data-commentId"));
    }

}

var com = new Comments();