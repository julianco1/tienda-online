<!DOCTYPE html>
<tml lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <script src="https://www.paypal.com/sdk/js?client-id=ASNhNk7HHYfgXaiknC_sKu1z1sAHvxnr8kf0LK6VEoWtadVc806XNWKFcmejF7Ar7F2JBgN66KcoZqqe"></script>
</head>
<body>
    <div id="paypal-button-container"></div>
    <script>
        paypal.Buttons({
            style:{
                color:'blue',
                shape: 'pill',
                label:'pay'
            },
            createOrder: function(data,actions)
            {
                 return actions.order.create({
                  purchase_units:[{
                      amount:{
                          value:10000
                      }
                  }]
                 });
            },
            onCancel:function(data)
            {
                alert("pago cancelado");
                console.log(data)
            }
        }).render('#paypal-button-container');
        </script>

</body>
</html>