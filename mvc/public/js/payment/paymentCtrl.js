//created by Joseph Son

var customerId;


$.post("../../../../db/create-customer.php", {
    first: getCookie("username")
}, function (data, status) {
    customerId = data;
    console.log("customerId: " + customerId);
    checkSubscription(data);
});

function checkSubscription(id){
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

    window.location = window.location.origin = "/mvc/public/landing.html";
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

function subscription(subscriptionId) {
    var css = document.createElement("style");
    css.type = "text/css"
    css.innerHTML =
        "#pop_up {webkit-transform: scale(1); -moz-transform: scale(1); -ms-transform: scale(1); transform: scale(1); opacity: 1; }";
    document.body.appendChild(css);
    document.getElementById('modal_wrapper').style.visibility = "visible";

    button = document.querySelector('#pay');
    $.post("../../../../db/create-token.php", {
        customerId: customerId
    }, function (data, status) {
        console.log("client token: " + data);
        createDropIn(data);
    })

    plan = subscriptionId;
    console.log(plan);
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
    /*-------------------------CREDIT CARDS-------------------------*/
    braintree.dropin.create({
        authorization: token,
        container: '#dropin-container'
    }, function (createErr, instance) {
        //drop-in
        button.addEventListener('click', function () {
            instance.requestPaymentMethod(function (err, payload) {
                console.log(err);
                //this will create the customer and transaction with specific plan
                $.post("../../../../db/create-subscription.php", {
                        customerId: customerId,
                        nonce: payload.nonce,
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
            });
        });
    });

    /*-------------------------PAYPAL-------------------------*/
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

                        /*
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
                        */
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

                /*
                onCancel: function(data) {
                    console.log('checkout.js payment cancelled', JSON.stringify(data, 0, 2));
                },

                onError: function(err) {
                    console.error('checkout.js error', err);
                }
                */
            }, '#paypal-button').then(function () {
                // The PayPal button will be rendered in an html element with the id
                // `paypal-button`. This function will be called when the PayPal button
                // is set up and ready to be used.
            });


        });


    });
}


/*
app.controller('homeCtrl', function ($scope, $http) {
    /*
    var url = "/db/get_drugs.php";
    $http.get(url)
        .then(function (response) {
            console.log(response);
            $scope.names = response.data.records;
            console.log($scope.names);
        });
    */
/*
    $scope.getNotifications = function () {

        var url = "/db/get_notifications.php";

        var username = getCookie('username');

        var data = $.param({
            user: username
        });

        $http.post(url, data, config)
            .then(function (response) {
                console.log(response);

                $('#notificationIndicator').html(response.data.records.length);
                //if theres no challenges dont show anything
                if (!response.data.records.length) {
                    $('#notificationIndicator').css({
                        'display': 'none'
                    });
                } else {
                    $('#noNotificationsText').css({
                        'display': 'none'
                    });
                    $('#notificationsBlock').css({
                        'display': 'block'
                    });
                    for (var notif in response.data.records) {
                        var _url = response.data.records[notif]['url'];
                        var elemm = document.createElement('p');
                        elemm.innerHTML = 'challenge:' + response.data.records[
                                notif]['challengegame'] + ', bet:' + response.data.records[
                                notif]['bet'] + ', who:' + response.data.records[notif]
              ['user1'];
                        elemm.className = 'notificationText';
                        elemm.onclick = function () {
                            window.location = _url
                        };
                        document.getElementById("notificationsBlock").appendChild(
                            elemm);
                    }
                }
            });

    }
    $scope.getNotifications();

    $scope.premiumCheck = function () {
        var username = getCookie('username');
        var url = "/db/get_profile_by_user.php";
        var data = $.param({
            un: username
        });
        $http.post(url, data, config)
            .then(function (response) {
                console.log(response);
                var premium = response.data.records[0]["premium"];
                if (!premium) {
                    $scope.img = "/mvc/public/images/socialgrey.png";
                    $("#social").css('border', '2px solid #777777');
                    $("#social").css('transition', '');
                    $("#social").css('color', '#777777');
                } else {
                    $scope.img = "/mvc/public/images/social.png";
                }
            });
    }
    $scope.premiumCheck();
    $scope.getImg = function () {
        return $scope.img;
    }

    $scope.gobackhome = function () {
        //create new database controller
        window.location = window.location.origin +
            "/mvc/public/home";
    }

    $scope.drugDatabase = function () {
        //create new database controller
        window.location = window.location.origin +
            "/mvc/public/home/drugDatabase";
    }

    $scope.listManager = function () {
        //create list manager controller
        window.location = window.location.origin +
            "/mvc/public/home/listManager";
    }


    $scope.social = function () {
        var username = getCookie('username');
        var url = "/db/get_profile_by_user.php";
        var data = $.param({
            un: username
        });
        $http.post(url, data, config)
            .then(function (response) {
                console.log(response);
                var premium = response.data.records[0]["premium"];
                if (premium) {
                    window.location = window.location.origin +
                        "/mvc/public/home/social";
                } else if (!premium) {
                    window.location = window.location.origin +
                        "/mvc/public/payment";
                }
            });



    }

    $scope.getUser = function () {
        // var username = getCookie('username');
        // var url = "/db/get_profile_by_user.php";
        // var data = $.param({
        //     un: username
        // });
        // $http.post(url, data, config)
        //     .then(function (response) {
        //         console.log(response);
        //         response.data.records[0]["premium"];
        //     });
    }
});
*/
