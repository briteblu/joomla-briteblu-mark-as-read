jQuery(document).ready(function() {

  // Helper function to easily replace existing class
  (function ($) {
    $.fn.replaceClass = function (pFromClass, pToClass) {
        if (this.hasClass(pFromClass)) {
          return this.removeClass(pFromClass).addClass(pToClass);
        } else {
          return this;
        }
    };

    $("form.markasread_form button").click(function(event){
      // Cancel default even handler
      event.preventDefault();
  
      // Find form belonging to submit button
      form = document.getElementById('markasread_form_' + $(this).attr('value'));
  
      // If form was found, submit it using the custom form submit handler
      if (form) {
        Joomla.submitform('', form);
      }
    });
  
    // Submit form data via Asynchronous JavaScript And XML (AJAX) request 
    $('form.markasread_form').submit(function() {
      var formData = new FormData($(this)[0]);
      $.ajax({
        type: 'POST',
        async: true,
        data:  formData,
        url: formData.get('url'),
        contentType: false,
        processData: false,
        // Pass form element ($) as 'this' context to handlers
        context: $(this).eq(0),
        complete: function(jqXHR, textStatus) { },
        success: function(result){
          if (result.data.read === true) {
            this.replaceClass('unread', 'read');
            this.find('> button span').replaceClass('icon-eye-open', 'icon-eye-close');
            this.find('input:hidden[name=task]').val('unread');
          } else {
            this.replaceClass('read', 'unread');
            this.find('> button span').replaceClass('icon-eye-close', 'icon-eye-open');
            this.find('input:hidden[name=task]').val('read');
          }
        },
        error: function(result){
          console.error(result);
        }
      });
  
      return false;
    });
  }(jQuery));

});
