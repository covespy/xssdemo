// functions to support XSS demo
// Function to update sidebar with current results
function sbresultsrefresh(){
  $.ajax({
    url:"/evil/",
    success:function(data){
      // console.log(data);
      var response = jQuery.parseJSON(data);
      var len = response.length;
      var last = len ? response[len - 1].tstamp : "N/A";
      $('#resultslen').html(len);
      $('#resultslast').html(last);
    },
    error:function(data){
      $('#alertrow').removeClass('d-none');
      $('#alertrow').addClass('text-danger');
      $('#alertrow').html('Results not available');
      console.log(data);
    }
  });
}

// Function to reset results table
function sbresultsreset(){
  $.ajax({
    url:"/evil/reset.php",
    method:"POST",
    data: { reset: 1},
    success:function(data){
      // console.log(data);
      var response = jQuery.parseJSON(data);
      if (response.text.indexOf('successfully') >= 0) {
        $('#alertrow').removeClass('d-none');
        $('#sbalert').removeClass('alert-danger');
        $('#sbalert').addClass('alert-info');
        $('#alertmessage').html('Results reset');
      } else {
        $('#alertrow').removeClass('d-none');
        $('#alertmessage').html('There was an error resetting results');
      }
    },
    error:function(data){
      $('#alertrow').removeClass('d-none');
      $('#alertrow').addClass('text-danger');
      $('#alertrow').html('Results reset not available');
      console.log(data);
    }
  });
}

$(document).ready(function(){
  sbresultsrefresh();
});
$('#resultresetbtn').on("click",function(){
  sbresultsreset();
});
$('#resultrefreshbtn').on("click",function(){
  sbresultsrefresh();
  $('#alertrow').removeClass('d-none');
  $('#sbalert').removeClass('alert-danger');
  $('#sbalert').addClass('alert-success');
  $('#alertmessage').html('Results refreshed');
});
