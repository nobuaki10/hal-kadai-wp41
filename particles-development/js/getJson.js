function getJson(){
  httpObj = new XMLHttpRequest();
      httpObj.open("get", "./json/voice.json", true);
      httpObj.onload = function(){
              var myData = JSON.parse(this.responseText);
              var txt = "";
              for (var i=0; i<myData.length; i++){
                 var option = document.createElement("option");
                  option.innerText = myData[i].name;
                  option.value=myData[i].value;
                  document.getElementById("group_select").appendChild(option);
              }
          }
     httpObj.send(null);
}
