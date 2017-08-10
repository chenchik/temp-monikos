//created by Joseph Son

var customerId;


$.post("../../../../db/create-customer.php", {
    first: getCookie("username")
}, function (data, status) {
    customerId = data;
    console.log("customerId: " + customerId);
    checkSubscription(data);
});

function checkSubscription(id) {
    console.log(id);
    $.post("../../../../db/check_subscription.php", {
        customerId: id
    }, function (data, status) {
        console.log(data);
    });
}



function logout() {
    $.get("../../../../db/logout.php", function (data, status) {
        console.log(data);
    });

    window.location = window.location.origin = "/mvc/public/account/landing";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

var config = {
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
    }
};

var charge;
var plan;
var button;
var purchase;

function subscription(subscriptionId) {
    var css = document.createElement("style");
    css.type = "text/css"
    css.innerHTML =
        "#pop_up {webkit-transform: scale(1); -moz-transform: scale(1); -ms-transform: scale(1); transform: scale(1); opacity: 1; }";
    document.body.appendChild(css);
    document.getElementById('modal_wrapper').style.visibility = "visible";

    $.post("../../../../db/create-token.php", {
        customerId: customerId
    }, function (data, status) {
        console.log("client token: " + data);
        createDropIn(data);
    })

    plan = subscriptionId;
    console.log(plan);
    button = document.querySelector('#choose');
    purchase = document.querySelector('#purchase');
}

function cancel() {
    $.post('../../../../db/cancel_subscription.php', {
        'customerId': customerId
    }, function (data, status) {
        console.log(data);
    });
    location.reload;
}

function hidePopup() {
    var css = document.createElement("style");
    css.type = "text/css"
    css.innerHTML =
        "#pop_up{ -webkit-transform: scale(0.7); -moz-transform: scale(0.7);-ms-transform: scale(0.7);transform: scale(0.7);opacity: 0;-webkit-transition: all 0.3s;-moz-transition: all 0.3s;transition: all 0.3s;}";
    document.body.appendChild(css);
    document.getElementById('modal_wrapper').style.visibility = "hidden";
}

function createDropIn(token) {
    /*-------------------------CREDIT CARDS AND PAYPAL-------------------------*/
    braintree.dropin.create({
        authorization: token,
        container: '#dropin-container',
        paypal: {
            flow: 'vault',
            env: 'sandbox'
        }
    }, function (createErr, instance) {
        //this will be true if there is already a payment method available
        if (instance.isPaymentMethodRequestable()) {
            instance.requestPaymentMethod(function (err, payload) {
                console.log(err);
                $('#choose').hide();
                $('#purchase').show();
                purchase.addEventListener('click', function () {
                        transaction(payload.nonce);
                });
            });
        } else {
            button.addEventListener('click', function () {
                instance.requestPaymentMethod(function (err, payload) {
                    console.log(err);
                        $('#choose').hide();
                        $('#purchase').show();
                        purchase.addEventListener('click', function () {
                            transaction(payload.nonce);
                        })
                });
            });
        }
    });
}

function transaction(nonce) {
    $.post("../../../../db/create-subscription.php", {
            customerId: customerId,
            nonce: nonce,
            plan: plan
        },
        function (data, status) {
            $.post("../../../../db/change_premium.php", {
                'user': getCookie('username')
            }, function (data, status) {
                if (data == 1) {
                    window.location = window.location.origin + "/mvc/public/home";
                    console.log(data);
                }
            });
            console.log(data);
        });
}


/*-------------------------PAYPAL-------------------------*/
/*
braintree.client.create({
    authorization: token
}, function (clientErr, clientInstance) {
    if (clientErr) {
        console.error('Error creating client:', clientErr);
        return;
    }

    //collecting device data is essential for non-recurring transactions from Vault records
    braintree.dataCollector.create({
        client: clientInstance,
        paypal: true
    }, function (err, dataCollectorInstance) {
        if (err) {
            // Handle error
            return;
        }
        // At this point, you should access the dataCollectorInstance.deviceData value and provide it
        // to your server, e.g. by injecting it into your form as a hidden input.
        myDeviceData = dataCollectorInstance.deviceData;
    });

    // Create a PayPal Checkout component.
    braintree.paypalCheckout.create({
        client: clientInstance
    }, function (paypalCheckoutErr, paypalCheckoutInstance) {


        // Stop if there was a problem creating PayPal Checkout.
        // This could happen if there was a network error or if it's incorrectly
        // configured.
        if (paypalCheckoutErr) {
            console.error('Error creating PayPal Checkout:', paypalCheckoutErr);
            return;
        }

        // Set up PayPal with the checkout.js library
        paypal.Button.render({

            env: 'sandbox', // or 'production'

            payment: function () {
                return paypalCheckoutInstance.createPayment({
                    flow: 'vault',
                    billingAgreementDescription: 'Your agreement description',
                    enableShippingAddress: true,
                    shippingAddressEditable: true,
                    amount: charge,
                    currency: 'USD'

                    
                    shippingAddressOverride: {
                        recipientName: 'Scruff McGruff',
                        line1: '1234 Main St.',
                        line2: 'Unit 1',
                        city: 'Chicago',
                        countryCode: 'US',
                        postalCode: '60652',
                        state: 'IL',
                        phone: '123.456.7890'
                    }
                    
    
                });
            },


            onAuthorize: function (data, actions) {
                return paypalCheckoutInstance.tokenizePayment(data)
                    .then(function (payload) {
                        console.log(payload);
                        $.post("../../../../db/create-subscription.php", {
                            customerId: customerId,
                            plan: plan,
                            nonce: payload.nonce,
                            type: payload.type,
                            payerId: payload.details.payerId,
                            address: payload.details.shippingAddress
                        }, function (data, status) {
                            console.log(data);
                            makeUserPremium();
                        });
                    });
            },

            
            onCancel: function(data) {
                console.log('checkout.js payment cancelled', JSON.stringify(data, 0, 2));
            },

            onError: function(err) {
                console.error('checkout.js error', err);
            }
            
                
        }, '#paypal-button').then(function () {
            // The PayPal button will be rendered in an html element with the id
            // `paypal-button`. This function will be called when the PayPal button
            // is set up and ready to be used.
        });


    });


});
*/
