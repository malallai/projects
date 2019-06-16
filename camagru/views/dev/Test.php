<style>
    #snackbar {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #2b2b2b;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
    }

    #snackbar.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s;
        animation: fadein 0.5s;
    }

    #snackbar.hide {
        visibility: visible;
        -webkit-animation: fadeout 0.5s;
        animation: fadeout 0.5s;
    }

    @-webkit-keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
    }

    @keyframes fadein {
        from {bottom: 0; opacity: 0;}
        to {bottom: 30px; opacity: 1;}
    }

    @-webkit-keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
    }

    @keyframes fadeout {
        from {bottom: 30px; opacity: 1;}
        to {bottom: 0; opacity: 0;}
    }
</style>

<div id="test">Test</div>
<div id="snackbar">Error</div>

<script>
    let tmp;
    document.getElementById("test").onclick = async function() {
        if (document.getElementById("snackbar").className !== "show"
            && document.getElementById("snackbar").className !== "hide") {
            document.getElementById("snackbar").className = "show";
            await sleep(5000);
            document.getElementById("snackbar").className = document.getElementById("snackbar").className.replace("show", "hide");
            await sleep(500);
            document.getElementById("snackbar").className = document.getElementById("snackbar").className.replace("hide", "");
        }
    };

    document.getElementById("snackbar").onclick = async function() {
        if (document.getElementById("snackbar").className === "show") {
            document.getElementById("snackbar").className = document.getElementById("snackbar").className.replace("show", "hide");
            await sleep(500);
            document.getElementById("snackbar").className = document.getElementById("snackbar").className.replace("hide", "");
        }
    };

    function sleep(ms) {
        if (tmp)
            clearTimeout(tmp);
        return new Promise(resolve => (tmp = setTimeout(resolve, ms)));
    }
</script>