<!DOCTYPE html>
<html>
<head>
<title>Resvice</title>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}
:root {
    --background-page: #111020;
    --tran: .3s;
}
body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-color: var(--background-page);
}
.loading-cont {
    position: relative;
    width: 180px;
    height: 180px;
    border-radius: 50%;
    overflow: hidden;
}
.cont {
    width: 100%;
    height: 100%;
    animation-name: rotate;
    animation-duration: 3s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
}
.loading-cont::before {
    content: 'Run Service...';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 90%;
    height: 90%;
    border-radius: 50%;
    color: yellowgreen;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
    text-transform: uppercase;
    text-shadow: 0 0 5px yellowgreen,
        0 0 10px yellowgreen,
        0 0 20px yellowgreen,
        0 0 30px yellowgreen,
        0 0 50px yellowgreen;
    z-index: 111;
    background-color: var(--background-page);
}
.loading-cont .cont span {
    position: absolute;
    width: 50%;
    height: 50%;
    background-color: yellowgreen;
}
.loading-cont .cont span:first-child {
    top: 0;
    left: 0;
    transform-origin: top left;
    animation-name: loading;
    animation-duration: 1.5s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
}
.loading-cont .cont span:nth-child(2) {
    bottom: 0;
    right: 0;
    transform-origin: bottom right;
    animation-name: loading;
    animation-duration: 1.5s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;    
}
@keyframes loading {
    0% {
        transform: scale(.3);
    }
    50% {
        transform: scale(1.5);
    }
    100% {
        transform: scale(.3);
    }
}
@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
</head>
<body>
    <div class="loading-cont">
        <div class="cont">
            <span></span>
            <span></span>
        </div>
    </div>
<script>
    setTimeout(function() {
        location.reload();
    }, 40000); // Refresh halaman setelah 50000 milidetik (50 detik)
</script>
</body>
</html>


