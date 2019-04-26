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

var url = window.location;
$('ul.navbar-nav a').filter(function () {
    return this.href == url;
}).parents('li').addClass('active');
$('div.collapse a').filter(function () {
    if (this.href == url) {
        $('div#collapsePages').addClass('show');
    }
    return this.href == url;
}).addClass('active');
