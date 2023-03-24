<!DOCTYPE html>
<html>
<body>

<h1>Laboratorijska vježba 2 - Damir Bašić</h1>

<button id="zad1" class="float-left submit-button" >Zadatak 1</button>
<button id="zad2" class="float-left submit-button" >Zadatak 2</button>
<button id="zad3" class="float-left submit-button" >Zadatak 3</button>


<script type="text/javascript">
    document.getElementById("zad1").onclick = function () {
        location.href = "lv2_1.php";
    };
    document.getElementById("zad2").onclick = function () {
        location.href = "lv2_2.php";
    };
    document.getElementById("zad3").onclick = function () {
        location.href = "lv2_3.php";
    };
</script>

</body>
</html>
