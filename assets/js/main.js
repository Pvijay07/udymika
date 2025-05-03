$(document).ready(function(){
    // -----Country Code Selection
  $("#mobile_code").intlTelInput({
      initialCountry: "in",
      separateDialCode: true,
      // utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
  });



  $('[name=tab]').each(function(i,d){
    var p = $(this).prop('checked');
  //   console.log(p);
    if(p){
      $('article').eq(i)
        .addClass('on');
    }    
  });  

  $('[name=tab]').on('change', function(){
    var p = $(this).prop('checked');
    
    // $(type).index(this) == nth-of-type
    var i = $('[name=tab]').index(this);
    
    $('article').removeClass('on');
    $('article').eq(i).addClass('on');
  });


  // Show the first tab and hide the rest
  $('#kyc-heading li:first-child').addClass('active');
  $('.tab-content').hide();
  $('.tab-content:first').show();

  // Click function
  $('#kyc-heading li').click(function(){
    $('#kyc-heading li').removeClass('active');
    $(this).addClass('active');
    $('.tab-content').hide();
    
    var activeTab = $(this).find('a').attr('href');
    $(activeTab).fadeIn();
    return false;
  });

  $('.down-pop_up').click(function() {
      $('#doc-down-load').show(500); 
  });

  $('#raise-grev').click(function() {
      $('.grev-raise_pop').show(500); 
  });
  $('.forum-pop').click(function() {
      $('.query-forum').show(500);
  });
 
   $('#ad-document').click(function() {
      $('.dash-board-popup').show(500);
  });

   $('.cht-experience').click(function() {
      $('.experience-con').show(500);
      $('.query-forum').hide(500);
  });

   $('.experience-con a').click(function() {
        $('.experience-con').hide(500);
  });  



  $('.frst-tab-li, ul.empcountdiv, .kyc-form-cntrl2, .notreg, .ifreg, .dpitupload, .udyamupload').hide();

  $('.frst-tab-unorder > li').click(function() {
    $('.frst-tab-li').hide();
    $(this).find('ul').show();
  });  
  $('input[type=radio][name=age]').change(function() {
    if (this.value == 'startup') {
      $('.frst-tab-li').hide();
      $('.startup').show();
    }
    else if (this.value == 'job') {
      $('.frst-tab-li').hide();
      $('.job').show();
    }
    else if (this.value == 'support') {
      $('.frst-tab-li').hide();
      $('.support').show();
    }
  }); 
  $('input[type=radio][name=empcount]').change(function() {
    if (this.value == 'yes') {
      $('ul.empcountdiv').show();
      $('.kyc-form-cntrl2').hide();
    }
    else if (this.value == 'no') {
      $('ul.empcountdiv').hide();
      $('.kyc-form-cntrl2').show();
    }
  }); 
  $('input[type=radio][name=regvrfy]').change(function() {
    if (this.value == 'yes') {
      $('ul.ifreg').show();
      $('ul.notreg').hide();
    }
    else if (this.value == 'no') {
      $('ul.ifreg').hide();
      $('ul.notreg').show();

    }
  });  
  $('input[type=radio][name=dpit]').change(function() {
    if (this.value == 'yes') {
      $('.dpitupload').show();
    }
    else if (this.value == 'no') {
      $('.dpitupload').hide();
    }
  }); 
  $('input[type=radio][name=udyam]').change(function() {
    if (this.value == 'yes') {
      $('.udyamupload').show();
    }
    else if (this.value == 'no') {
      $('.udyamupload').hide();
    }
  });  




   

});