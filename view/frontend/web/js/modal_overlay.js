define([
    'uiComponent',
    'jquery',
    'Magento_Ui/js/modal/modal',
    'mage/validation'
], function (Component, $, modal) {
    'use strict';

    return Component.extend({

        initialize: function () {

            this._super();
            var options = {
                type: 'popup',
                responsive: true,
                innerScroll: false,
                title: false,
                buttons: false
            };

            var modal_overlay_element = $('#modal-overlay');
            var popup = modal(options, modal_overlay_element);
            modal_overlay_element.css("display", "block");

            $("#leon_request").on('click',function(){
                modal_overlay_element.modal("openModal");
            });

            // Get the form.
            var leonForm = $('.leon-request-form');

            // Get the messages div.
            var formMessages = $('#form-messages');

            $(leonForm).submit(function (event) {
                event.preventDefault();
                leonForm.validation();
                var status = leonForm.validation('isValid');

                if (status) {
                    var formData = $(leonForm).serialize();

                    $.ajax({
                        type: 'POST',
                        url: $(leonForm).attr('action'),
                        //showLoader: true,
                        data: formData,
                        complete: function (response) {
                            if(response.responseJSON == 'ok'){
                                modal_overlay_element.modal("closeModal");
                                $('#init_element').alert({
                                    title: 'Warning',
                                    content: 'Warning content',
                                    actions: {
                                        always: function(){}
                                    }
                                });
                            }

                        },
                        error: function (xhr, status, errorThrown) {
                            console.log('Error happens. Try again.');
                        }
                    });
                }
            })
        }

    });
});