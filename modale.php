<?php
        foreach ($result as $item) {
            if ($item['quantite'] > 0) {
                ?>
                
                <a data-bs-toggle="modal" data-bs-target="#fenetreModale-<?= $item['id'] ?>" class="col mb-3">
                    <div class="card" style="width: 13rem;">
                        <img src="imagesPetites.php?image=<?= $item['urlimage'] ?>" class="card-img-top" alt="<?= $item['titre'] ?>">
                        <div class="card-body bg-primary">
                            <h5><?= $item['titre'] ?> <br> <?= $item['prix'] ?> € </h5>
                            <p> Qte : <?= $item['quantite'] ?> </p>
                            <form method="post" action="ajoutPanier.php">
                                <input type="hidden" name="id_article" value="<?= $item['id'] ?>">
                                <input type="hidden" name="qt_article" value="<?= $item['quantite'] ?>">
                                <button type="submit" class="btn btn-secondary">Ajouter au panier</button>
                            </form>
                        </div>
                    </div>
                </a>

                <div class="modal fade" id="fenetreModale-<?= $item['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content shadow-lg">
                            <div class="modal-header" style="background-color: #007bff; color: white;">
                                <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $item['titre'] ?></h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-flex">
                                <div class="text-center me-3"> 
                                    <img src="imagesGrde.php?image=<?= $item['urlimage'] ?>" alt="<?= $item['titre'] ?>" class="img-fluid mb-3" style="max-height: 300px;">
                                </div>
                                <div>
                                    <p><strong>Description:</strong> <?= $item['description'] ?></p>
                                    <p class="mt-3"><strong>Prix:</strong> <?= $item['prix'] ?> €</p>
                                    <p><strong>Quantité disponible:</strong> <?= $item['quantite'] ?></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form method="post" action="ajoutPanier.php">
                                    <input type="hidden" name="id_article" value="<?= $item['id'] ?>">
                                    <input type="hidden" name="qt_article" value="<?= $item['quantite'] ?>">
                                    <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                                </form>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>

        <?php }}