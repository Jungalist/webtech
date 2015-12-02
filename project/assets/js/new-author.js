var count = 1;
var max = 3;
function addAuthor(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + count + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "Author " + (counter + 1) + " <br />{{f.text({label: 'Author" +  (count + 1) +"', name: 'author"+ (count + 1) + "', required: 1})}}";
          document.getElementById(divName).appendChild(newdiv);
          counter++;
     }
}