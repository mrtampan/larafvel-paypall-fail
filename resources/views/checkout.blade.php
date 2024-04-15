<!doctype html>
<html>

<head>
    <link ref="stylesheet" href="https://assets.edlin.app/bootstrap/v5.2/bootstrap.css" />
    <script src="https://www.paypal.com/sdk/js?client-id={{config('paypal.client_id')}}"></script>
</head>


<body>
    <div class="container text-center">
        <div id="paypal_success" style="display:none;">thank you</div>
        <div>
            <input type="text" id="paypal_amount" />
        </div>
    </div>
    <div id="payment_options"></div>
</body>

<script>
    paypal.Buttons({
        createOrder: function() {
            return fetch("/create/" + document.getElementById("paypal_amount").value).then((response) => response.text()).then((id) => {
                return id;
            });
        },

        onApprove: function() {
            return fetch("/complete", {
                method: "post",
                headers: {
                    "X-CSRF-Token": '{{csrf_token()}}'
                }
            }).then((response) => response.json()).then((order_details) => {
                document.getElementById('paypal_success').style.display = 'block';
            });
        },

        onCancel: function(data) {
            console.log(data);
        },

        onError: function(err) {
            console.log(err);
        }
    }).render('#payment_options');
</script>

</html>