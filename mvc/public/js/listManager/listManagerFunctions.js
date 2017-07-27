//Created by Zhenwei Zhang Monikos LLC


/* Open when someone clicks on the span element */
function logout(){
    $.get("../../../../db/logout.php",function(data,status){
       console.log(data); 
    });
    
    window.location = window.location.origin = "/mvc/public/landing.html";
}
function openNav() {
  document.getElementById("createList_overlay").style.width = "100%";
}

/* Close when someone clicks on the "x" symbol inside the overlay */
function closeNav() {
  document.getElementById("createList_overlay").style.width = "0%";
}

function home() {
  window.location = window.location.origin + "/mvc/public/home";
}

function drugDatabase() {
  window.location = window.location.origin + "/mvc/public/home/drugDatabase";
}

function listManager() {
  window.location = window.location.origin + "/mvc/public/home/listManager";
}


$(document).ready(function() {

  $('.list-collection-block').on('click', '.list-block', function() {

    var brands = $(this.childNodes[3]);
    console.log(this.childNodes);

    brands.slideToggle("fast");
  });


});

$(function() {
  $('#search').on('keyup', function() {
    var pattern = $(this).val();
    $('.searchable-container .item').hide();
    $('.searchable-container .item').filter(function() {
      return $(this).text().match(new RegExp(pattern, 'i'));
    }).show();
  });

  $('#searchlist').on('keyup', function() {
    var pattern = $(this).val();
    $('.list-collection-block .list_block').filter(function() {
      // console.log($(this.childNodes[1]));
      console.log($('.list_name_header').text());
      return $('.list_name_header').text().match(new RegExp(
        pattern, 'i'));
    }).show();
  });
});
