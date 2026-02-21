<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>check page</title>
    <style>
        /* Simple, responsive styling for the payment (RazorPay) details form.
           CSS-only: no HTML/JS/logic changes. */
        body {
            margin: 0;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #1f2937;
        }

        /* Override the inline padding on the outer .row to keep it responsive */
        body > .row {
            padding: 48px 16px !important;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 520px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(0, 0, 0, 0.06);
            border-radius: 14px;
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.10);
            padding: 22px;
        }

        form {
            padding: 0 !important; /* neutralize inline form padding */
        }

        h1 {
            margin: 8px 0 18px !important;
            font-size: 26px;
            letter-spacing: 0.2px;
        }

        label {
            display: block;
            margin: 12px 0 6px;
            font-weight: 600;
            font-size: 14px;
            color: #374151;
        }

        input[type="text"] {
            width: 100%;
            box-sizing: border-box;
            padding: 12px 12px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            background: #fff;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        input[type="text"]:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.18);
        }

        .btn {
            width: 100%;
            margin-top: 18px;
            padding: 12px 14px;
            border: 0;
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            filter: brightness(0.98);
        }

        @media (min-width: 768px) {
            body > .row {
                padding: 64px 24px !important;
            }
        }
    </style>
</head>
<body>
    <div class="row" style="padding:100px 300px;">
                                                  <div class="col-50">
                                                    <div class="container">
                                                        <form action="index.html" method="post" style="padding:25px;">
                                                         <div class="row">
                                                            <div class="col-25">
                                                                <h1 style="text-align:center;margin:20px 10px;font-family:lato;">Checkout Form</h1>
                                                           <label for="fname">Full name</label>
                                                           <input type="text" id="fname" name="name" placeholder="Enter name">
                                                           <label for="email">Email</label>
                                                           <input type="text" id="email" name="email" placeholder="Enter Email Id">
                                                           <label for="phone">Mobile</label>
                                                           <input type="text" id="phone" name="email" placeholder="Phone number">
                                                           <label for="address">Address</label>
                                                           <input type="text" id="adress" name="adress" placeholder="Delivery Address">

                                                        </div>
                                                        <input type="submit" class="btn" value="Pay Now">
</form>
</div>   
                                                    </div>
                                                  </div>
                                                  </div>

    
</body>
</html>