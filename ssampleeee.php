<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Cards</title>
    <style>
        .container1 {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }
        .header {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }
        .box {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            max-width: 70%;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;
            text-align: center;
            width: 200px;
        }
        .card img {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #ccc;
            margin-bottom: 8px;
        }
        .card-title {
            font-size: 18px;
            margin: 8px 0;
        }
        .card-price {
            color: green;
            font-size: 16px;
        }
        .see-more {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
        .side-image {
            max-width: 25%;
            height: auto;
            align-self: flex-start;
        }
    </style>
</head>
<body>
    <div class="container1">
        <div>
            <div class="header">Pick up where you left off</div>
            <div class="box">
                <div class="card">
                    <img src="./images/CAMERA.jpg" alt="Product 1">
                    <div class="card-title">CANON CAMERA</div>
                    <div class="card-price">₹35000.00</div>
                </div>
                <div class="card">
                    <img src="./images/phone2.png" alt="Product 2">
                    <div class="card-title">Samsung Galaxy S24</div>
                    <div class="card-price">₹129999.00</div>
                </div>
                <div class="card">
                    <img src="./images/LAPTOP2.jpg" alt="Product 3">
                    <div class="card-title">HP Pavilion</div>
                    <div class="card-price">₹68990.00</div>
                </div>
                <div class="card">
                    <img src="./images/TV3.jpg" alt="Product 4">
                    <div class="card-title">Samsung 80 cm</div>
                    <div class="card-price">₹2999.00</div>
                </div>
            </div>
            <a href="#" class="see-more">See more</a> 
        </div>
        <img src="./images/TV3.jpg" alt="Product 4" class="side-image">
    </div>
</body>
</html>
