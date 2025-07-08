 <!DOCTYPE html>
<html>
<head>
    <title>Live Employee Search</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f5f5f5; }

          .search-bar-wrapper, h2{
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .search-bar {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .search-bar input[type="text"] {
        padding: 8px;
        width: 300px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .search-bar button {
        padding: 8px 16px;
        border: none;
        background-color: #6c757d;
        color: white;
        border-radius: 4px;
        cursor: pointer;
    }

    .search-bar button a {
        color: white;
        text-decoration: none;
    }

    #searchInput {
    padding: 10px 15px;
    width: 320px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
    outline: none;
    transition: 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#searchInput:focus {
    border-color: #007BFF;
    box-shadow: 0 0 8px rgba(0,123,255,0.2);
}


        input[type="text"] {
            padding: 8px;
            width: 300px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        button {
            padding: 8px 16px;
            border: none;
            margin-left: 10px;
            background-color: #6c757d;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        table {
            width: 100%;
            background-color: white;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th { background-color: #007BFF; color: white; }
    </style>
</head>
<body>

<h2>Live Search Employees</h2>

<div class="search-bar-wrapper">
    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search by name, email, or position">
        <button onclick="resetSearch()">Reset</button>
        <button><a href="project.php">Back to Main Page</a></button>
    </div>
</div>

<div id="result"></div>

<script>
    const searchInput = document.getElementById("searchInput");
    const resultDiv = document.getElementById("result");

    searchInput.addEventListener("keyup", function () {
        const query = searchInput.value.trim();
        if (query.length > 0) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "search.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                if (xhr.status === 200) {
                    resultDiv.innerHTML = xhr.responseText;
                }
            };
            xhr.send("query=" + encodeURIComponent(query));
        } else {
            resultDiv.innerHTML = "";
        }
    });

    function resetSearch() {
        searchInput.value = "";
        resultDiv.innerHTML = "";
        searchInput.focus();
    }

    function deleteRow(table, id_column, id_value) {
        if (confirm("Are you sure you want to delete this record?")) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "search.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                alert(xhr.responseText);
                searchInput.dispatchEvent(new Event("keyup")); // Refresh results
            };
            xhr.send(`delete=1&table=${table}&id_column=${id_column}&id=${id_value}`);
        }
    }
</script>

</body>
</html>
