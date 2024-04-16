<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .slider {
            margin-top: 70px;
            width: 1300px;
            max-width: 100vw;
            height: 650px;
            margin-top: 70px;
            margin-left: auto;
            margin-right: auto;
            position: relative;
            overflow: hidden;
        }
        .slider .list {
            position: absolute;
            width: max-content;
            height: 100%;
            left: 0;
            top: 0;
            display: flex;
            transition: 1s;
        }
        .slider .list img {
            position: relative;
            width: 1300px;
            max-width: 100vw;
            height: 100%;
            object-fit: cover;
        }
        .slider .list p {
            position: absolute;
            left: 50%;
            top: 20%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 24px;
            font-weight: bold;
        }
        .slider .buttons {
            position: absolute;
            top: 45%;
            left: 5%;
            width: 90%;
            display: flex;
            justify-content: space-between;
        }
        .slider .buttons button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #fff5;
            color: #fff;
            border: none;
            font-family: monospace;
            font-weight: bold;
        }
        .slider .dots {
            position: absolute;
            bottom: 10px;
            left: 0;
            color: #fff;
            width: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }
        .slider .dots li {
            list-style: none;
            width: 10px;
            height: 10px;
            background-color: #fff;
            margin: 10px;
            border-radius: 20px;
            transition: 0.5s;
        }
        .slider .dots li.active {
            width: 30px;
        }
        @media screen and (max-width: 768px) {
            .slider {
                height: 400px;
            }
        }
    </style>
</head>
<body>
    <div class="slider">
        <div class="list">
            <div class="item">
                <img src="img/exhibitions/1.jpg" alt="">
                <p>Text for Image 1</p>
            </div>
            <div class="item">
                <img src="img/exhibitions/2.jpg" alt="">
            </div>
            <div class="item">
                <img src="img/exhibitions/3.jpg" alt="">
                <p>Text for Image 3</p>
            </div>
            <div class="item">
                <img src="img/exhibitions/4.jpg" alt="">
            </div>
            <div class="item">
                <img src="img/exhibitions/5.jpg" alt="">
                <p>Text for Image 5</p>
            </div>
        </div>
        <div class="buttons">
            <button id="prev"><</button>
            <button id="next">></button>
        </div>
        <ul class="dots">
            <li class="active"></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</body>


    <script>
        let slider = document.querySelector('.slider .list');
        let items = document.querySelectorAll('.slider .list .item');
        let next = document.getElementById('next');
        let prev = document.getElementById('prev');
        let dots = document.querySelectorAll('.slider .dots li');

        let lengthItems = items.length - 1;
        let active = 0;
        next.onclick = function(){
            active = active + 1 <= lengthItems ? active + 1 : 0;
            reloadSlider();
        }
        prev.onclick = function(){
            active = active - 1 >= 0 ? active - 1 : lengthItems;
            reloadSlider();
        }
        let refreshInterval = setInterval(()=> {next.click()}, 15000);
        function reloadSlider(){
            slider.style.left = -items[active].offsetLeft + 'px';
            // 
            let last_active_dot = document.querySelector('.slider .dots li.active');
            last_active_dot.classList.remove('active');
            dots[active].classList.add('active');

            clearInterval(refreshInterval);
            refreshInterval = setInterval(()=> {next.click()}, 15000);

            
        }

        dots.forEach((li, key) => {
            li.addEventListener('click', ()=>{
                 active = key;
                 reloadSlider();
            })
        })
        window.onresize = function(event) {
            reloadSlider();
        };
    </script>
</body>
</html>
