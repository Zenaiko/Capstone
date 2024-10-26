<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search by Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .recipe-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: 0.3s ease-in-out;
        }
        .recipe-card:hover {
            transform: scale(1.03);
        }
        .card-body {
            padding: 1.5rem;
        }
        .recipe-image {
            width: 100%;
            height: 200px; 
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }
        .btn-more-info {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h4 class="text-center mb-4">Search by Recipe</h4>
        <div class="input-group mb-4">
            <input type="text" id="recipeSearchInput" class="form-control" placeholder="Search for a recipe...">
            <button class="btn btn-primary" onclick="searchRecipe()">Search</button>
        </div>

        <div class="recipe-card card mb-4">
            <img src="torta.jpeg" alt="Recipe Placeholder" class="recipe-image">
            <div class="card-body">
                <h5 class="card-title">Tortang Talong</h5>
                <p class="card-text">A delicious Filipino eggplant omelette.</p>
                <a href="recipe-detail.html?recipe=tortang-talong" class="btn btn-primary btn-more-info">More Info</a>
            </div>
        </div>
    </div>

    <script>
        function searchRecipe() {
            const searchQuery = document.getElementById("recipeSearchInput").value.toLowerCase();
            console.log("Search for:", searchQuery);
            // Future feature: Fetch and display recipe cards based on search.
        }
    </script>
</body>
</html>
