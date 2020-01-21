window.onload = ajaxRequestXML(); //loads an offer when the page is loaded.

function ajaxRequestXML() {

var xhr = new XMLHttpRequest(); //request XMLHttpRequest object, creates instance of the class


xhr.onreadystatechange = function () { //when state changes run anonymous function
  if (xhr.readyState == 4 && xhr.status == 200) { //checks for errors in response.
    const parser = new DOMParser();
    const xmlDoc = parser.parseFromString(xhr.responseText,"text/xml"); //parse the xml.
    console.log(xmlDoc);
    var aside = document.getElementById('XMLoffers');

        title = xmlDoc.getElementsByTagName("recordTitle")[0].firstChild.nodeValue;
        desc = xmlDoc.getElementsByTagName("catDesc")[0].firstChild.nodeValue;
        price = xmlDoc.getElementsByTagName("recordPrice")[0].firstChild.nodeValue;

        console.log(title);
        console.log(desc);
        console.log(price);

        aside.innerHTML = "<p>" + title + "<br/>" + "<span>" + "Category: " + desc + "</span>" + "<br/>"
        + "<span>" + "Price: " + price + "</span>" + "</p>";  //formated to look like the other offers
    }
  }
  xhr.open("GET", "getOffers.php?useXML", true); //call open method from class.
  xhr.send(); //sends request

}
