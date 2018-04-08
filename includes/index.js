$('#yourBox').change(function() {
    $('yourText').attr('disabled',!this.checked)
});