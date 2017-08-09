var limit = 3;

function addProject(){
    var counter = document.getElementsByName('projectNames[]').length;
     if (counter == limit)  {
          alert("You have reached the limit of " + counter + " projects");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<br> Project Name: <input type='text' name='projectNames[]' required> <br><br> Project Description:<br><br> <textarea name='projectInfo[]' rows='6' cols='80'> </textarea> <br>Project Image: <br><br><input type='file' name='projectImages[]'> <br><br>";

          document.getElementById("projectInput").appendChild(newdiv);
          counter++;
     }
}

function deleteProject(){
    var counter = document.getElementsByName('projectNames[]').length;
     if (counter == 0)  {
          alert("No projects to delete");
     }
     else {

         var div = document.getElementById("projectInput");
         div.removeChild(div.lastChild);
         counter--;
     }
}

