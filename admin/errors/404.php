<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>404 | Page Not Found</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,#020617,#0f172a,#020617);
    font-family:'Segoe UI', Tahoma, sans-serif;
    color:#fff;
    overflow:hidden;
}

/* floating glow */
.bg-circle{
    position:absolute;
    width:300px;
    height:300px;
    background:#ef4444;
    border-radius:50%;
    filter:blur(120px);
    opacity:.25;
    animation: float 6s infinite alternate;
}

.bg-circle.two{
    background:#38bdf8;
    width:350px;
    height:350px;
    animation-delay:2s;
}

@keyframes float{
    from{ transform:translateY(0); }
    to{ transform:translateY(-40px); }
}

/* main box */
.box{
    position:relative;
    z-index:2;
    background:rgba(255,255,255,.05);
    backdrop-filter:blur(14px);
    padding:50px 60px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 25px 60px rgba(0,0,0,.6);
    animation: pop .8s ease;
}

@keyframes pop{
    from{ transform:scale(.8); opacity:0; }
    to{ transform:scale(1); opacity:1; }
}

.box h1{
    font-size:110px;
    margin:0;
    color:#ef4444;
    letter-spacing:6px;
}

.box h2{
    margin:10px 0;
    font-size:26px;
    color:#e5e7eb;
}

.box p{
    font-size:16px;
    color:#cbd5f5;
    margin-bottom:30px;
}

/* button */
.box a{
    display:inline-block;
    padding:12px 26px;
    border-radius:30px;
    text-decoration:none;
    color:#fff;
    background:linear-gradient(135deg,#ef4444,#f97316);
    font-size:14px;
    transition:.3s;
}

.box a:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 25px rgba(239,68,68,.6);
}
</style>
</head>

<body>

<div class="bg-circle"></div>
<div class="bg-circle two"></div>

<div class="box">
    <h1>404</h1>
    <h2>Page Not Found</h2>
    <p>The page you are looking for does not exist<br>
        or you do not have permission to access it.</p>
    <a href="javascript:history.back()">← go back previous page</a>
</div>

</body>
</html>
