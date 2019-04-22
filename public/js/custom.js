function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function() {
    readURL(this);
});


// var header = document.getElementById("accordionSidebar");
// var btns = header.getElementsByClassName("nav-item");
// for (var i = 0; i < btns.length; i++) {
//   btns[i].addEventListener("click", function() {
//   var current = document.getElementsByClassName("active");
//   current[0].className = current[0].className.replace(" active", "");
//   this.className += " active";
//   });
// }
$(document).ready(function(){
    $('ul li a').click(function(){
      $('li a').removeClass("active");
      $(this).addClass("active");
  });
  });
  $(document).ready(function(){
    $('collapse-item').click(function(){
      $('collapse-item').removeClass("active");
      $(this).addClass("active");
  });
  });
  $(document).ready(function(){
    $('collapse').click(function(){
      $('collapse').removeClass("show");
      $(this).addClass("show");
  });
  });
