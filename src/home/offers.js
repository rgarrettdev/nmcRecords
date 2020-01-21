window.onload = ajaxRequest(); //loads an offer when the page is loaded.

function ajaxRequest() {

var xhr = new XMLHttpRequest(); //request XMLHttpRequest object, creates instance of the class

xhr.onreadystatechange = function () { //when state changes run anonymous function
  if (xhr.readyState == 4 && xhr.status == 200) { //checks for errors in response.
    replaceElementById("offers", xhr.responseText); //places the result into offers aside
    }
  }

  xhr.open("GET", "getOffers.php", true); //call open method from class.
  xhr.send(); //sends request

}

function replaceElementById(id, text) {
  document.getElementById(id).innerHTML = text;
}

setInterval(function(){
  ajaxRequest();
},5000);    //calls ajaxRequest every 5 seconds.
