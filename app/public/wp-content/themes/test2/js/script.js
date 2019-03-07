
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

