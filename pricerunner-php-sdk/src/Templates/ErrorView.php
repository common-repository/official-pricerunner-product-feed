<?php
  if (!defined('PRICRUNNER_OFFICIAL_PLUGIN_VERSION')) exit;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Webshop Product errors</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <style>
            .badge-warning {
                background-color: #f0ad4e;
            }

            .badge-danger {
                background-color: #d9534f;
            }

            .label-badge {
                line-height: 1.3;
                margin-left: 5px;
            }

            .custom-panel-body {
                border-bottom: 1px solid #ddd;
                border-right: 1px solid #ddd;
                border-left: 1px solid #ddd;
                margin-bottom: 15px;
                border-radius: 3px;
            }
        </style>

        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1>Product errors <small>You have <strong><?= count($errors) ?></strong> products containing errors or warnings.</small></h1>
            </div>

            <div>
                <div><span class="label label-danger">Products marked with red contain critial errors and will not be visible in the product feed.</span></div>
                <br>
            </div>

            <div class="list-group">
                <?php foreach($errors as $key => $productErrors):
                    $warnings = $productErrors['warnings'];
                    $warningCount = count($warnings);

                    $errors = $productErrors['errors'];
                    $errorCount = count($errors);

                    $product = $productErrors['product'];
                    $errorTypesArray = array();

                    foreach($errors as $error) {
                        $errorTypesArray[] = $error['type'];
                    }

                    foreach($warnings as $warning) {
                        $errorTypesArray[] = $warning['type'];
                    }

                    $errorTypesArray = array_unique($errorTypesArray);
                    sort($errorTypesArray);

                    ?>

                    <button type="button" class="list-group-item <?= $errorCount > 0 ? 'list-group-item-danger' : ''; ?>"
                            data-toggle="collapse" data-target="#collapse_<?= $key; ?>">

                        <a class="label label-primary label-badge pull-right"
                           href="<?= $product['productUrl']; ?>" target="_blank">View product</a>

                        <?php if($errorCount > 0): ?>
                            <span class="badge badge-danger"><?= $errorCount; ?></span>
                        <?php endif; ?>

                        <?php if($warningCount > 0): ?>
                            <span class="badge badge-warning" style=""><?= $warningCount ?></span>
                        <?php endif; ?>

                        <strong><?= '[' . $product['sku'] . '] ' . $product['productName']; ?></strong> <i>(<?= implode(', ', $errorTypesArray); ?>)</i>
                    </button>

                    <div class="collapse" id="collapse_<?= $key; ?>">
                       <div class="panel-body custom-panel-body">
                           <?php if($errorCount > 0): ?>
                               <div><strong>List of errors:</strong></div>
                               <ul>
                                   <?php foreach($errors as $error): ?>
                                       <li><?= $error['message']; ?></li>
                                   <?php endforeach; ?>
                               </ul>
                           <?php endif; ?>

                           <?php if($warningCount > 0): ?>
                               <div><strong>List of warnings:</strong></div>
                               <ul>
                                   <?php foreach($warnings as $warning): ?>
                                       <li><?= $warning['message']; ?></li>
                                   <?php endforeach; ?>
                               </ul>
                           <?php endif; ?>

                           <div><strong>Fields with errors:</strong></div>
                            <ul>
                                <?php foreach($errorTypesArray as $errorType): ?>
                                    <li><strong><?= ucfirst($errorType)?>:</strong> <?= $product[$errorType]; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>