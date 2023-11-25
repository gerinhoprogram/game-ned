const score = document.querySelector('.score');
const highScore = document.querySelector('.highScore');
const startScreen = document.querySelector('.startScreen');
const startScreen2 = document.querySelector('.startScreen2');
const gameArea = document.querySelector('.gameArea');
const ClickToStart = document.querySelector('.ClickToStart');
// const grass = document.querySelector('.grass');  
// const garden = document.querySelector('.garden');  
ClickToStart.addEventListener('click', Start);
document.addEventListener('keydown', keydown);
document.addEventListener('keyup', keyup);
let keys = {
    ArrowUp: false,
    ArrowDown: false,
    ArrowLeft: false,
    ArrowRight: false,
}
let player = {
    speed: 5,
    score: 0,
    highScore: 0
};

function keydown(e) {
    keys[e.key] = true
}

function keyup(e) {
    keys[e.key] = false;
}
// starting the game  
function Start() {
    gameArea.innerHTML = "";
    startScreen.classList.add('hide');
    startScreen2.classList.add('hide');
    player.isStart = true;
    player.score = 0;
    window.requestAnimationFrame(Play);
    // creating the road lines  
    for (i = 0; i < 9; i++) {
        let roadLines = document.createElement('div');
        roadLines.setAttribute('class', 'roadLines');
        roadLines.y = (i * 140);
        roadLines.style.top = roadLines.y + "px";
        gameArea.appendChild(roadLines);
    }

    // creating the opponents car  
    for (i = 0; i < 3; i++) {
        let Opponents = document.createElement('div');
        if (i === 0) {
            Opponents.setAttribute('class', 'Opponent2');
        } else if (i === 1) {
            Opponents.setAttribute('class', 'Opponent4');
        } else {
            Opponents.setAttribute('class', 'Opponents');
        }

        Opponents.y = ((i) * -300);
        Opponents.style.top = Opponents.y + "px";
        gameArea.appendChild(Opponents);
        Opponents.style.left = Math.floor(Math.random() * 350) + "px";
        // Opponents.style.backgroundColor = randomColor();
    }

    let car = document.createElement('div');
    car.setAttribute('class', 'car');
    gameArea.appendChild(car);
    player.x = car.offsetLeft;
    player.y = car.offsetTop;


}

// function randomColor() {
//     function c() {
//         let hex = Math.floor(Math.random() * 256).toString(16);
//         return ("0" + String(hex)).substr(-2);
//     }
//     return "#" + c() + c() + c();
// }
//play the game  
function Play() {
    let car = document.querySelector('.car');
    let road = gameArea.getBoundingClientRect();
    if (player.isStart) {
        moveLines();
        moveOpponents(car);
        moveOpponents2(car);
        moveOpponents4(car);
        if (keys.ArrowUp && player.y > (road.top + 70)) { player.y -= player.speed }
        if (keys.ArrowDown && player.y < (road.height - 75)) { player.y += player.speed }
        if (keys.ArrowDown && player.y > 0) { player.y -= player.speed }
        if (keys.ArrowDown && player.y < 950) { player.y += player.speed }

        if (keys.ArrowRight && player.x < 350) { player.x += player.speed }
        if (keys.ArrowLeft && player.x > 0) { player.x -= player.speed }
        car.style.top = player.y + "px";
        car.style.left = player.x + "px";
        highScore.innerHTML = "HighScore" + ":" + (player.highScore - 1);
        player.score++;
        player.speed += 0.01;
        if (player.highScore < player.score) {
            player.highScore++;
            highScore.innerHTML = "HighScore" + ":" + (player.highScore - 1);
            highScore.style.top = "80px";
        }
        score.innerHTML = (player.score - 1);
        window.requestAnimationFrame(Play);
    }
}

function moveLines() {
    let roadLines = document.querySelectorAll('.roadLines');
    roadLines.forEach(function(item) {
        if (item.y >= 1000)
            item.y -= 1300;
        item.y += player.speed;
        item.style.top = item.y + "px";
    })
}


function moveOpponents(car) {
    let Opponents = document.querySelectorAll('.Opponents');
    Opponents.forEach(function(item) {
        if (isCollide(car, item)) {
            endGame();
        }
        if (item.y >= 1100) {
            item.y -= 1300;
            item.style.left = Math.floor(Math.random() * 350) + "px";
        }
        item.y += player.speed;
        item.style.top = item.y + "px";
    })
}

function moveOpponents2(car) {
    let Opponents = document.querySelectorAll('.Opponent2');
    Opponents.forEach(function(item) {
        if (isCollide(car, item)) {
            endGame();
        }
        if (item.y >= 1100) {
            item.y -= 1100;
            item.style.left = Math.floor(Math.random() * 350) + "px";
        }
        item.y += player.speed;
        item.style.top = item.y + "px";
    })
}


function moveOpponents4(car) {
    let Opponents = document.querySelectorAll('.Opponent4');
    Opponents.forEach(function(item) {
        if (isCollide(car, item)) {
            endGame();
        }
        if (item.y >= 1100) {
            item.y -= 1100;
            item.style.left = Math.floor(Math.random() * 350) + "px";
        }
        item.y += player.speed;
        item.style.top = item.y + "px";
    })
}

//check whether the cars collide or not  
function isCollide(a, b) {
    aRect = a.getBoundingClientRect();
    bRect = b.getBoundingClientRect();
    return !((aRect.top > bRect.bottom) || (aRect.bottom < bRect.top) || (aRect.right < bRect.left) || (aRect.left > bRect.right))
}
//game is end  
function endGame() {
    player.isStart = false;
    player.speed = 5;
    // startScreen.classList.remove('hide');
    startScreen2.classList.remove('hide');

    var produtosIntTitulo = document.getElementsByClassName("score");
    var orcamentoAssuntoForm = document.getElementById("campo_score");
    orcamentoAssuntoForm.value = produtosIntTitulo[0].innerText;


}