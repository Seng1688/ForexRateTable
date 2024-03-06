
document.addEventListener("DOMContentLoaded", function() {

  //append base to the url when base is changed
  document.getElementById("base").addEventListener("change", function() {

      var currUrl =  window.location.href;

      if(currUrl.indexOf("?") > -1){

        currUrl = currUrl.split("?")[0];

      }
      window.location.href = currUrl + "?base=" + this.value;

    });

});
