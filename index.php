<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejegyzéskezelő</title>
    <style>
        body {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            margin: 20px;
            padding: 20px;
            max-width: 600px;
            background-color: #fbd5ed;
        }
        form {
            background: white;
            padding: 50px;
            border-radius: 10px;
            box-shadow: rgb(223, 94, 195);
        }
        input, textarea {
            width: 100%;
            margin: 40px 0;
            padding: 8px;
        }
        button {
            padding: 10px;
            background: rgb(0, 0, 0);
            color: white;
            border: none;
            cursor: pointer;
        }
        .bejegyzes {
            background: white;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px gray;
        }
        .tartalom {
            max-height: 50px;
            overflow: hidden;
            position: relative;
        }
        .mutasd-tobbet {
            color: deeppink;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h2>Új bejegyzés létrehozása</h2>
    <form id="bejegyzes-form">
        <input type="text" id="nev" placeholder="Felhasználónév" maxlength="30" required>
        <input type="text" id="cim" placeholder="Bejegyzés címe" maxlength="200" required>
        <textarea id="tartalom" placeholder="Bejegyzés tartalma" required></textarea>
        <button type="submit">Beküldés</button>
    </form>

    <h2>Bejegyzések</h2>
    <div id="bejegyzesek"></div>

    <script>
        document.getElementById("bejegyzes-form").addEventListener("submit", async function(e) {
            e.preventDefault();
           
            let nev = document.getElementById("nev").value;
            let cim = document.getElementById("cim").value;
            let tartalom = document.getElementById("tartalom").value;

            let response = await fetch("insert.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ nev, cim, tartalom })
            });

            let result = await response.json();
            alert(result.message || result.error);

            document.getElementById("bejegyzes-form").reset();
            megjelenitBejegyzesek();
        });

        async function megjelenitBejegyzesek() {
            let response = await fetch("fetch.php");
            let bejegyzesek = await response.json();
            let container = document.getElementById("bejegyzesek");
            container.innerHTML = "";

            bejegyzesek.forEach(b => {
                let div = document.createElement("div");
                div.classList.add("bejegyzes");
                div.innerHTML = `
                    <strong>${b.cim}</strong> <br>
                    <small>${b.nev} - ${b.datum}</small>
                    <p class="tartalom">${b.tartalom.length > 100 ? b.tartalom.substring(0, 100) + '...' : b.tartalom}</p>
                    ${b.tartalom.length > 100 ? '<span class="mutasd-tobbet" onclick="mutasdTobbet(this, \'' + b.tartalom + '\')">Több mutatása</span>' : ''}
                `;
                container.appendChild(div);
            });
        }

        function mutasdTobbet(elem, teljesTartalom) {
            elem.previousElementSibling.innerHTML = teljesTartalom;
            elem.remove();
        }

        megjelenitBejegyzesek();
    </script>

</body>
</html>