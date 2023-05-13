<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css">
    <link rel="shortcut icon" href="#" type="image/x-icon">
    <title>Document</title>
</head>

<body>
    <div class="mt-2 ml-2">
        <h2 class="h3">Ajouter un Produit</h2>

        <form id="form_produits" method="post" enctype="multipart/form-data" class="col-4">
            <div id="produits">
                <div class="produit" class="form-group mb-3">
                    <label for="nom_produit_1">Nom du produit :</label>
                    <input type="text" name="nom_produit[]" id="nom_produit_1" class="form-control">

                    <label for="image_produit_1">Image du produit :</label>
                    <input type="file" name="image_produit[]" id="image_produit_1" class="form-control">
                </div>
                <hr>
            </div>

            <button type="button" id="ajouter_produit" class="btn btn-primary mt-4">Ajouter un produit</button>
            <button type="submit" id="enregistrer_produits" class="btn btn-primary mt-4">Enregistrer</button>
        </form>

    </div>
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        $(function() {
            $('#ajouter_produit').on('click', function() {
                const div = $(`
                <div class="produit" class="form-group mb-3">
                    <label>Nom du produit :</label>
                    <input type="text" name="nom_produit[]" class="form-control">

                    <label>Image du produit :</label>
                    <input type="file" name="image_produit[]" class="form-control">
                    <br>
                    <button title="Supprimer" type="button" class="btn offset-11 delete" style="color:red"><i class="fas fa-trash"></i></button>
                    <hr>
                </div>
            `);
                $('#produits').append(div);
            });

            $('#produits').on('click', ".delete", function() {
                $(this).parent().remove();
            });

            $("#enregistrer_produits").on("click", function(e) {
                e.preventDefault();
                var formData = new FormData($("#form_produits")[0]);
                $.ajax({
                    url: "upload.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log("Les produits ont été enregistrés avec succès !");
                    },
                    error: function(xhr, status, error) {
                        console.log("Erreur : " + error);
                    }
                });
            });


        });
    </script>
</body>

</html>