<?php
require_once __DIR__.'/../config/app.php'; require_login();
$user=current_user(); $pageTitle=$pageTitle??"SI Hibah LP2M";
$nested=in_array(basename(dirname($_SERVER["SCRIPT_FILENAME"])),["proposals","users","schemes","periods"],true);
$pre=$nested?"../":"";
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?=e($pageTitle)?> - SI Hibah LP2M</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"><link href="<?=$pre?>assets/css/style.css" rel="stylesheet"></head><body>
<nav class="navbar bg-white border-bottom sticky-top"><div class="container-fluid px-4"><a class="navbar-brand fw-bold text-primary" href="<?=$pre?>dashboard.php">LP2M UM Papua</a><div class="d-flex gap-3 align-items-center"><span class="small text-muted"><?=e($user["name"])?> · <?=e($user["role"])?></span><a href="<?=$pre?>logout.php" class="btn btn-outline-danger btn-sm">Keluar</a></div></div></nav>
<div class="container-fluid"><div class="row"><aside class="col-lg-2 bg-dark sidebar-simple p-3"><div class="text-white small fw-bold mb-2">MENU</div><a class="side-link" href="<?=$pre?>dashboard.php">Dashboard</a><a class="side-link" href="<?=$pre?>proposals/index.php">Proposal</a><?php if(has_role("Admin LP2M")):?><a class="side-link" href="<?=$pre?>users/index.php">Pengguna</a><a class="side-link" href="<?=$pre?>schemes/index.php">Skema Hibah</a><a class="side-link" href="<?=$pre?>periods/index.php">Periode Hibah</a><?php endif;?></aside><main class="col-lg-10 p-4"><?php show_flash(); ?>
