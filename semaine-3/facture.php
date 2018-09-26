<?php
$catalogue = [
  "aaa" => [ "desc" => "Produit A", "prixUnitaire" => 100.45 ],
  "abb" => [ "desc" => "Produit B", "prixUnitaire" => 2.56 ],
  "zzx" => [ "desc" => "Produit Z", "prixUnitaire" => 45.67 ],
];

$commande = [
  [ "sku" => "aaa", "qte" => 2 ],
  [ "sku" => "abb", "qte" => 10 ],
];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Devoir semaine 3 - Facture</title>
  </head>
  <body>
    <table>
      <thead>
        <tr>
          <th>Description</th>
          <th>Quantitée</th>
          <th align="right">Prix</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $sousTotal = 0.0;
        ?>
        <?php foreach($commande as $item): ?>
          <?php
            $produit = $catalogue[$item["sku"]];
            $prix = $item["qte"] * $produit["prixUnitaire"];
            $sousTotal += $prix;
          ?>
          <tr>
            <td><?= $produit["description"] ?></td>
            <td><?= $item["qte"] ?></td>
            <td align="right"><?= sprintf("%0.2f", $prix) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th>Sous-total</th>
          <th></th>
          <th align="right"><?= sprintf("%0.2f", $sousTotal) ?></th>
        </tr>
        <tr>
          <th>Taxes</th>
          <th></th>
          <th align="right"><?= sprintf("%0.2f", $sousTotal * 0.15) ?></th>
        </tr>
        <tr>
          <th>Total</th>
          <th></th>
          <th align="right"><?= sprintf("%0.2f", $sousTotal * 1.15) ?></th>
        </tr>
      </tfoot>
    </table>
  </body>
</html>
