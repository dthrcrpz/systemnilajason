function sort(){
	sort_type = document.getElementById("sel1").value;
	window.location.assign('/?sortby='+sort_type);
}

function addroomtype(id){
	window.location.assign('/addroomtype?id='+id);
}

function removeroomtype(id){
	window.location.assign('/removeroomtype?id='+id);
}

function deleteroom(id){
	window.location.assign('/deleteroom?id='+id);
}

function loadroomphoto(photo){
	document.getElementById('roomphoto').src = '/uploads/'+photo;
}

function initMap(latitude, longitude) {
        // var latlng = {lat: 16.0411463, lng: 120.3356168};
        var latlng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};
        var map = new google.maps.Map(document.getElementById('hotelmap'), {
          zoom: 16,
          center: latlng
        });
        var marker = new google.maps.Marker({
          position: latlng,
          map: map
        });
}

function changeMarkerPosition(marker) {
        var latlng = new google.maps.LatLng(-24.397, 140.644);
        marker.setPosition(latlng);
}

function rateUp(hotelid){
    var xmlhttp;
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }
    else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4){
            document.getElementById("hotelRatings"+hotelid).innerHTML = xmlhttp.responseText;
        }
    }
    url = "/rateup?h="+hotelid;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function rateDown(hotelid){
    var xmlhttp;
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }
    else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4){
            document.getElementById("hotelRatings"+hotelid).innerHTML = xmlhttp.responseText;
        }
    }
    url = "/ratedown?h="+hotelid;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function hotelComment(hotelid){
    var hotelID = $("#comment_hotelid").val(hotelid);
    var xmlhttp;
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }
    else{
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function(){
        if(xmlhttp.readyState == 4){
            $("#commentsContent").html(xmlhttp.responseText);
        }
    }
    url = "/comments/view?id="+hotelid;
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function deleteComment(commentid){
    window.location.assign('/comment/delete/'+commentid);
}

var hotelToDelete = 0;

function setHotelToDelete(id){
    hotelToDelete = id;
}

function deleteHotel(){
    window.location.assign("/viewhotels/delete/"+hotelToDelete);
}
